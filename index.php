<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=music_db', 'admin', 'simplon');
    // Transforme toutes les erreurs en exception.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT * FROM `group`');
    // On récupére directement tous les groupes.
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    header('Content-Type: text/plain');
    echo 'fail to contact DB: ' . $e->getMessage();
    exit(1);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music DB</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="container">
    <div class="page-header"><h1 class="text-center">Music DB</h1></div>
    <ul class="nav nav-pills">
        <li role="presentation" class="active"><a href="#">Home</a></li>
        <li role="presentation"><a href="new_group.php">New Group</a></li>
    </ul>
    <!-- On crée une liste d'article à partir de $groups -->
    <?php foreach ($groups as $g) { ?>
    <article class="col-sm-offset-2 col-sm-8">
        <h2><?php echo $g['name']; ?></h2>
        <ul>
            <li><?php echo $g['start'];?></li>
            <li><?php echo $g['end'];?></li>
            <li><?php echo $g['origin'];?></li>
        </ul>
    </article>
    <?php } ?>
</body>
</html>
