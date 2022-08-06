<?php $user = user(); ?>
<header class="c-header c-header-light c-header-fixed">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="fas fa-bars"></i>
    </button>
    <!--    <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
        <i class="fas fa-grip-horizontal"></i>
        </a>-->
    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{RC_url()}}">الرئيسية</a></li>
        <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="<?= RC_url("settings") ?>">الإعدادات</a></li>
    </ul>
    <!--data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom"-->
    <ul class="c-header-nav mfs-auto">
        <li class="c-header-nav-item px-3 c-d-legacy-none ">
            <!--c-class-toggler-->
            <button class="dark_mood c-header-nav-btn " type="button" id="header-tooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="Toggle Light/Dark Mode">
                <i class="far fa-moon c-icon c-d-dark-none"></i>
                <i class="far fa-sun c-icon c-d-default-none"></i>
            </button>
        </li>
    </ul>
    <ul class="c-header-nav">
        <?php if (1 == 2): ?>
            <li class="c-header-nav-item dropdown d-md-down-none mx-2">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                    <div class="dropdown-header bg-light"><strong>You have 5 notifications</strong></div><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-success">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-follow"></use>
                        </svg> New user registered</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-danger">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-unfollow"></use>
                        </svg> User deleted</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-info">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
                        </svg> Sales report is ready</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-success">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
                        </svg> New client</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-warning">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                        </svg> Server overloaded</a>
                    <div class="dropdown-header bg-light"><strong>Server</strong></div><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1"><small><b>CPU Usage</b></small></div><span class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-muted">348 Processes. 1/4 Cores.</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1"><small><b>Memory Usage</b></small></div><span class="progress progress-xs">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-muted">11444GB/16384MB</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1"><small><b>SSD 1 Usage</b></small></div><span class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-muted">243GB/256GB</small>
                    </a>
                </div>
            </li>
            <li class="c-header-nav-item dropdown d-md-down-none mx-2">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-list"></i>
                    <span class="badge badge-pill badge-warning">15</span></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                    <div class="dropdown-header bg-light"><strong>You have 5 pending tasks</strong></div><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Upgrade NPM &amp; Bower<span class="float-right"><strong>0%</strong></span></div><span class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">ReactJS Version<span class="float-right"><strong>25%</strong></span></div><span class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">VueJS Version<span class="float-right"><strong>50%</strong></span></div><span class="progress progress-xs">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Add new layouts<span class="float-right"><strong>75%</strong></span></div><span class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="small mb-1">Angular 8 Version<span class="float-right"><strong>100%</strong></span></div><span class="progress progress-xs">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </a><a class="dropdown-item text-center border-top" href="#"><strong>View all tasks</strong></a>
                </div>
            </li>
        <?php endif; ?>

        <li class="c-header-nav-item dropdown d-md-down-none mx-2">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-envelope"></i>
                <span class="badge badge-pill badge-info">
                    <?php echo DB::table("tb_contact")->where("view", 0)->where("type", 0)->get()->count() ?>        
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                <div class="dropdown-header bg-light">
                    <strong>
                        لديك 
                        <?php echo DB::table("tb_contact")->where("view", 0)->where("type", 0)->get()->count() ?>  
                        رسالة جديدة
                    </strong>
                </div>

                <?php
                $q_msg = DB::table("tb_contact")->where("view", 0)->where("type", 0)->get();
                ?>
                <?php foreach ($q_msg as $r_msg): ?>
                <a class="dropdown-item" style="width: 400px;" href="<?= secure_url("rc-admin/contact") ?>">
                    <div class="row">
                    <div class="col-md-2 text-right">
                        <div class="c-avatar mt-1"><img class="c-avatar-img" src="<?= base_url("admin/img/user-1.png") ?>" ><span class="c-avatar-status bg-success"></span></div>
                    </div>
                    <div class="col-md-10">
                              <div class="font-weight-bold text-right pt-1"><?= $r_msg->name ?></div>
                            <div  style="width: 250px;" class="small text-muted text-truncate text-right"><?= $r_msg->content ?></div>
                    </div>
                    </div>
                    
                    </a>
                <?php endforeach; ?>

                <a class="dropdown-item text-center border-top" href="<?= RC_url("contact") ?>"><strong>الإطلاع علي كافة الرسائل</strong></a>
            </div>
        </li>


        <li class="c-header-nav-item dropdown">

            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="<?= image_micro($user->image, "user.png") ?>" alt="user    ">
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right pt-0 text-right">
                <div class="dropdown-header bg-light py-2">
                    <strong>حسابي</strong>
                </div>
                <a class="dropdown-item" href="<?= RC_url("users/form/update/$user->id") ?>">
                    <i class="fas fa-user-edit ml-2"></i> 
                    تعديل بيانتي
                    <!--<span class="badge badge-info mfs-auto">42</span>-->
                </a>

                <div class="dropdown-header bg-light py-2">
                    <strong>الإعدادات</strong>
                </div>

                <a class="dropdown-item" href="<?= RC_url("settings") ?>">
                    <i class="fas fa-cogs ml-2"></i>
                    الإعدادات
                </a>

                <a class="dropdown-item" target="_blank" href="<?= secure_url("") ?>">
                   <i class="fas fa-globe"></i>
                    الموقع الإلكتروني
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= RC_url("logging/logout") ?>">
                    <i class="fas fa-power-off"></i>
                    تسجيل خروج
                </a>
            </div>
        </li>
        
        <?php if(1==2):?>
        <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside" data-class="c-sidebar-show">
            <i class="fas fa-grip-horizontal"></i>
        </button>
        <?php endif;?>
    </ul>

    <div class="c-subheader justify-content-between px-3">
        <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
            <li class="breadcrumb-item">
                <a href="{{RC_url()}}">الرئيسية</a>
            </li>

            <?php
            $uri_1 = request()->segment(2);
            $uri_2 = request()->segment(3);
            $nav_1 = DB::table("rc_menu")->where([["view", "=", "1"], ["url", "=", $uri_1]])->first();
            ?>
            @if($nav_1)
            <li class="breadcrumb-item"><a href="{{RC_url($nav_1->url)}}">{{$nav_1->title}}</a></li>
            @endif

            <?php
            $url_get = str_replace(RC_url() . "/", "", url()->current());
            $nav_2 = DB::table("rc_menu")->where([["view", "=", "1"], ["url", "=", "$url_get"]])->first();
            ?>
            @if($nav_2 && $uri_2)
            <li class="breadcrumb-item active">
                {{$nav_2->title}}
            </li>
            @endif
        </ol>
</header>