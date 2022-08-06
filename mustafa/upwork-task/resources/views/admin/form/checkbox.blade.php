<div class="col-md-<?= $col ?> <?= $wrap_class ?> ">
    <div class="form-check checkbox mb-4">
        <label class="form-check-label" >
            <input <?= $data ?> value="<?= $value ?>"   class="form-check-input<?= $class ?>" />
            <?php if ($title != null): ?>
                <?= $title ?>
            <?php endif; ?>
        </label>

        <?php if ($error): ?>
            <div class="text-danger"><?= $error ?></div>
        <?php endif; ?>
    </div>
</div>
<?php if ($inline == false): ?>
    <div class="col-md-12"></div>
<?php endif; ?>
