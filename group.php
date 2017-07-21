<?php
$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
if (empty($get['id'])) {
    header('content-type: text/plain');
    echo 'id must be set';
    exit(1);
}
try {
    // 1. Connection à la base de données.
    $pdo = new PDO('mysql:host=localhost;dbname=music_db', 'admin', 'simplon');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Préparation de la requête par PHP.
    $stmt = $pdo->prepare('SELECT `album`.*, `group`.name AS group_name  FROM `album` INNER JOIN `group` ON `album`.group_id=`group`.id WHERE group_id=:id');
    // 3. On remplace les valeurs dans la requête.
    $stmt->bindValue(':id', $get['id']);
    // 4. On envoie la requête à MariaDB.
    $stmt->execute();
    // 5. On récupère les données.
    $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Discography - <?php echo $albums[0]['group_name']; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body class="container">
    <div class="page-header"><h1 class="text-center">Discography - <?php echo $albums[0]['group_name']; ?></h1></div>
    <ul class="nav nav-pills">
        <li role="presentation"><a href="index.php">Home</a></li>
        <li role="presentation"><a href="new_group.php">New Group</a></li>
    </ul>
    <?php foreach ($albums as $a) { ?>
    <article class="col-sm-offset-2 col-sm-8">
        <h2><?php echo $a['name']; ?></h2>
        <dl class="dl-horizontal">
            <dt>date</dt><dd><?php echo $a['date']; ?></dd>
            <dt>label</dt><dd><?php echo $a['label']; ?></dd>
            <dt>sales</dt><dd><?php echo $a['sales']; ?></dd>
            <dt>genre</dt><dd><?php echo $a['genre']; ?></dd>
        </dl>
    </article>
    <?php } ?>
</body>
</html>