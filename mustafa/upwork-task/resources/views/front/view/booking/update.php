<div class="bg-white pt-4 p-4 rounded-3">
    <form method="post" action="<?= base_url("booking/update/$r->id") ?>">
        <div class="col-md-12 mb-5">
            <h5>تعديل موعد الحجز</h5>
        </div>


        <?php if (request()->get("error")): ?>
            <div class="alert alert-danger">يجب ملئ كافة الحقول .</div>
        <?php endif; ?>

        <?php if (request()->get("success")): ?>
            <div class="alert alert-success">تم التعديل بنجاح</div>
        <?php endif; ?>

        <div class="col-md-12 mb-4">

            <label>تاريخ الحجز</label>

            <select name="date" class="select_date form-control mb-4 mt-1">
                <option  value="">حدد  تاريخ الحجز</option>


                <?php
                $dates = DB::table("tb_feature")->where("feature", 15)->where("section", $r->service)->where([["title", ">=", RC_dateCurrent("d-m-Y")]])->get();
                ?>

                <?php foreach ($dates as $date): ?>
                    <option <?= ($r->date == $date->id) ? "selected=''" : "" ?> value="<?= $date->id ?>">
                        <?php
                        $date_tittle = RC_trans($date->title);
                        if ($date_tittle == RC_dateCurrent("d-m-Y")) {
                            $date_tittle = "اليوم";
                        }
                        if ($date_tittle == RC_dateTomorrow("d-m-Y")) {
                            $date_tittle = "غدا";
                        }
                        if ($date_tittle == RC_dateAfterTomorrow("d-m-Y")) {
                            $date_tittle = "بعد غد";
                        }
                        echo $date_tittle;
                        ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>



        <div class="col-md-12 ">
            <label>وقت الحجز</label>
            <?php
            $times = explode(",", @RC_feature($r->date)->details);
            ?>
            <select name="time" class="select_time form-control mb-4 mt-1">
                <option value=''>حدد وقت الحجز</option>
                <?php foreach ($times as $time): ?>
                    <option <?= ($time == $time) ? "selected=''" : "" ?> value='<?= $time ?>'><?= $time ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="col-md-12 text-center mt-3">
            <button type="submit" value="1" name="submit" class="btn btn-primary">تعديل</button>
        </div>
    </form>
</div>