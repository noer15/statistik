<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($file_keltani as $p) : ?>
        <p><?= $p->nama ?></p>
    <?php endforeach; ?>
</body>

</html>