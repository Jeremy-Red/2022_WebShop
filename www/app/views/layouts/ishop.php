<?php
use wfm\View;

/** @var View $this */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <?= $this->getMeta(); ?>
</head>

<body>
    <p>This is default layout ishop.php</p>
    <?= $this->content; ?>

</body>

</html>