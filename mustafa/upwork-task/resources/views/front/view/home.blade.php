<div class="position-relative">
    <?= view(RC_urlView("common/slider")) ?>
</div>


<div class="container mt-4 pt-4 mb-2">

    <h4 class="text-center mt-4 mb-5">
        إبحث عن طبيب واحجز موعد بكل سهولة
    </h4>

    <form class="pb-4" method="get" action="<?= base_url("hospital") ?>">

        <div class="row">

            <div class="col-md-3 mb-3">
                <input name="title"  type="text" class="form-control" value="<?= (uri(1) == "hospital" && request()->get("title")) ? request()->get("title") : "" ?>"  placeholder="إسم الدكتور او العيادة .."  aria-describedby="button-addon1">
            </div>

            <div class="col-md-3 mb-3">
                <select name="city" class="form-select" id="inputGroupSelect01">
                    <option value="" >حدد المدينة...</option>
                    <?php
                    $Qcity = DB::table("tb_feature")->where("feature", 5)->get();
                    ?>
                    <?php foreach ($Qcity as $Rcity): ?>
                        <option <?= (uri(1) == "hospital" && request()->get("city") == $Rcity->id) ? "selected" : "" ?> value="<?= $Rcity->id ?>"><?= RC_trans($Rcity->title) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <input name="date"  type="text" class="form-control hijri-date-input" value="<?= (uri(1) == "hospital" && request()->get("date")) ? request()->get("date") : "" ?>"  placeholder="حدد تاريخ الحجز المناسب"  aria-describedby="button-addon1">
            </div>

            <div class="col-md-3 mb-3">
                <select name="section" class="form-select" id="inputGroupSelect01">
                    <option value="" > إختر التخصص المطلوب...</option>
                    <?php
                    $Qsection = DB::table("tb_feature")->where("feature", 8)->get();
                    ?>
                    <?php foreach ($Qsection as $Rsection): ?>
                        <option  <?= (uri(1) == "hospital" && request()->get("section") == $Rsection->id) ? "selected" : "" ?> value="<?= $Rsection->id ?>"><?= RC_trans($Rsection->title) ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

        </div>

        <div class="row mt-4 pt-1">
            <div class="col-md-12 text-center">
                <button class="btn btn-lg btn-primary btn-lg ps-5 pe-5 fs-6" name="search" value="1" type="submit" id="button-addon1">بحث</button>
            </div>
        </div>
    </form>
</div>


<div class="bg-light pt-5 pb-5 mt-5">
    <div class="container position-relative mb-5 mt-4">

        <h4 class="position-absolute z-index-100 top-20">
            آخر العروض المضافة
            <a class="text-primary fs-6  d-inline-block ms-2" href="<?= base_url("hospital/offers") ?>" >(عرض المزيد ... )</a>
        </h4>
        <?php $q = DB::table("tb_feature")->where("feature", 14)->where("discount", ">", 0)->limit(8)->get(); ?>
        <?php if (count($q) == 0): ?>
            <div class="mt-5 pt-5 text-center">
                <p class="mt-5 pt-5 ">
                    لا توجد عروض متاحة الان .
                </p>
            </div>
        <?php else: ?>


            <div class="owl-carousel owl-theme">

                <?php foreach ($q as $_r): ?>
                    <div class="item">
                        <?= view(RC_urlView("view/hospital/offer"), ["r" => $_r, "col" => 12]) ?> 
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="bg-light pt-5 pb-5 ">
    <div class="container position-relative mb-5 mt-4">

        <h4 class="position-absolute z-index-100 top-20">
            آخر  الخدمات المضافة  
        </h4>
        <?php $q = DB::table("tb_feature")->where("feature", 14)->limit(8)->get(); ?>
        <?php if (count($q) == 0): ?>
            <div class="mt-5 pt-5 text-center">
                <p class="mt-5 pt-5 ">
                    لا توجد عروض متاحة الان .
                </p>
            </div>
        <?php else: ?>


            <div class="owl-carousel owl-theme">

                <?php foreach ($q as $_r): ?>
                    <div class="item">
                        <?= view(RC_urlView("view/hospital/service"), ["r" => $_r, "col" => 12]) ?> 
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php foreach ($Qsection as $Rsection): ?>
    <?php $q = DB::table("tb_hospital")->where("section", $Rsection->id)->limit(8)->get(); ?>
    <?php if (count($q) > 0): ?>
        <div class=" pt-2 pb-5 mt-5">
            <div class="container position-relative mb-5 mt-4">

                <h4 class="position-absolute z-index-100 top-20">
                    <?= RC_trans($Rsection->title) ?>
                    <a class="text-primary fs-6  d-inline-block ms-2" href="<?= base_url("hospital?section=$Rsection->id") ?>" >(عرض المزيد ... )</a>
                </h4>

                <div class="owl-carousel owl-theme">
                    <?php foreach ($q as $_r): ?>
                        <div class="item">
                            <?= view(RC_urlView("view/hospital/block"), ["r" => $_r, "col" => 12]) ?> 
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>