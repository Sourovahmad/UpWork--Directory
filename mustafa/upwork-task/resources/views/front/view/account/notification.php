<?php $user = user();?>
<div class="co-md-12 mb-3">
    <div class="bg-white p-3 rounded-lg">
        <div class="row">
            <div class="col-9 fw-bolder text-primary">
                <?php if ($r->owner == 0): ?>
                    رسالة إدارية
                <?php else: ?>
                    <?php
                    $owner = user($r->owner);
                    echo $owner->username;
                    ?>
                <?php endif; ?>
            </div>
            <div class="col-3 fs-7 text-secondary text-end">
                <?= $r->date_insert ?>
            </div>
            <div class="col-md-12 mt-2 fs-6">
                <div>
                    <?= $r->content ?>
                </div>
                <div>

                    <?php if ($r->parent && @$user->type ==1): ?>
                        <?php $_r = DB::table("tb_cart")->where("id", $r->parent)->first() ?>
                        <?php if ($_r && $_r->status == 1): ?>
                            <hr />
                            <a class="btn btn-primary" href="<?= base_url("booking/update/$r->parent") ?>">تعديل الموعد</a>
                            <a href="javascript:void(0)" class="btn btn-danger booing_status" rel="4" ref="<?= base_url("booking/status/$r->parent?case=4") ?>">إلغاء الحجز</a>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div> 
        </div>

    </div>
</div>

