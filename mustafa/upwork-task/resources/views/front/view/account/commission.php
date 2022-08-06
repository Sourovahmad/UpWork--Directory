<div class="row">
    <?php
    $q = DB::table("tb_feature")->where("feature", 16)->get();
    ?>
    <?php foreach ($q as $r): ?>
        <div class="col-md-6">
            <table class="table table-bordered w-100 bg-light rounded-3">
                <tr>
                    <td style="width: 100px">المصرف</td>
                    <td><?= $r->title ?></td>
                </tr>
                <tr>
                    <td>إسم المستفيد</td>
                    <td style="width: 100px"><?= $r->name ?></td>
                </tr>
                <tr>
                    <td>رقم الحساب</td>
                    <td style="width: 100px"><?= $r->number ?></td>
                </tr>
                <tr>
                    <td>الأيبان</td>
                    <td style="width: 100px"><?= $r->content ?></td>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>
</div>

<hr />