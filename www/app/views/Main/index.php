<p>This is View Main/index.php</p>
<p>
    <?php if (!empty($names)): ?>
        <?php foreach ($names as $name): ?>
            <?= $name->id . ': ' . $name->name ?><br>
        <?php endforeach; ?>
    <?php endif; ?>
</p>