<?= view(RC_urlView("layout/head")) ?>
<body>
    <?= view(RC_urlView("layout/header")) ?>
    <?= (isset($container)) ? $container : "" ?>
    <?= view(RC_urlView("layout/footer")) ?>
    <?= view(RC_urlView("layout/logging")) ?>
    <?= view(RC_urlView("layout/js")) ?>
</body>
<?= view(RC_urlView("layout/foot")) ?>