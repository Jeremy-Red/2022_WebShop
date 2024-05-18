<?php
use wfm\View;

/** @var View $this */
?>
<?php $this->getPart('parts/header'); ?>

<p>This is default layout ishop.php</p>

<?= $this->content; ?>

<?php $this->getPart('parts/footer'); ?>