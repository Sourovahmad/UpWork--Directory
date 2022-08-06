<div class="col-md-<?= $col ?> <?= $wrap_class ?> ">
    <div class="form-group">
        <?php if ($title != null): ?>
            <label class="col-form-label" for="input_{{$name}}">
                <?= $title ?>
            </label>
        <?php endif; ?>
        <input  <?= $data ?> value="<?= $value ?>" id="input_{{$name}}" class="form-control <?= $class ?>" />
        <?php if ($error): ?>
          <div class="text-danger"><?= $error ?></div>
        <?php endif; ?>
    </div>
</div>
<?php if ($inline == false): ?>
    <div class="col-md-12"></div>
<?php endif; ?>