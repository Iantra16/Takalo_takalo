<?php

namespace app\controllers;

use flight\Engine;
use app\repositories\MessageRepository;

class MessageController {

    protected Engine $app;

    public function __construct(Engine $app) {
        $this->app = $app;
    }

    public function chat() {
        $this->app->render('metis/chat');
    }

    /**
     * Récupère toutes les conversations de l'utilisateur connecté
     */
    public function getConversations() {
        // Vérifier que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            $this->app->json(['error' => 'Unauthorized'], 401);
            return;
        }

        try {
            $pdo = $this->app->db();
            $repo = new MessageRepository($pdo);
            $userId = $_SESSION['user_id'];

            $conversations = $repo->getConversations($userId);

            // Formater les données
            $formatted = [];
            foreach ($conversations as $conv) {
                $formatted[] = [
                    'id' => (int)$conv['id'],
                    'name' => $conv['prenom'] . ' ' . $conv['nom'],
                    'email' => $conv['email'],
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($conv['prenom'] . '+' . $conv['nom']) . '&background=random',
                    'created_at' => $conv['created_at'],
                    'other_user_id' => (int)$conv['other_user_id']
                ];
            }

            $this->app->json($formatted);
        } catch (\Exception $e) {
            $this->app->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Récupère tous les messages d'une conversation
     */
    public function getMessages() {
        if (!isset($_SESSION['user_id'])) {
            $this->app->json(['error' => 'Unauthorized'], 401);
            return;
        }

        try {
            $conversationId = $this->app->request()->query['conversation_id'];
            
            if (!$conversationId) {
                $this->app->json(['error' => 'Missing conversation_id'], 400);
                return;
            }

            $pdo = $this->app->db();
            $repo = new MessageRepository($pdo);
            $userId = $_SESSION['user_id'];

            // Vérifier que l'utilisateur peut accéder à cette conversation
            if (!$repo->userCanAccessConversation($conversationId, $userId)) {
                $this->app->json(['error' => 'Access denied'], 403);
                return;
            }

            $messages = $repo->getMessages($conversationId);

            // Formater les données
            $formatted = [];
            foreach ($messages as $msg) {
                $formatted[] = [
                    'id' => (int)$msg['id'],
                    'text' => htmlspecialchars($msg['content']),
                    'time' => $this->formatTime($msg['created_at']),
                    'sent' => (int)$msg['id_auteur'] === $userId,
                    'author' => $msg['prenom'] . ' ' . $msg['nom'],
                    'authorId' => (int)$msg['id_auteur']
                ];
            }

            $this->app->json($formatted);
        } catch (\Exception $e) {
            $this->app->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Envoie un message
     */
    public function sendMessage() {
        if (!isset($_SESSION['user_id'])) {
            $this->app->json(['error' => 'Unauthorized'], 401);
            return;
        }

        try {
            $data = $this->app->request()->data;
            $conversationId = $data->conversation_id ?? null;
            $content = $data->content ?? '';
            $userId = $_SESSION['user_id'];

            if (!$conversationId || !$content) {
                $this->app->json(['error' => 'Missing conversation_id or content'], 400);
                return;
            }

            // Nettoyer le contenu
            $content = trim($content);
            if (empty($content)) {
                $this->app->json(['error' => 'Message cannot be empty'], 400);
                return;
            }

            $pdo = $this->app->db();
            $repo = new MessageRepository($pdo);

            // Vérifier que l'utilisateur peut accéder à cette conversation
            if (!$repo->userCanAccessConversation($conversationId, $userId)) {
                $this->app->json(['error' => 'Access denied'], 403);
                return;
            }

            // Envoyer le message
            $message = $repo->sendMessage($conversationId, $userId, $content);

            $this->app->json([
                'success' => true,
                'message' => [
                    'id' => (int)$message['id'],
                    'text' => htmlspecialchars($message['content']),
                    'time' => $this->formatTime($message['created_at']),
                    'sent' => true,
                    'author' => $message['prenom'] . ' ' . $message['nom'],
                    'authorId' => (int)$message['id_auteur']
                ]
            ]);
        } catch (\Exception $e) {
            $this->app->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Crée une nouvelle conversation
     */
    public function createConversation() {
        if (!isset($_SESSION['user_id'])) {
            $this->app->json(['error' => 'Unauthorized'], 401);
            return;
        }

        try {
            $data = $this->app->request()->data;
            $otherUserId = $data->other_user_id ?? null;
            $userId = $_SESSION['user_id'];

            if (!$otherUserId) {
                $this->app->json(['error' => 'Missing other_user_id'], 400);
                return;
            }

            if ($otherUserId == $userId) {
                $this->app->json(['error' => 'Cannot start conversation with yourself'], 400);
                return;
            }

            $pdo = $this->app->db();
            $repo = new MessageRepository($pdo);

            // Vérifier que l'utilisateur existe
            $otherUser = $repo->getUserById($otherUserId);
            if (!$otherUser) {
                $this->app->json(['error' => 'User not found'], 404);
                return;
            }

            $conversationId = $repo->createConversation($userId, $otherUserId);

            $this->app->json([
                'success' => true,
                'conversation_id' => (int)$conversationId,
                'name' => $otherUser['prenom'] . ' ' . $otherUser['nom'],
                'other_user_id' => (int)$otherUserId
            ]);
        } catch (\Exception $e) {
            $this->app->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Récupère la liste de tous les utilisateurs
     */
    public function getAllUsers() {
        if (!isset($_SESSION['user_id'])) {
            $this->app->json(['error' => 'Unauthorized'], 401);
            return;
        }

        try {
            $pdo = $this->app->db();
            $repo = new MessageRepository($pdo);
            $userId = $_SESSION['user_id'];

            $users = $repo->getAllUsersExcept($userId);

            $formatted = [];
            foreach ($users as $user) {
                $formatted[] = [
                    'id' => (int)$user['id'],
                    'name' => $user['prenom'] . ' ' . $user['nom'],
                    'email' => $user['email'],
                    'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user['prenom'] . '+' . $user['nom']) . '&background=random'
                ];
            }

            $this->app->json($formatted);
        } catch (\Exception $e) {
            $this->app->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Récupère les utilisateurs disponibles (sans conversation existante)
     */
    public function getAvailableUsers() {
        if (!isset($_SESSION['user_id'])) {
            $this->app->json(['error' => 'Unauthorized'], 401);
            return;
        }

        try {
            $pdo = $this->app->db();
            $repo = new MessageRepository($pdo);
            $userId = $_SESSION['user_id'];

            // Récupérer tous les utilisateurs sauf moi
            $allUsers = $repo->getAllUsersExcept($userId);

            // Filtrer ceux avec qui je n'ai pas encore de conversation
            $availableUsers = [];
            foreach ($allUsers as $user) {
                if (!$repo->conversationExists($userId, $user['id'])) {
                    $availableUsers[] = [
                        'id' => (int)$user['id'],
                        'name' => $user['prenom'] . ' ' . $user['nom'],
                        'email' => $user['email'],
                        'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user['prenom'] . '+' . $user['nom']) . '&background=random'
                    ];
                }
            }

            $this->app->json($availableUsers);
        } catch (\Exception $e) {
            $this->app->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Formate le timestamp en temps lisible
     */
    private function formatTime($dateString) {
        if (!$dateString) return '';
        
        $date = new \DateTime($dateString);
        $now = new \DateTime();
        $today = $now->format('Y-m-d');
        $msgDate = $date->format('Y-m-d');

        if ($msgDate === $today) {
            return $date->format('H:i');
        } elseif ($msgDate === $now->modify('-1 day')->format('Y-m-d')) {
            return 'Yesterday';
        } else {
            return $date->format('d/m/Y');
        }
    }
}
