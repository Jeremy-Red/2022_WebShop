<?php
/**
 * @var $errno \wfm\ErrorHandler
 * @var $errstr \wfm\ErrorHandler
 * @var $errfile \wfm\ErrorHandler
 * @var $errline \wfm\ErrorHandler
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>

<body>
    <h1>Error</h1>
    <table>
        <tr>
            <td>Code:</td>
            <td><?= $errno ?></td>
        </tr>
        <tr>
            <td>Message:</td>
            <td><?= $errstr ?></td>
        </tr>
        <tr>
            <td>File:</td>
            <td><?= $errfile ?></td>
        </tr>
        <tr>
            <td>Line:</td>
            <td><?= $errline ?></td>
        </tr>
    </table>
</body>

</html>