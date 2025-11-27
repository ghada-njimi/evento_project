<?php
require_once "app/model/Database.php";

class EventModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Trouver tous les événements (accessible par l'admin et les participants)
    function findAllEvents() {
        $req = "SELECT * FROM events";
        $response = $this->pdo->query($req);
        return $response->fetchAll(PDO::FETCH_OBJ);
    }

    // Trouver un événement par son ID (accessible par l'admin et les participants)
    function findEventById($id) {
        $req = "SELECT * FROM events WHERE id = :id";
        $query = $this->pdo->prepare($req);
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Insérer un événement (accessible uniquement par l'admin)
    function insertEvent($data) {
        $fields = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));
        $req = "INSERT INTO events($fields) VALUES ($values)";
        $query = $this->pdo->prepare($req);
        return $query->execute($data);
    }

    // Supprimer un événement (accessible uniquement par l'admin)
    function deleteEvent($id) {
        $req = "DELETE FROM events WHERE id = :id";
        $query = $this->pdo->prepare($req);
        return $query->execute(['id' => $id]);
    }

    // Mettre à jour un événement (accessible uniquement par l'admin)
    function updateEvent($id, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ', ');

        $data['id'] = $id;
        $req = "UPDATE events SET $fields WHERE id = :id";
        $query = $this->pdo->prepare($req);
        return $query->execute($data);
    }

    function subscribeUserToEvent($userId, $eventId) {
        $query = "INSERT INTO user_event (user_id, event_id, status) VALUES (:user_id, :event_id, 'inscrit')";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['user_id' => $userId, 'event_id' => $eventId]);
    }
    
}
?>
