<?php
$user = user();
?>

<button class="btn btn-primary  w-100 mb-1 btn_show d-sm-none d-block btn_show" rel=".menu_account" type="button">عرض القائمة</button>

<div class="list-group menu_account">
    <?php if ($user->type == 2 && $user->active == 1): ?>

        <div class="list-group-item list-group-item-action  pt-2 pb-2 <?= (uri(1) == "hospital" && uri(2) != "favorite") ? "bg-primary text-white " : "" ?>" aria-current="true">
            <a href="<?= base_url("hospital/lists") ?>" class="text-dark d-inline-block mt-2 <?= (uri(1) == "hospital" && uri(2) != "favorite") ? "text-white " : "" ?>">
                <i class="fas fa-user-md"></i>
                العيادات
            </a>
            <a class="btn btn-dark float-end" href="<?= base_url("hospital/form/insert") ?>">
                <i class="fas fa-plus"></i>
            </a>
        </div>

        <div class="list-group-item list-group-item-action pt-2 pb-2 <?= (uri(1) == "services") ? "bg-primary text-white " : "" ?>" aria-current="true">
            <a href="<?= base_url("services") ?>" class="text-dark d-inline-block mt-2  <?= (uri(1) == "services") ? "text-white " : "" ?>">
                <i class="fas fa-clipboard-list"></i>
                الخدمات
            </a>

            <a class="btn btn-dark float-end" href="<?= base_url("services/form/insert") ?>">
                <i class="fas fa-plus"></i>
            </a>
        </div>

        <div class="list-group-item list-group-item-action pt-2 pb-2 <?= (uri(1) == "insurance") ? "bg-primary text-white " : "" ?>" aria-current="true">
            <a href="<?= base_url("insurance") ?>" class="text-dark d-inline-block mt-2 <?= (uri(1) == "insurance") ? " text-white " : "" ?>">
                <i class="far fa-file-alt"></i>
                شركات التأمين
            </a>

            <a class="btn btn-dark float-end m-0" href="<?= base_url("insurance/form/insert") ?>">
                <i class="fas fa-plus"></i>
            </a>
        </div>

        <div class="list-group-item list-group-item-action pt-2 pb-2 <?= (uri(1) == "times") ? "bg-primary text-white " : "" ?>" aria-current="true">
            <a href="<?= base_url("times") ?>" class="text-dark d-inline-block mt-2 <?= (uri(1) == "times") ? " text-white " : "" ?>">
                <i class="far fa-clock"></i>
                مواعيد الحجز
            </a>

            <a class="btn btn-dark float-end m-0" href="<?= base_url("times/form/insert") ?>">
                <i class="fas fa-plus"></i>
            </a>
        </div>

        <a href="<?= base_url("booking") ?>" class="list-group-item list-group-item-action pt-3 pb-3 <?= (uri(1) == "booking") ? "bg-primary text-white " : "" ?>" aria-current="true">
            <i class="fas fa-align-center"></i> 
            الحجوزات

            <?php $num_book = count(DB::table("tb_cart")->where("owner", @$user->id)->where("view", 0)->get()) ?>
            <?php if ($num_book > 0): ?>
                <span class="badge bg-danger float-end"><?= $num_book ?></span>
            <?php endif; ?>
        </a>

    <?php endif; ?>


    <?php if ($user->type == 1): ?>
        <a href="<?= base_url("booking") ?>" class="list-group-item list-group-item-action pt-3 pb-3 <?= (uri(1) == "booking") ? "bg-primary text-white " : "" ?>" aria-current="true">
            <i class="fas fa-align-center"></i> 
            الحجوزات
        </a>
    <?php endif; ?>

    <?php if ($user->type == 2 && $user->active == 1): ?>
        <a href="<?= base_url("account/calc") ?>" class="list-group-item list-group-item-action pt-3 pb-3  <?= (uri(1) == "account" && uri(2) == "calc") ? "bg-primary text-white " : "" ?>">
            <i class="fas fa-calculator"></i>
            حاسبة العمولة
        </a>
    <?php endif; ?>

    <?php if ($user->type == 1): ?>
        <a href="<?= base_url("chat") ?>" class="list-group-item list-group-item-action pt-3 pb-3  <?= (uri(1) == "chat") ? "bg-primary text-white " : "" ?> ">
            <i class="far fa-comments"></i> 
            الرسائل
        </a>
    <?php else: ?>
        <?php if ($user->type == 2 && $user->active == 1): ?>
            <a href="<?= base_url("chat") ?>" class="list-group-item list-group-item-action pt-3 pb-3  <?= (uri(1) == "chat") ? "bg-primary text-white " : "" ?> ">
                <i class="far fa-comments"></i> 
                الرسائل
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <a href="<?= base_url("account/notification") ?>" class="list-group-item list-group-item-action pt-3 pb-3  <?= (uri(1) == "account" && uri(2) == "notification") ? "bg-primary text-white " : "" ?>">
        <i class="far fa-bell"></i>
        الإشعارات

        <?php $notification = DB::table("tb_notification")->where("user", $user->id)->where("view", 0)->get() ?>
        <?php if (count($notification) > 0): ?>
            <span class="badge bg-danger rounded-pill float-end "><?= count($notification) ?></span>
        <?php endif; ?>
    </a>

    <?php if ($user->type == 1): ?>
        <a href="<?= base_url("hospital/favorite") ?>" class="list-group-item list-group-item-action pt-3 pb-3 <?= (uri(1) == "hospital" && uri(2) == "favorite") ? "bg-primary text-white " : "" ?>">
            <i class="fas fa-user-edit"></i>
            مفضلتي
        </a>
    <?php endif; ?>

    <a href="<?= base_url("account/update") ?>" class="list-group-item list-group-item-action pt-3 pb-3 <?= (uri(1) == "account" && uri(2) == "update") ? "bg-primary text-white " : "" ?>">
        <i class="fas fa-user-edit"></i>
        تعديل بياناتي
    </a>

    <a href="<?= base_url("account/password") ?>" class="list-group-item list-group-item-action pt-3 pb-3 <?= (uri(1) == "account" && uri(2) == "password") ? "bg-primary text-white " : "" ?> ">
        <i class="fas fa-user-shield"></i>
        تعديل كلمة المرور
    </a>

    <a href="<?= base_url("logging/logout") ?>" class="list-group-item list-group-item-action pt-3 pb-3 ">
        <i class="fas fa-power-off"></i>
        تسجيل خروج
    </a>
</div>