<div class="container wrap_container mt-5">
    <?php if (isset($title)): ?>
        <div class="four text-center">
            <h1 class="text-center fs-3 mb-3 text-primary title d-inline-block">
                <?= (isset($title)) ? $title : "" ?>
            </h1>
        </div>
    <?php endif; ?>
    <div class="mt-5 row">
        <?= (isset($content)) ? $content : "" ?>
    </div>
</div>