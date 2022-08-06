<?php $user = user() ?>

<header class="sticky-top bg-primary d-sm-none d-block">
    <div class="container">
        <div class="row">
            <div class="col p-0  align-items-right justify-content-right d-flex " id="main-menu-btn">
                <button data-trigger="navbar_main" class="d-lg-none btn text-white bg-primary ms-3" type="button">  <i class="fas fa-bars"></i></button>
            </div>
            <?php if (1 == 2): ?>
                <div class="col p-0 align-items-center justify-content-center d-flex " >
                    <a href="javascript:;"  data-toggle="modal" data-target="#searchModal"class="btn btn-link text-white" >
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            <?php endif; ?>
            <div class="col d-flex justify-content-center header-logo">
                <a class="navbar-brand" href="<?= secure_url("") ?>">
                    <img class="logo" src="<?= RC_url("front/img/logo.png") ?>" alt="Logo">
                </a> 
            </div>

            <?php if (1 == 2): ?>
                <div class="col p-0 align-items-center justify-content-center d-flex" id="main-cart-btn">
                    <a class="text-white fs-4 d-inline-block m-3" href="<?= base_url("post/favorite") ?>"><i class="far fa-heart"></i></a>
                </div>
            <?php endif; ?>

            <div class="col p-0 align-items-center justify-content-end d-flex wrap_mobile_buttons_login" id="main-user-btn"> 
                <?php if ($user): ?>

                    <div class="dropdown">


                        <button style="background: none;border: none;" class="text-white  fs-4 me-4 d-inline-block dropdown-toggles" type="button"  data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class="far fa-user"></i></button>


                        <div style="    left: 0px;
    width: 235px;
    max-height: 450px;
    overflow: scroll;" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?= base_url("account") ?>">حسابي</a>
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
                    </div>




                    <?php if (1 == 2): ?>
                        <div class="dropdown d-inline-block">
                            <a class="text-white  fs-5  d-inline-block btn_dropdown" id="dropdownMenuButton2" href="javascript:void(0)">
                                <i class="far fa-user"></i> 
                            </a>

                            <ul style="left: 0px;" class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="<?= base_url("account/update") ?>">تعديل بياناتي</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url("account/password") ?>">تعديل كلمة المرور</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url("logging/logout") ?>">تسجيل خروج</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <a data-toggle="modal" data-target="#loginModal" class="text-white me-4 fs-4 d-inline-block" href="javascript:void(0)"><i class="far fa-user"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<span class="screen-darken"></span>

<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg navbar-dark bg-primary d-sm-none d-block">
    <div class="container-fluid">
        <div class="offcanvas-header">  
            <button class="btn-close float-end"></button>
        </div>
        <?= view(url_layout("menu")) ?>
    </div> <!-- container-fluid.// -->
</nav>


<header class="bg-primary d-none d-sm-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a class="navbar-brand" href="<?= secure_url("") ?>">
                    <img class="logo" src="<?= RC_url("front/img/logo.png") ?>" alt="Logo">
                </a> 
            </div>

            <div class="col-md-8 mt-4 text-end">
                <div class="wrap_social text-end d-inline-block">
                    <?php
                    $Qsocial = DB::table("tb_feature")->where("feature", 3)->get();
                    ?>
                    <?php foreach ($Qsocial as $Rsocial): ?>
                        <a target="_blank" href="<?= $Rsocial->content ?>"><i class="<?= $Rsocial->details ?>"></i></a>
                    <?php endforeach; ?>
                </div>

                <div class="d-inline-block border-start border-white wrap_buttons_login ps-3 ms-3">
                    <?php if ($user): ?>
                        <a class="text-white" href="<?= base_url("account") ?>">
                            <?= $user->username ?>
                        </a>
                    <?php else: ?>
                        <a data-toggle="modal" data-target="#loginModal" class="text-white d-inline-block me-3" href="javascript:void(0)">تسجيل دخول</a>
                        <a data-toggle="modal" data-target="#register_type" class="text-white" href="javascript:void(0)">عضوية جديدة</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg mt-3">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <?= view(url_layout("menu")) ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>