<div class="col-md-<?= $col ?> <?= @$features["wrap_class"] ?> ">
    <div class="form-group">
        <?php if ($title != null): ?>
            <label class="col-form-label" for="firstname">
                <?= $title ?>
            </label>
        <?php endif; ?>
        <input type="<?= (@$features["type"]) ? @$features["type"] : "text" ?>" name="{{$name}}" value="<?= $value ?>" <?= @$features["attr"] ?> placeholder="<?= $placeholder ?>" style="<?= @$features["style"] ?>" class="form-control <?= @$features["class"] ?>" />
        <?php if ($error): ?>
            <div class="error">{{$error}}</div>
        <?php endif; ?>
    </div>
</div>
<?php if ($inline == false): ?>
    <div class="col-md-12"></div>
<?php endif; ?>
