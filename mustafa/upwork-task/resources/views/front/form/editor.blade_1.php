<div class="col-md-<?= $col ?> <?= @$features["wrap_class"] ?>">
    <div class="form-group">
        <?php if ($title != null): ?>
            <label class="col-form-label" for="firstname">
                <?= $title ?>
            </label>
        <?php endif; ?>
        <textarea  rows="10" name="{{$name}}" <?= @$features["attr"] ?> placeholder="<?= $placeholder ?>" style="<?= @$features["style"] ?>" class="form-control editor <?= @$features["class"] ?>"><?= @$value ?></textarea>
        <?php if ($error): ?>
            <div class="text-danger">{{$error}}</div>
        <?php endif; ?>
    </div>
</div>
<?php if ($inline == false): ?>
    <div class="col-md-12"></div>
<?php endif; ?>
