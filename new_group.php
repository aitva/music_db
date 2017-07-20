<?php
// Filtre la variable $_POST et empèche les injections HTML/CSS/JS.
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

// Test l'existence des champs 'name' et 'start'.
if (!empty($post['name']) && !empty($post['start'])) {
    try {
        // Crée une connexion vers la base de données.
        $pdo = new PDO('mysql:host=localhost;dbname=music_db', 'admin', 'simplon');
        // Transforme toutes les erreurs en exception.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO `group` (name, start, end, origin) VALUES (:name, :start, :end, :origin);');
        if (empty($post['end'])) {
            $post['end'] = NULL;
        }
        if (empty($post['origin'])) {
            $post['origin'] = NULL;
        }
        $stmt->execute([
            'name' => $post['name'],
            'start' => $post['start'],
            'end' => $post['end'],
            'origin' => $post['origin'],
        ]);
        header('location: index.php');
    } catch (Exception $e) {
        header('Content-Type: text/plain');
        echo 'fail to contact DB: ' . $e->getMessage();
        exit(1);
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music DB - New Group</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="container">
    <div class="page-header">
        <h1 class="text-center">Music DB</h1>
    </div>
    <ul class="nav nav-pills">
        <li role="presentation"><a href="index.php">Home</a></li>
        <li role="presentation" class="active"><a href="new_group.php">New Group</a></li>
    </ul>
    <h2 class="text-center">New Group</h2>
    <form action="" method="POST" class="col-sm-offset-3 col-sm-6">
        <div class="form-group">
            <label for="name">Name:</label>
            <input id="name" type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="start">Start:</label>
            <input id="start" type="date" name="start" class="form-control">
        </div>
        <div class="form-group">
            <label for="end">End:</label>
            <input id="end" type="date" name="end" class="form-control">
        </div>
        <div class="form-group">
            <label for="origin">Origin:</label>
            <input id="origin" type="text" name="origin" class="form-control">
        </div>
        <input type="submit" class="btn btn-default">
    </form>
</body>
</html>