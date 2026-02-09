<?php

namespace app\repositories;

use PDO;

class MessageRepository {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * Récupère toutes les conversations d'un utilisateur
     */
    public function getConversations($userId) {
        $sql = "
            (SELECT 
                c.id AS id_conversation, c.id_user2 AS id_autre, c.created_at ,
                u.nom,u.prenom,u.email 
            FROM conversations c 
                JOIN users u ON u.id = c.id_user2 WHERE c.id_user1 = ? 
            ) 
            UNION
            (SELECT 
                c.id AS id_conversation, c.id_user1 AS id_autre, c.created_at ,
                u.nom,u.prenom,u.email
            FROM conversations c 
                JOIN users u ON u.id = c.id_user1 WHERE c.id_user2 = ?
            ) 
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll();
    }

    /**
     * Crée une nouvelle conversation entre deux utilisateurs
     */
    public function createConversation($userId1, $userId2) {
        // Vérifier si la conversation existe déjà
        if ($this->conversationExists($userId1, $userId2)) {
            return $this->findConversation($userId1, $userId2)['id'];
        }

        $user1 = min($userId1, $userId2);
        $user2 = max($userId1, $userId2);

        $sql = "INSERT INTO conversations (id_user1, id_user2, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user1, $user2]);

        return $this->pdo->lastInsertId();
    }

    /**
     * Vérifie si une conversation existe entre deux utilisateurs
     */
    public function conversationExists($userId1, $userId2) {
        $conversation = $this->findConversation($userId1, $userId2);
        return $conversation !== false && $conversation !== null;
    }

    /**
     * Trouve une conversation entre deux utilisateurs
     */
    public function findConversation($userId1, $userId2) {
        $sql = "
            SELECT * FROM conversations 
            WHERE (id_user1 = ? AND id_user2 = ?) 
               OR (id_user1 = ? AND id_user2 = ?)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId1, $userId2, $userId2, $userId1]);
        return $stmt->fetch();
    }

    /**
     * Récupère tous les utilisateurs sauf l'utilisateur courant
     */
    public function getAllUsersExcept($userId) {
        $sql = "SELECT id, nom, prenom, email FROM users WHERE id != ? ORDER BY nom, prenom";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    /**
     * Récupère tous les messages d'une conversation
     */
    public function getMessages($conversationId) {
        $sql = "
            SELECT 
                m.id,
                m.id_conversation,
                m.id_auteur,
                m.content,
                m.type,
                m.created_at,
                u.nom,
                u.prenom,
                u.email
            FROM messages m
            LEFT JOIN users u ON m.id_auteur = u.id
            WHERE m.id_conversation = ?
            ORDER BY m.created_at ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$conversationId]);
        return $stmt->fetchAll();
    }

    /**
     * Envoie un message
     */
    public function sendMessage($conversationId, $userId, $content) {
        $sql = "
            INSERT INTO messages (id_conversation, id_auteur, content, type, created_at)
            VALUES (?, ?, ?, 'text', NOW())
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$conversationId, $userId, $content]);

        // Retourner le message inséré
        return $this->getMessageById($this->pdo->lastInsertId());
    }

    /**
     * Récupère un message par ID
     */
    public function getMessageById($messageId) {
        $sql = "
            SELECT 
                m.id,
                m.id_conversation,
                m.id_auteur,
                m.content,
                m.type,
                m.created_at,
                u.nom,
                u.prenom,
                u.email
            FROM messages m
            LEFT JOIN users u ON m.id_auteur = u.id
            WHERE m.id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$messageId]);
        return $stmt->fetch();
    }

    /**
     * Récupère les infos d'un utilisateur
     */
    public function getUserById($userId) {
        $sql = "SELECT id, nom, prenom, email FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    /**
     * Vérifie que l'utilisateur peut accéder à cette conversation
     */
    public function userCanAccessConversation($conversationId, $userId) {
        $sql = "
            SELECT id FROM conversations 
            WHERE id = ? AND (id_user1 = ? OR id_user2 = ?)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$conversationId, $userId, $userId]);
        return $stmt->fetch() !== false;
    }
}
