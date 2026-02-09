// Messages Component - Alpine.js (Version nettoyée)
window.messagesComponent = {
    // État de base
    conversations: [],
    filteredConversations: [],
    selectedConversation: null,
    currentMessages: [],
    newMessage: '',
    searchQuery: '',
    sidebarVisible: window.innerWidth > 992,
    loading: false,

    // Initialisation
    async init() {
        console.log('Messages component initialized');
        await this.loadConversations();
        
        // Écouter les changements de taille d'écran
        window.addEventListener('resize', () => {
            this.sidebarVisible = window.innerWidth > 992;
        });

        // Charger les utilisateurs quand le modal s'ouvre
        const modalEl = document.getElementById('newConversationModal');
        if (modalEl) {
            modalEl.addEventListener('show.bs.modal', async () => {
                const modalBody = modalEl.querySelector('.modal-body');
                const alpineData = Alpine.$data(modalBody);
                if (alpineData && alpineData.loadUsers) {
                    await alpineData.loadUsers();
                }
            });
        }
    },

    // Charger les conversations depuis la BDD
    async loadConversations() {
        try {
            this.loading = true;
            
            // Utiliser les données initiales si disponibles
            if (typeof initialConversations !== 'undefined' && initialConversations.length > 0) {
                this.conversations = initialConversations;
                this.filteredConversations = [...this.conversations];
            } else {
                const response = await fetch('/api/messages/conversations');
                if (!response.ok) throw new Error('Failed to load conversations');
                this.conversations = await response.json();
                this.filteredConversations = [...this.conversations];
            }
            
            this.loading = false;
        } catch (error) {
            console.error('Error loading conversations:', error);
            this.loading = false;
        }
    },

    // Charger les messages d'une conversation
    async loadMessages() {
        if (!this.selectedConversation) return;

        try {
            const response = await fetch(`/api/messages/get?conversation_id=${this.selectedConversation.id}`);
            if (!response.ok) throw new Error('Failed to load messages');
            
            this.currentMessages = await response.json();
            
            // Auto-scroll vers le bas
            setTimeout(() => {
                const chatMessages = document.getElementById('chatMessages');
                if (chatMessages) {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            }, 100);
        } catch (error) {
            console.error('Error loading messages:', error);
        }
    },

    // Sélectionner une conversation
    async selectConversation(conversation) {
        this.selectedConversation = conversation;
        this.sidebarVisible = false;
        await this.loadMessages();
    },

    // Envoyer un message
    async sendMessage() {
        if (!this.selectedConversation || !this.newMessage.trim()) {
            return;
        }

        try {
            const response = await fetch('/api/messages/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    conversation_id: this.selectedConversation.id,
                    content: this.newMessage
                })
            });

            if (!response.ok) throw new Error('Failed to send message');
            const data = await response.json();
            
            if (data.success) {
                this.newMessage = '';
                
                // Recharger les messages depuis la BDD (pas d'ajout local)
                await this.loadMessages();
                
                // Recharger les conversations pour mettre à jour l'aperçu
                await this.loadConversations();

                // Auto-scroll
                setTimeout(() => {
                    const chatMessages = document.getElementById('chatMessages');
                    if (chatMessages) {
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                }, 100);
            }
        } catch (error) {
            console.error('Error sending message:', error);
            alert('Error sending message: ' + error.message);
        }
    },

    // Rafraîchir les messages
    async refreshMessages() {
        if (this.selectedConversation) {
            await this.loadMessages();
        }
        await this.loadConversations();
        console.log('Messages refreshed');
    },

    // Filtrer les conversations
    filterConversations() {
        if (!this.searchQuery.trim()) {
            this.filteredConversations = [...this.conversations];
        } else {
            const query = this.searchQuery.toLowerCase();
            this.filteredConversations = this.conversations.filter(conv => 
                conv.name.toLowerCase().includes(query) || 
                conv.email.toLowerCase().includes(query)
            );
        }
    },

    // Marquer tous les messages comme lus
    async markAllRead() {
        if (!this.selectedConversation) return;

        try {
            const response = await fetch('/api/messages/read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    conversation_id: this.selectedConversation.id
                })
            });

            if (!response.ok) throw new Error('Failed to mark as read');

            this.currentMessages.forEach(msg => {
                if (!msg.sent) msg.read = true;
            });

            await this.loadConversations();
        } catch (error) {
            console.error('Error marking as read:', error);
        }
    },

    // Nouvelle conversation
    async newConversation() {
        try {
            console.log('Opening new conversation modal...');
            
            // Charger les utilisateurs en premier
            const response = await fetch('/api/messages/users');
            if (!response.ok) throw new Error('Failed to load users');
            const users = await response.json();
            
            console.log('Users loaded:', users);
            
            // Remplir le select du modal
            const selectEl = document.getElementById('userSelect');
            selectEl.innerHTML = '<option value="">-- Choose a user --</option>';
            users.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = `${user.name} (${user.email})`;
                selectEl.appendChild(option);
            });
            
            // Afficher le modal
            const modalEl = document.getElementById('newConversationModal');
            console.log('Modal element:', modalEl);
            
            if (!modalEl) {
                alert('Modal element not found!');
                return;
            }
            
            // Utiliser Bootstrap Modal
            if (typeof bootstrap !== 'undefined') {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
                console.log('Modal shown successfully');
            } else {
                console.error('Bootstrap not loaded');
                alert('Bootstrap is not loaded');
            }
        } catch (error) {
            console.error('Error in newConversation:', error);
            alert('Error: ' + error.message);
        }
    },

    // Créer une nouvelle conversation
    async createNewConversation(userId) {
        if (!userId) {
            alert('Please select a user');
            return;
        }
        
        try {
            const response = await fetch('/api/messages/create-conversation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    other_user_id: userId
                })
            });

            if (!response.ok) throw new Error('Failed to create conversation');
            const data = await response.json();
            
            if (data.success) {
                await this.loadConversations();
                const newConv = this.conversations.find(c => c.id === data.conversation_id);
                if (newConv) {
                    await this.selectConversation(newConv);
                }
            }
        } catch (error) {
            console.error('Error creating conversation:', error);
            alert('Error: ' + error.message);
        }
    },

    // Basculer sidebar
    toggleSidebar() {
        this.sidebarVisible = !this.sidebarVisible;
    }
};
