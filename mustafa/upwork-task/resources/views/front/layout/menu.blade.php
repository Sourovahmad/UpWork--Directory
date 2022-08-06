<ul class="navbar-nav mr-auto  text-white">

    <li class="nav-item active">
        <a class="nav-link text-white  ps-4" href="<?= base_url() ?>">الرئيسية</a>
    </li>

    <li class="nav-item ">
        <a class="nav-link text-white ps-4" href="<?= base_url("hospital") ?>">العيادات</a>
    </li>

    <li class="nav-item ">
        <a class="nav-link text-white ps-4" href="<?= base_url("hospital/offers") ?>">العروض</a>
    </li>

    <?php
    $q = DB::table('tb_feature')->where("feature", 2)->get()
    ?>
    <?php foreach ($q as $r): ?>
        <li class="nav-item">
            <a class="nav-link text-white ps-4" href="<?= base_url("pages/v/$r->id") ?>"><?= RC_trans($r->title) ?></a>
        </li>
    <?php endforeach; ?>
    <li class="nav-item ">
        <a class="nav-link text-white ps-4" href="<?= base_url("contact") ?>">إتصل بنا</a>
    </li>

</ul>