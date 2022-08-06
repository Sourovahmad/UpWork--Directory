<input <?= $data ?> value="<?= $value ?>"  class="<?= $class ?>" />
<?php if ($error): ?>
    <div class="text-danger">{{$error}}</div>
<?php endif; ?>