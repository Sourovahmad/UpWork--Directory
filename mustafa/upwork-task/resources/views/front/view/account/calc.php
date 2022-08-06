<?php
$q = DB::table("tb_cart")->where("user", $user_id)->where("commission_paid", 0)->where("status", 3)->get();
$commission = 0;
?>
<?php if (count($q) > 0): ?>
    <div class="co-md-12 mb-3 ov">
        <div class="bg-white p-3 rounded-lg">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">العميل</th>
                        <th scope="col">كود الحجز</th>
                        <th scope="col">المبلغ</th>
                        <th scope="col">العمولة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($q as $r): ?>
                        <tr class="text-secondary">
                            <td>
                                <?php
                                $user = user($r->user);
                                echo $user->username;
                                ?>
                            </td>
                            <td>#<?= $r->code ?></td>
                            <td><?= $r->price ?>ريال</td>
                            <td><?= $r->commission ?>ريال</td>
                            <?php $commission += $r->commission ?>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

        <div class="bg-dark p-2 rounded-bottom">
            <div class="row text-white">
                <div class="col-md-4 ">
                    <div class="mt-1">الرصيد : <?= floatval(@$user_data->credit) ?> ريال</div>
                </div>
                <div class="col-md-4 text-center"> 
                    <div class="mt-1">العمولة : <?= floatval(@$user_data->commission) ?> ريال</div>
                </div>
                <div class="col-md-4 text-end"><a class="btn btn-primary" href="<?= base_url("account/commission") ?>">سداد العمولة</a></div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="co-md-12 text-center mt-5 mt-5">
        <p class="mt-5 pt-5">
            لا توجد عمولات متاحة الآن
        </p>
    </div>
<?php endif; ?>

