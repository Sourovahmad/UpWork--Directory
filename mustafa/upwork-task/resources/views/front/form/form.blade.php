<form method="POST" enctype="multipart/form-data" action="<?= $action ?>"> 
    @csrf
    <?php if (RC_post("submit") && $trans == true && RC_success() == false && !empty($languages) && $languages->count() > 1): ?>
        <div class="alert alert-danger rounded-0">تأكد من كافة الحقول باللغات المختلفة</div>
    <?php endif; ?>
    <?= (isset($content)) ? $content : "" ?>
</form>