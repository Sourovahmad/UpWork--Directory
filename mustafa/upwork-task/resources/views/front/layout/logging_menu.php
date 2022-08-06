<?php $user = user() ?>

<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="<?= base_url("post/insert") ?>">إضافة عقار جديد</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="<?= base_url("post/lists") ?>">عقاراتي</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="<?= base_url("account/update") ?>">تعديل بياناتي</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="<?= base_url("account/password") ?>">تعديل كلمة المرور</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="<?= base_url("logging/logout") ?>">تسجيل خروج</a></li>
</ul>