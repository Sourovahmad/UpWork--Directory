<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"> {{$title??""}}
                <div class="card-header-actions">
                    <?php if (!empty($languages) && $languages->count() > 1): ?>
                        <?php foreach ($languages as $language): ?>
                            <a class="card-header-action btn_form_lang <?= ($language->active == 1) ? "btn-info text-white" : "" ?>  pr-3 pl-3 btn" lang="<?= $language->shortcut ?>" href="javascript:void(0)" ><?= $language->title ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($error && !empty($languages) && $languages->count() > 1): ?>
                <div class="alert alert-danger rounded-0">تأكد من كافة الحقول باللغات المختلفة</div>
            <?php endif; ?>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="<?= $action ?>"> 
                    @csrf
                    <!-- Equivalent to... -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row">
                        <?= (isset($content)) ? $content : "" ?>
                    </div>
                    <?php if (!$button): ?>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="submit" value="1">حفظ</button>
                        </div>
                    <?php else: ?>
                        <?= $button ?>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>