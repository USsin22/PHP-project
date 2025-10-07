<?php include 'conn.php'; 

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE  FROM users WHERE id = '$id'");

header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Utilisateurs</h1>
        <a href="ajoute.php" class="btn btn-primary">Ajoute</a>
    </div>

    <table class="table table-bordered table-striped bg-white">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Ville</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        while ($user = mysqli_fetch_assoc($result)):
        ?>
            <tr>
                <td><?= $user['nom'] ?></td>
                <td><?= $user['prenom'] ?></td>
                <td><?= $user['ville'] ?></td>
                <td>
                    <a href="voir.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-info text-white">Voir</a>
                    <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="index.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('confirm');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
