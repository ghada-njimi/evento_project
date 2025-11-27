<?php
// app/model/UserModel.php

class UserModel {

    private $pdo;

    // Constructeur pour initialiser la connexion à la base de données via Database
    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // // Méthode pour vérifier les informations de connexion de l'utilisateur
    // public function login($email, $password) {
    //     // Préparer la requête pour vérifier si l'email existe dans la base de données
    //     $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
    //     $stmt->bindParam(':email', $email);
    //     $stmt->execute();
    //     $user = $stmt->fetch();

    //     // Si l'utilisateur existe et que le mot de passe est correct
    //     if ($user && password_verify($password, $user['password'])) {
    //         return $user;  // Retourner les informations de l'utilisateur
    //     } else {
    //         return false;  // Retourner false si l'email ou le mot de passe est incorrect
    //     }
    // }

    // Méthode pour insérer un nouvel utilisateur (pour l'admin)
    public function insertUser($data) {
        // Préparer la requête d'insertion d'un nouvel utilisateur dans la base de données
        $stmt = $this->pdo->prepare("INSERT INTO user (email, password, role) VALUES (:email, :password, :role)");
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':role', $data['role']);
        return $stmt->execute();  // Retourne true si l'insertion a réussi, false sinon
    }

    // Méthode pour récupérer tous les utilisateurs
    public function findAllUsers() {
        // Préparer la requête pour récupérer tous les utilisateurs
        $stmt = $this->pdo->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();  // Retourne tous les utilisateurs sous forme de tableau
    }

    // Méthode pour trouver un utilisateur par son ID
    public function findUserById($id) {
        // Préparer la requête pour récupérer un utilisateur par son ID
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();  // Retourne l'utilisateur ou false si non trouvé
    }

    // Méthode pour mettre à jour un utilisateur
    public function updateUser($id, $data) {
        // Préparer la requête pour mettre à jour les informations d'un utilisateur
        $stmt = $this->pdo->prepare("UPDATE user SET email = :email, password = :password, role = :role WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':role', $data['role']);
        return $stmt->execute();  // Retourne true si la mise à jour a réussi, false sinon
    }

    // Méthode pour supprimer un utilisateur
    public function deleteUser($id) {
        // Préparer la requête pour supprimer un utilisateur par son ID
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();  // Retourne true si la suppression a réussi, false sinon
    }

    public function findUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne les données de l'utilisateur ou false
    }
    
}
?>
