<?php
date_default_timezone_set('Europe/Moscow');

define('CHARSETS', ['from' => 'UTF-8', 'to' => 'UTF-8']);
// define('CHARSETS', ['from' => 'cp1251', 'to' => 'UTF-8']);

define('KEYS', 'php|wordpress|laravel');

// define('URL', 'http://localhost/parsing/assets/source21.txt');
// define('URL', 'http://localhost/parsing/assets/source22.txt');
// define('URL', 'http://localhost/parsing/assets/source23.txt');
// define('URL', 'https://aa.intimcity.vip/');
// define('URL', 'https://www.php.net/docs.php');
define('URL', 'https://answersq.com/udemy-paid-courses-for-free-with-certificate/');
// define('URL', 'https://error_url_is_not_available.com/');

define('TARGET_TIME', '14:58:00');


require_once './P.php';
P::set(URL, KEYS, CHARSETS, TARGET_TIME);
P::start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title><?= P::$parsedDate . ' > ' . P::$currentDate ?></title>
    <link rel="stylesheet"
          href="./assets/style.css">
</head>

<body>
    <h2><?= P::$title ?></h2>
    <p id="info"></p>
    <hr>
    <p>Looked for "<strong><?= KEYS ?></strong>":</p>
    <ul><?= P::$keysList ?></ul>
    <hr>
    <p>Full list:</p>
    <ul><?= P::$list ?></ul>

    <script>
        (function () {
            const isUpdated = <?= var_export(P::$updated) ?>;
            const targetTime = new Date('<?= P::$timeUpdate ?>');
            const differenceTime = targetTime - Date.now();
            const isExpired = differenceTime <= 0;
            let nextUpdate = isExpired ? 30000 : differenceTime;

            if (!isUpdated) {
                if (isExpired)
                    play('./assets/no-update.wav', false);
                updateTime();
            } else {
                setInfo();
                play('./assets/update.wav', true);
            }
            function play(path, loop) {
                $audio = new Audio(path);
                $audio.play();
                $audio.loop = loop;
            }
            function updateTime() {
                setInfo();
                if (nextUpdate <= 0) {
                    window.location.reload();
                } else {
                    nextUpdate -= 1000;
                    setTimeout(updateTime, 1000);
                }
            }
            function setInfo() {
                let state = '';
                if (isUpdated)
                    state = '<strong style="color: green">Updated</strong>';
                else if (isExpired)
                    state = `Updating <strong>${displayTime(nextUpdate)}</strong>`;
                else
                    state = `Waiting <strong>${displayTime(nextUpdate)}</strong>`;
                info.innerHTML = state;
            }
            function displayTime(mSeconds) {
                const convertToSec = Math.floor(mSeconds / 1000);
                const restSec = Math.max(convertToSec, 0);
                const seconds = restSec % 60;
                const minutes = Math.floor(restSec / 60) % 60;
                const hours = Math.floor(restSec / 3600) % 24;
                const displayS = String(seconds).padStart(2, '0');
                const displayM = String(minutes).padStart(2, '0');
                const displayH = String(hours).padStart(2, '0');
                return `${displayH}:${displayM}:${displayS}`;
            }
        })();
    </script>
</body>

</html>