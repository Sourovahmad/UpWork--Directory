<?php $user = user($r->user) ?>
<?php $user_me = user() ?>
<div class="pt-4  pb-5 bg-green-light">
    <div class="container">
        <div class="row">

            <div class="col-md-8">

                <div class="bg-white rounded p-3 mb-3">


                    <div class="row">
                        <div class="col-md-3 col-4">
                            <img class="rounded border-success border mw-100 " src="<?= image_micro($user->image) ?>" />
                        </div>
                        <div class="col-md-9 col-8">
                            <h5 class="mt-1">
                                <?= RC_trans($r->title) ?>

                                <?php if ($user_me): ?>
                                    <?php
                                    $Rfav = DB::table("tb_order")->where("type", 1)->where("post", $r->id)->where("user", $user_me->id)->first();
                                    ?>
                                    <?php if ($Rfav): ?>
                                        <a class="fs-4 d-inline-block text-primary ms-2 btn_fav" rel="<?= $r->id ?>" href="javascript:void(0)"><i class="fas fa-heart"></i></a>
                                    <?php else: ?>
                                        <a class="fs-4 d-inline-block text-primary ms-2 btn_fav" rel="<?= $r->id ?>" href="javascript:void(0)"><i class="far fa-heart"></i></a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </h5>

                            <div class="mb-2">
                                <i class="fas fa-star text-gold"></i> 
                                <i class="fas fa-star text-gold"></i> 
                                <i class="fas fa-star text-gold"></i> 
                                <i class="fas fa-star"></i> 
                                <i class="fas fa-star"></i> 
                            </div>

                            <p class="text-secondary">
                                التخصص : 
                                <?= RC_feature($r->section)->title ?>
                            </p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12"><hr /></div>


                        <div class="col-md-10 mb-2 text-secondary">
                            الطبيب : 
                            <?= $r->doctor ?>
                            <?php if (1 == 2): ?>
                                <?= $user->username ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-2 mb-2  text-end text-secondary">
                            <?= ($r->gender == 2) ? "أنثى" : "ذكر" ?>
                            <?php if (1 == 2): ?>
                                <?= ($user->gender == 2) ? "أنثى" : "ذكر" ?>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mt-2">
                            <p class="text-secondary mb-2">
                                المدينة : 
                                <?= RC_feature($r->city)->title ?>
                            </p>
                        </div>

                        <div class="col-md-6 mt-2 text-end">
                            <p class="text-secondary mb-2">
                                العنوان : 
                                <?= $user->map_address ?>
                            </p>

                            <p class="text-secondary  close_location">
                                <?php if (@$_COOKIE["location"] && $user->location): ?>
                                    يبعد عنك : 
                                    <?= @km(@$_COOKIE["location"], @$user->location) ?> 
                                    كم
                                <?php endif; ?>
                            </p>
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded p-3 mb-3">
                    <h5 class="mt-2 mb-3">نبذة تعريفية</h5>
                    <div class="text-secondary mb-2">
                        <?= RC_trans($r->content) ?>
                    </div>
                </div>

                <div class="bg-white rounded p-3 mb-3">
                    <h5 class="mt-2 mb-3">صور الشهادات الطبية</h5>
                    <div class="mb-2 row">
                        <?php if ($r->image): ?>
                            <?php $ARR_images = explode(",", $r->image) ?>
                            <?php foreach ($ARR_images as $ITM_images): ?>
                                <div class="col-md-3 col-6">
                                    <a style="height: 150px;" class="rounded d-block overflow-hidden" rel="prettyPhoto[]" href="<?= image_larg($ITM_images) ?>">
                                        <img style="min-height: 150px;" class="w-100 border" src="<?= image_min($ITM_images) ?>" />
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center text-secondary">لا توجد صور متاحة ..</div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="bg-white rounded p-3 mb-3">
                    <h5 class="mt-2 mb-3">الصور والفيديوهات</h5>
                    <div class="mb-2 row">
                        <?php if ($user->files): ?>
                            <?php
                            $files = explode(",", $user->files);
                            ?>
                            <?php foreach ($files as $file): ?>
                                <?php $ext = pathinfo($file, PATHINFO_EXTENSION); ?>
                                <?php if ($ext == "mp4" || $ext == "mov"): ?>

                                    <div class="col-md-3 col-6">

                                        <video style="height: 150px;" class="w-100 border rounded thevideo"  muted loop controls >
                                            <source src="<?= image_origin($file) ?>"  type="video/mp4">
                                            <p>This is fallback content to display for user agents that do not support the video tag.</p>
                                        </video>

                                    </div>
                                <?php else: ?>
                                    <div class="col-md-3 col-6">
                                        <a style="height: 150px;" class="rounded d-block overflow-hidden" rel="prettyPhoto[]" href="<?= image_larg($file) ?>">
                                            <img style="min-height: 150px;" class="w-100 border" src="<?= image_min($file) ?>" />
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="text-center">لا توجد صور متاحة ..</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-white rounded p-3 mb-3">
                    <h5 class="mt-2 mb-3">صور السجل التجاري</h5>
                    <div class="mb-2 row">
                        <?php if ($user->c_record): ?>
                            <?php $records = explode(",", $user->c_record) ?>
                            <?php foreach ($records as $record): ?>
                                <div class="col-md-3 col-6">
                                    <a style="height: 150px;" class="rounded d-block overflow-hidden" rel="prettyPhoto[]" href="<?= image_larg($record) ?>">
                                        <img style="min-height: 150px;" class="w-100 border" src="<?= image_min($record) ?>" />
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-md-12">
                                <div class="text-center text-secondary">لا توجد صور متاحة ..</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-white rounded p-3 mb-3">
                    <h5 class="mt-2 mb-3">العروض</h5>
                    <div class="mb-2 row">
                        <?php
                        $Qoffers = DB::table("tb_feature")->where("feature", 14)->where("parent", $r->id)->where("discount", ">", 0)->get();
                        foreach ($Qoffers as $Roffers):
                            echo view(RC_urlView("view/hospital/offer"), ["r" => $Roffers]);
                        endforeach;
                        ?>
                        <?php if (count($Qoffers) == 0): ?>
                            <div class="text-center text-secondary">لا توجد عروض متاحة</div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($user->location): ?>
                    <div class="bg-white pt-4 p-4 rounded-3 mb-3">
                        <h5 class=" mt-2 mb-3">الموقع  على الخريطة</h5>
                        <div>
                            <?= RC_map($user->location) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="bg-white rounded p-3 mb-3">
                    <h5 class="mt-2 mb-3">التقييمات</h5>

                    <div class="mb-2">
                        <?php
                        $Qrate = DB::table("tb_order")->where("type", 3)->where("post", $r->id);

                        $rate = 0;
                        if (count($Qrate->get()) > 0) {
                            $sum = $Qrate->sum("val");
                            $rate = intval($sum / (5 * count($Qrate->get())) * 5);
                        }
                        ?> 

                        <div class="mb-1 wrap_stars_<?= $rate ?> text-center fs-3">
                            <i class="fas fa-star "></i> 
                            <i class="fas fa-star "></i> 
                            <i class="fas fa-star "></i> 
                            <i class="fas fa-star"></i> 
                            <i class="fas fa-star"></i> 
                        </div>



                        <div class="text-center text-secondary">
                            عدد التقييمات : 
                            <span><?= count($Qrate->get()) ?></span>
                            تقييم
                        </div>

                        <?php if (count($Qrate->get()) == 0): ?>
                            <div class="text-center mt-5 p5-5 mb-5">لا توجد تقييمات متاحة الان</div>
                        <?php endif; ?>

                        <?php foreach ($Qrate->get() as $Rrate): ?>
                            <?= view(RC_urlView("view/hospital/rate"), ["r" => $Rrate]) ?> 
                        <?php endforeach; ?>
                    </div>
                </div>




            </div>



            <div class="col-md-4">

                <div class="bg-white pt-4 p-3 rounded-3 mb-3">

                    <h4 class="text-center font-weight-bolder">حجر موعد</h4>

                    <?php
                    $dateCurrent = RC_dateCurrent();
                    $__date = date("Y-m-d");

