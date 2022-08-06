<div class="col-md-<?= (isset($col)) ? $col : "3" ?> mt-3 mb-4">
    <?php
    $user = user($r->user);
    ?>
    <a class="d-block" href="<?= base_url("hospital/v/{$r->id}") ?>">
        <div class="border rounded-3" style="height: 200px;overflow: hidden">

            <img src="<?= image_min($user->image) ?>" class="card-img-top " alt="<?= RC_trans($r->title) ?>">

        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="mt-2 mb-1 fs-6 text-primary text-truncate"><?= RC_trans($r->title) ?></h5> 
                <div class="text-secondary text-truncate"><?= RC_feature($r->city)->title ?></div>
            </div>
        </div>
    </a>
     
    <?php if (uri(1) == "hospital" && uri(2) == "lists"): ?>
        <div class=" mt-2 ">
            <div class="row ">
                <div class="col-md-6 col-6">
                    <a class="btn btn-primary btn-sm d-block" href="<?= base_url("hospital/form/update/{$r->id}") ?>">تعديل</a>
                </div>
                <div class="col-md-6 col-6 text-end">
                    <a class="btn btn-danger btn-sm d-block btn_delete" rel="<?= base_url("hospital/delete?id={$r->id}") ?>" href="javascript:void(0)">حذف</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <a class="btn btn-primary d-block mt-3" href="<?= base_url("hospital/v/{$r->id}") ?>">
            حجز موعد
        </a>
    <?php endif; ?>
</div>
