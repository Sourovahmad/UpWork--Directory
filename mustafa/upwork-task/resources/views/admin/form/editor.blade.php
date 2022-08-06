<div class="col-md-<?= $col ?> <?= $wrap_class ?>">
    <div class="form-group">
        <?php if ($title != null): ?>
            <label class="col-form-label" for="input_<?= $name ?>">
                <?= $title ?>
            </label>
        <?php endif; ?>
        <textarea  rows="10" name="{{$name}}" id="input_<?= $name ?>" <?= $data ?> class="form-control editor <?= $class ?>"><?= @$value ?></textarea>
        <?php if ($error): ?>
          <div class="text-danger"><?= $error ?></div>
        <?php endif; ?>
    </div>
</div>
<?php if ($inline == false): ?>
    <div class="col-md-12"></div>
<?php endif; ?>