//                    $dates = DB::table("tb_feature")->where("feature", 15)->where("parent", $r->id)->where([["title", ">=", date("d-m-Y")]])->get();
                    $dates = DB::table("tb_feature")->where("feature", 15)->where("parent", $r->id)->where(DB::raw('str_to_date(title, "%d-%m-%Y")'), '>=', "$__date")->get();
                    ?>
                    <?php if (count($dates) > 0): ?>

                        <form id="form_cart" action="<?= base_url("ajax/cart") ?>" method="post">

                            <input type="hidden" value="<?= $r->id ?>" name="post" />

                            <div class="text-center mt-4 mb-4 fs-7">
                                <i class="fas fa-hand-holding-usd"></i> 
                                رسوم فتح ملف : 
                                <span class="text-primary"> <?= $r->price_file ?>ريال</span>
                                <span class="d-inline-block ms-2 me-2">|</span>
                                رسوم الكشوف
                                <span class="text-primary"> <?= $r->price ?>ريال</span>
                            </div>

                            <div class="text-center mt-4 mb-4 fs-7 container_service d-none">
                                تكلفة الخدمة 
                                <span></span>
                                ريال
                            </div>

                            <div class="col-md-12">
                                <select name="service" class="form-control mb-4 select_service">
                                    <option value="">حدد الخدمة المطلوبة</option>
                                    <?php
                                    $services = DB::table("tb_feature")->where("feature", 14)->where("parent", $r->id)->get();
                                    ?>
                                    <?php foreach ($services as $service): ?>
                                        <option price="<?php
                                        if ($service->discount > 0) {
                                            echo $service->price - ($service->price * ($service->discount / 100));
                                        } else {
                                            echo $service->price;
                                        }
                                        ?>" value="<?= $service->id ?>"><?= RC_trans($service->title) ?></option>
                                            <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <select name="dates" class="select_date form-control mb-4">
                                        <option  value="">حدد  تاريخ الحجز</option>
                                        <?php if (1 == 2): ?>
                                            <?php foreach ($dates as $date): ?>
                                                <option value="<?= $date->id ?>">
                                                    <?php
                                                    $date_tittle = RC_trans($date->title);
                                                    if ($date_tittle == RC_dateCurrent()) {
                                                        $date_tittle = "اليوم";
                                                    }
                                                    if ($date_tittle == RC_dateTomorrow()) {
                                                        $date_tittle = "غدا";
                                                    }
                                                    if ($date_tittle == RC_dateAfterTomorrow()) {
                                                        $date_tittle = "بعد غد";
                                                    }
                                                    echo $date_tittle;
                                                    ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="time" class="select_time form-control mb-4">
                                        <option value=''>حدد وقت الحجز</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-4 ">

                                    <label>
                                        <input type="radio" checked="" name="type" value="1" /> 
                                        كشف فقط
                                    </label>

                                    <label class="ms-4">
                                        <input type="radio" name="type" value="2" /> 
                                        خدمة فقط
                                    </label>

                                    <label class="ms-4">
                                        <input type="radio" name="type" value="3" /> 
                                        تكملة علاج
                                    </label>

                                </div>

                                <div class="col-md-12 mb-4 ">
                                    <h5 class="text-center mt-4">بيانات المريض</h5>
                                </div>

                                <div class="col-md-12">
                                    <input name="name" type="text" class="form-control mb-4" placeholder="أدخل إسم المريض">
                                </div>

                                <div class="col-md-12">
                                    <input name="mobile" type="text" class="form-control mb-4" placeholder="رقم الجوال">
                                </div>

                                <div class="col-md-12">
                                    <textarea name="content" class="form-control mb-4" placeholder="نبذة عن الحالة"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <select name="gender" class="form-control mb-4">
                                        <option value="">الجنس</option>
                                        <option value="1">ذكر</option>
                                        <option value="2">أنثي</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <input name="age" type="text" class="form-control mb-3" placeholder="العمر">
                                </div>

                                <div class="col-md-12">
                                    <select name="insurance" class="form-control mb-4">
                                        <option value="">شركة التأمين</option>
                                        <?php
                                        $insurances = DB::table("tb_feature")->where("feature", 13)->where("user", $r->user)->get();
                                        ?>
                                        <?php foreach ($insurances as $insurance): ?>
                                            <option value="<?= $insurance->id ?>"><?= RC_trans($insurance->title) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-4 ">
                                    <label>
                                        <input type="radio" checked="" name="method" value="1" /> 
                                        سداد بالعيادة
                                    </label>
                                    <?php if (1 == 2): ?>
                                        <label class="ms-4">
                                            <input type="radio" name="method" value="2" /> 
                                            سداد أون لاين
                                        </label>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-12 text-center mb-2">
                                    <button class="btn btn-primary ps-5 pe-5" type="submit" value="1">تأكيد الحجز</button>
                                </div>

                            </div>
                        </form>
                    <?php else: ?>
                        <div class="text-center mt-5 mb-5">لا توجد مواعيد متاحة للحجز حاليا .</div>
                    <?php endif; ?>
                </div>

                <?php if ($user_me && $user_me != null): ?>
                    <?php
                    $check_rate = DB::table("tb_cart")->where("user", $user_me->id)->where("post", $r->id)->where("status", 3)->get();
                    ?>
                    <?php if (count($check_rate) > 0): ?>
                        <div class="bg-white pt-5 p-3 rounded-3 mb-3">
                            <form action="<?= base_url("ajax/rate") ?>" id="form_ratting" method="post">
                                <h4 class="text-center font-weight-bolder">قم بتقييم تجربتك</h4>
                                <div class="mb-4 text-center fs-4 mt-4 rate_stars">
                                    <i rel='1' class="fas fa-star text-gold"></i> 
                                    <i rel='2' class="fas fa-star"></i> 
                                    <i rel='3' class="fas fa-star"></i> 
                                    <i rel='4' class="fas fa-star"></i> 
                                    <i rel='5' class="fas fa-star"></i> 
                                </div>

                                <input type="hidden" value="<?= $r->id ?>" name="post">
                                <input type="hidden" value="1" name="val">


                                <textarea name="content" class="form-control mt-4" style="height: 100px;" placeholder="إكتب تفاصيل تقييمك" ></textarea>

                                <div class="text-center mt-3">
                                    <button class="btn btn-primary ps-5 pe-5" type="submit">تقييم</button>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<input type="hidden" value="<?= $user->location ?>" name="location_hospital">

<script type="text/javascript" charset="utf-8">

//    $(document).ready(function () {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {

        /*
         x.innerHTML = "Latitude: " + position.coords.latitude +
         "<br>Longitude: " + position.coords.longitude;
         * 
         */

        var url = $('meta[name="url-base"]').attr('content') + "/ajax/location";
        var data = "location=" + position.coords.latitude + "," + position.coords.longitude + "&to=" + $("input[name=location_hospital]").val();
        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $(".close_location").html(data["data"]);
            },
            error: function (error) {}
        });


    }
    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                //   alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                //     alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                //    alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                //  alert("An unknown error occurred.");
                break;
        }
    }
//    });
</script>