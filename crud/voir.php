<?php include 'conn.php';

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2>Détails de l'utilisateur</h2>
    <ul class="list-group"><li>
        <img src="<?= $user['img'] ?>" width="150" class="mb-3 rounded">
</li>
        <li class="list-group-item"><strong>Nom:</strong> <?= $user['nom'] ?></li>
        <li class="list-group-item"><strong>Prénom:</strong> <?= $user['prenom'] ?></li>
        <li class="list-group-item"><strong>Ville:</strong> <?= $user['ville'] ?></li>
    </ul>
    <a href="index.php" class="btn btn-secondary mt-3">Retour</a>
</div>
</body>
</html>
