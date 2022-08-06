<div class="container">
    {{$title??''}}
    <div class="row">
        <?= (isset($content) && $content) ? $content : "" ?>
        <?php if ($button == "true"): ?>
            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="submit" value="1"><?= ($button_title) ? $button_title : "حفظ" ?></button>
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>