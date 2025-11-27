<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des événements</title>
    <link rel="stylesheet" href="public/css/style.css"> <!-- Inclure le fichier CSS -->
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin: 20px auto;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 300px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card h3 {
            margin-bottom: 10px;
            color: #333;
        }
        .card p {
            font-size: 14px;
            color: #666;
        }
        .card .date {
            font-weight: bold;
            margin: 10px 0;
            color: #007bff;
        }
        .card button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .card button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Liste des événements</h1>
    <div class="container">
        <?php foreach ($events as $event): ?>
        <div class="card">
            <h3><?= htmlspecialchars($event['name']) ?></h3>
            <p><?= htmlspecialchars($event['description']) ?></p>
            <p class="date">Date : <?= htmlspecialchars($event['date']) ?></p>
            <p class="location">Lieu : <?= htmlspecialchars($event['location']) ?></p>
            <a href="index.php?action=findEventById&id=<?= $event['id'] ?>">
                <button>Détails</button>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
