<div class="col-md-12">
    <div class="row">
        <?= (isset($content)) ? $content : "" ?>
    </div>

    <?php if ($button == "true"): ?>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="submit" value="1"><?= ($button_title) ? $button_title : "حفظ" ?></button>
        </div>
    <?php else: ?>
        <?= $button ?>
    <?php endif; ?>
</div>
