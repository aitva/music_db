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
    <title>My Music DB</title>
</head>
<body>
    <h1>My Music DB</h1>
    <!-- On crée une liste d'article à partir de $groups -->
    <?php foreach ($groups as $g) { ?>
    <article>
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
