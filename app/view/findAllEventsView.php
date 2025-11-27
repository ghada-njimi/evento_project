<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Événements</title>
    <link rel="stylesheet" href="path_to_your_css_file.css"> <!-- Ajouter le chemin vers votre fichier CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px 0;
        }
        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: calc(33.333% - 20px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card h3 {
            margin: 0;
            padding: 15px;
            background-color: #007BFF;
            color: white;
            text-align: center;
        }
        .card p {
            margin: 10px;
            padding: 0 15px;
            font-size: 14px;
            color: #555;
        }
        .card .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-top: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .card .footer a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        .card .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php foreach ($events as $event): ?>
            <div class="card">
                <h3><?= htmlspecialchars($event->title) ?></h3>
                <p><strong>Description:</strong> <?= htmlspecialchars($event->description) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($event->event_date) ?></p>
                <p><strong>Lieu:</strong> <?= htmlspecialchars($event->event_location) ?></p>
                <div class="footer">
                    <a href="index.php?action=subscribeEvent&id=<?= $event->id_event ?>">S'inscrire</a>
                    <a href="index.php?action=findEventById&id=<?= $event->id_event ?>">Voir plus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
