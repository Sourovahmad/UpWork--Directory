<div class="col-md-12 mt-5 text-center">
    <img src="<?= url_image("user-2.png") ?>" />
    <h5 class="mt-2">
        <?= $user->username ?>
    </h5>
    <div class="text-secondary">
        <div class="mt-4">
            تاريخ الإنضمام منذ
            <?= RC_date($user->date_insert) ?>
        </div>

        <div>
            نوع العضوية : 
            <?= ($user->type == 1) ? "عميل" : "عيادة او مستشفي" ?>
        </div>

        <div>
            حالة العضوية : 
            <?= ($user->active) ? "مفعلة" : "غير مفعلة" ?>
        </div>
    </div>


    <div class="mt-3">
        <a class="btn btn-sm btn-primary" href="<?= base_url("account/update") ?>">تعديل بياناتي</a>
        <a class="btn btn-sm btn-danger" href="<?= base_url("logging/logout") ?>">تسجيل خروج</a>
    </div>

</div>