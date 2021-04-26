<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title><?= $title ?></title>
</head>
<body>
    <?php
    if(isset($var["error"])){?>
        <div id="error" style="background-color:<?= $var["color"] ?>"><?= $var["error"]; ?></div><?php

    } ?>
    <?php include( $_SERVER["DOCUMENT_ROOT"] . "/assets/parts/nav.php") ?>
    <?= $html ?>
</body>
</html>

