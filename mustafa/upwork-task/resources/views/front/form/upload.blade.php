<div class="col-md-<?= $col ?> <?= $wrap_class ?> mb-3"> 
    <div class="form-group">
        <label class="col-form-label">
            <?= $title ?>
        </label>
        <div class="fallback dropzone" num="<?= $num ?>" allow="<?= $allow ?>" mark="false" >
            <input  value="<?= $value ?>" <?= $data ?> class="<?= $class ?>" >
        </div>
        <?php if ($error): ?>
          <div class="text-danger"><?= $error ?></div>
        <?php endif; ?>
    </div>
</div>
<?php if ($inline == false): ?>
    <div class="col-md-12"></div> 
<?php endif; ?> 