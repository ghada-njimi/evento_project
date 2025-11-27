<?php
require_once "app/model/UserModel.php";  

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    // C : Ajouter un utilisateur (pour admin) via POST 
    function insertUserAction() {
        $isInsert = $this->userModel->insertUser([
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role' => $_POST['role']
        ]);
        header("location: index.php?action=findAllUsers");
        exit;
    }

    // R : Afficher tous les utilisateurs (pour admin)
    function findAllUsersAction() {
        $users = $this->userModel->findAllUsers();
        require_once('app/view/FindAllUsers.php');
    }

    // U : Modifier un utilisateur (accessible pour l'admin)
    function editUserAction() {
        $id = $_GET['id'];
        $user = $this->userModel->findUserById($id);
        require_once('app/view/EditUserView.php');
    }

    // U : Mettre à jour un utilisateur
    function updateUserAction() {
        $this->userModel->updateUser($_POST['id'], [
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role' => $_POST['role']
        ]);
        header("location: index.php?action=findAllUsers");
        exit;
    }

    // D : Supprimer un utilisateur (accessible par l'admin)
    function deleteUserAction() {
        $id = $_GET['id'];
        $this->userModel->deleteUser($id);
        header("location: index.php?action=findAllUsers");
        exit;
    }



    public function loginAction() {
        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userModel->login($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: app/view/admin_dashboard.php");
            } else {
                header("Location: app/view/participant_dashboard.php");
            }
            exit;
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
}
?>
    // // Login : Authentification de l'utilisateur (pour tous les utilisateurs)
    // public function loginAction() {
    //     session_start();
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];

    //     // Vérification des informations de connexion via le modèle
    //     $user = $this->userModel->login($email, $password);

    //     if ($user) {
    //         // Si l'utilisateur existe et que le mot de passe est correct
    //         if ($user['role'] == 'admin') {
    //             header("Location: app/view/admin_dashboard.php");
    //             exit;
    //         } else {
    //             header("Location: app/view/participant_dashboard.php");
    //             exit;
    //         }
    //     } else {
    //         // Si l'authentification échoue, rediriger avec un message d'erreur
    //         echo "Email ou mot de passe incorrect.";
    //     }
    // }

    //authentifiction de l'utilisateur et redirection 
    // public function loginAction() {
    //     session_start();
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
    
    //     $user = $this->userModel->findUserByEmail($email);
    
    //     if ($user && password_verify($password, $user['password'])) {
    //         // L'utilisateur est authentifié
    //         $_SESSION['user'] = $user;
    
    //         // Redirection en fonction du rôle
    //         if ($user['role'] === 'admin') {
    //             header("Location: app/view/admin_dashboard.php");
    //         } else {
    //             header("Location: app/view/participant_dashboard.php");
    //         }
    //         exit;
    //     } else {
    //         // En cas d'échec, redirection avec message d'erreur
    //         $_SESSION['error'] = "Email ou mot de passe incorrect.";
    //         header("Location: login.php");
    //         exit;
    //     }
    // }
    
}
?>
