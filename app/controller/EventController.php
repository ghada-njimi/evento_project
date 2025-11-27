<?php
require_once "app/model/EventModel.php";

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new EventModel();
    }

    // Afficher tous les événements (accessible par l'admin et les participants)
    function findAllEventsAction() {
        $events = $this->eventModel->findAllEvents();
        require_once('app/view/FindAllEventsView.php');
    }

    // Afficher un événement spécifique (accessible par l'admin et les participants)
    function findEventByIdAction() {
        $id = $_GET['id'];
        $event = $this->eventModel->findEventById($id);
        require_once('app/view/FindEventView.php');
    }

    // Ajouter un événement (accessible uniquement par l'admin)
    function addEventAction() {
        require_once('app/view/AddEventView.php'); //formulaire d'ajout
    }

    // Insérer un nouvel événement (accessible uniquement par l'admin)
    function insertEventAction() {
        $isInsert = $this->eventModel->insertEvent([
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'location' => $_POST['location']
        ]);
        header("location: index.php?action=findAllEvents");
    }

    // Supprimer un événement (accessible uniquement par l'admin)
    function deleteEventAction() {
        $id = $_GET['id'];
        $this->eventModel->deleteEvent($id);
        header("location: index.php?action=findAllEvents");
    }

    // Modifier un événement (accessible uniquement par l'admin)
    function editEventAction() {
        $id = $_GET['id'];
        $event = $this->eventModel->findEventById($id);
        require_once('app/view/EditEventView.php');
    }

    // Mettre à jour les informations d'un événement (accessible uniquement par l'admin)
    function updateEventAction() {
        $this->eventModel->updateEvent($_POST['id'], [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'location' => $_POST['location']
        ]);
        header("location: index.php?action=findAllEvents");
    }
    //ajouter inscription dans la table user_event
    function subscribeEventAction() {
        $eventId = $_GET['id'];
        $userId = $_SESSION['user_id']; // Supposant que l'ID utilisateur est stocké dans la session
    
        $query = "INSERT INTO user_event (user_id, event_id, status) VALUES (:user_id, :event_id, 'inscrit')";
        $stmt = $this->eventModel->pdo->prepare($query);
        $stmt->execute([
            'user_id' => $userId,
            'event_id' => $eventId
        ]);
    
        header("Location: index.php?action=findAllEvents");
    }
    
}
?>
