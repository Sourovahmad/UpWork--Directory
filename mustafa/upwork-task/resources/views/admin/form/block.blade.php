<div class="card">
    <div class="card-header">
        <span class="pt-2 d-inline-block">
            {{$title??''}}
        </span>

        <div class="card-header-actions">
            <?= (isset($title_left) && $title_left) ? $title_left : "" ?>

            <?php if (!empty($languages) && $languages->count() > 1): ?>
                <?php foreach ($languages as $language): ?>
                    <a class="card-header-action btn_form_lang <?= ($language->active == 1) ? "btn-info text-white" : "" ?>  pr-3 pl-3 btn" lang="<?= $language->shortcut ?>" href="javascript:void(0)" ><?= $language->title ?></a>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

    </div>
    <div class="card-body">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
            <div class="row container_view">
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
    </div>
</div>