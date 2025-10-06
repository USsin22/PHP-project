<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-200 via-white to-pink-200 min-h-screen flex items-center justify-center">
  
<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.php');

    exit();
}
$name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
?>

<div class="container mx-auto mt-10 p-8 bg-white rounded-lg shadow-lg max-w-lg d-flex">
    <div class="img"><img src="photo/def.png" alt="" class="w-25"></div>
    <h1 class="text-3xl font-bold text-center text-blue-700 mb-4">Welcome Mr</h1>
    <p class="text-center text-gray-600">You have successfully logged in.</p>
    <a href="logout.php" class="btn bt-light" >logout</a>
</div>
    
</body>
</html>