<?php
$user = user($r->user);
$owner = user($r->owner);

switch ($r->type):
    case 1:
        $type = "كشف فقط";
        break;
    case 2:
        $type = "خدمة فقط ";
        break;
    case 3:
        $type = "تكملة علاج";
        break;
    default :
        $type = "كشف فقط";
        break;
endswitch;
?>
<div class="co-md-12 mb-3">
    <div class="bg-white p-3 rounded-lg">
        <div  class="row mb-1">
            <div  class="col-md-8 text-primary">
                <span class="d-inline-block fs-5">
                    <?php if ($user_type == 2): ?>
                        <?= $user->username ?>
                    <?php else: ?>
                        <?= $owner->username ?>
                    <?php endif; ?>
                </span>
                <small>( <?= $type ?> )</small>
                <span class="d-inline-block ms-2 text-dark">#<?= $r->code ?></span>
            </div>

            <div class="col-md-4 text-end">


                <?php if ($r->status == 0 && $user_type == 1): ?>
                    <span class="pt-0 btn-sm alert-info">قيد الإنتظار</span>
                <?php endif; ?>

                <?php if ($r->status == 1 && $user_type == 1): ?>
                    <span class="pt-0 btn-sm alert-success">حجز مؤكد</span>
                <?php endif; ?>

                <?php if ($r->status == 2): ?>
                    <span class="pt-0 btn-sm alert-danger">حجز مرفوض</span>
                <?php endif; ?>

                <?php if ($r->status == 3): ?>
                    <span class="pt-0 btn-sm alert-success">تم التنفيذ</span>
                <?php endif; ?>

                <?php if ($r->status == 4): ?>
                    <span class="pt-0 btn-sm alert-danger">تم إلغاء الحجز</span>
                <?php endif; ?>


                <?php if ($r->status == 0): ?> 
                    <?php if ($user_type == 2): ?>
                        <a class="btn btn-sm btn-success booing_status"  rel="1" ref="<?= base_url("booking/status/$r->id?case=1") ?>" href="javascript:void(0)">تأكيد الحجز</a>
                        <a class="btn btn-sm btn-danger booing_status" rel="2" ref="<?= base_url("booking/status/$r->id?case=2") ?>" href="javascript:void(0)">رفض الحجز</a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($user_type == 2): ?>

                        <?php if ($r->status == 1): ?>
                            <a class="btn btn-sm btn-success booing_status"  rel="3" ref="<?= base_url("booking/status/$r->id?case=3") ?>" href="javascript:void(0)">تم التنفيذ</a>
                            <a class="btn btn-sm btn-danger booing_status" rel="4" ref="<?= base_url("booking/status/$r->id?case=4") ?>" href="javascript:void(0)">إلغاء الحجز</a>
                        <?php endif; ?>

                        <a class="btn btn-sm btn-dark " href="<?= base_url("chat?u={$r->user}") ?>">مراسلة</a>
                    <?php else: ?>
                         <?php if ($r->status == 1): ?>
                            <a class="btn btn-sm btn-danger booing_status" rel="4" ref="<?= base_url("booking/status/$r->id?case=4") ?>" href="javascript:void(0)">إلغاء الحجز</a>
                            <?php endif;?>
                        <a class="btn btn-sm btn-dark " href="<?= base_url("chat?u={$r->owner}") ?>">مراسلة</a>
                    <?php endif; ?>
                <?php endif; ?>




                <a class="btn btn-sm btn-dark btn_details_booking" rel="<?= $r->id ?>" href="javascript:void(0)"><i class="fas fa-list-ul"></i></a>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4 mt-2 fs-6 text-secondary">
                <div class="bg-gray-chat p-2 rounded">
                    <div class="row">
                        <div class="col-6">تاريخ الحجز</div>
                        <div class="col-6 text-end"><?= RC_trans(RC_feature($r->date)->title) ?></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-2 fs-6 text-secondary">
                <div class="bg-gray-chat p-2 rounded">
                    <div class="row">
                        <div class="col-6">وقت الحجز</div>
                        <div class="col-6 text-end"><?= $r->time ?></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-2 fs-6 text-secondary">
                <div class="bg-gray-chat p-2 rounded">
                    <div class="row">
                        <div class="col-6">الخدمة</div>
                        <div class="col-6 text-end"><?= ($r->service) ? RC_trans(RC_feature($r->service)->title) : "لا يوجد" ?></div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="bg-green-middle p-2 fs-7 details_booking details_booking_<?= $r->id ?>">
        <div class="row">

            <div class="col-md-4 mb-1">
                <span class="text-dark me-1">المريض : </span>
                <span class="text-secondary"> <?= $r->name ?> </span>
            </div>

            <div class="col-md-4 mb-1">
                <span class="text-dark me-1">العمر : </span>
                <span class="text-secondary"> <?= $r->age ?> عام  </span>
            </div>

            <div class="col-md-4 mb-1">
                <span class="text-dark me-1">الجوال : </span>
                <span class="text-secondary"> <?= $r->mobile ?> </span>
            </div>

            <div class="col-md-4 mb-1">
                <span class="text-dark me-1">الجنس : </span>
                <span class="text-secondary"> 
                    <?= ($r->gender == 2) ? "أنثي" : "ذكر" ?> 
                </span>
            </div>

            <div class="col-md-4 mb-1">
                <span class="text-dark me-1">التأمين : </span>
                <span class="text-secondary"> 
                    <?= ($r->insurance) ? RC_trans(RC_feature($r->insurance)->title) : "لا يوجد" ?>
                </span>
            </div>

            <div class="col-md-4 mb-1">
                <span class="text-dark me-1">تاريخ الطلب : </span>
                <span class="text-secondary"> 
                    <?= $r->date_insert ?>
                </span>
            </div>

            <div class="col-md-12 mb-1">
                <span class="text-dark me-1"> نبذه عن الحالة : </span>
                <span class="text-secondary"> 
                    <?= $r->content ?>
                </span>
            </div>


        </div>
    </div>

</div>