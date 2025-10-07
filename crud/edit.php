<?php include 'conn.php';

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $ville = $_POST['ville'];

    mysqli_query($conn, "UPDATE users SET nom='$nom', prenom='$prenom', ville='$ville' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2>Editer l'utilisateur</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" value="<?= $user['nom'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?= $user['prenom'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ville</label>
            <input type="text" name="ville" value="<?= $user['ville'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning">mettre a jour</button>
        <a href="index.php" class="btn btn-secondary">go back</a>
    </form>
</div>
</body>
</html>
