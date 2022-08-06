<footer class="bg-dark text-white pt-5 pb-5 border-top">
    <div class="container">
        <div class="footer-copyright pt-15 pb-15">
            <div class="row">
                <div class="col-lg-12">


                    <div class="text-center mb-4 d-none d-sm-block">
                        <div class="navbar navbar-expand-lg mt-3 m-auto text-center d-inline-block" >
                            <?= view(url_layout("menu")) ?>
                        </div>
                    </div>

                    <div class="wrap_social text-center mb-4">
                        <?php
                        $Qsocial = DB::table("tb_feature")->where("feature", 3)->get();
                        ?>
                        <?php foreach ($Qsocial as $Rsocial): ?>
                            <a target="_blank" href="<?= $Rsocial->content ?>"><i class="<?= $Rsocial->details ?>"></i></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center text-muted mb-4 mt-3">
                        جميع الحقوق محفوظة لموقع 
                        <?= settings("title", "ar") ?>
                        @ <?= date("Y") ?>
                    </div>

                    <div class="copyright text-muted text-center">
                        <p>
                            تصميم وبرمجة : 
                            <a class="text-muted" target="_blank" href="https://rocsel.com" >روكسل</a>
                        </p>
                    </div> 
                </div>
            </div> 
        </div> 
    </div>
</footer>
<!--<div class="p-3 ">
    <a href="#" class="back-to-top btn btn-primary mb-2 mr-3"><i class="fas fa-arrow-up"></i></a>
</div>-->



<!--  search  modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    بحث
                </h5>
                <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="get" action="<?= base_url("post") ?>">
                    <div class="mt-4">
                        <input name="title"  type="text" class="form-control mb-3" value="<?= (uri(1) == "post" && request()->get("title")) ? request()->get("title") : "" ?>" style="height: 55px;" placeholder="إكتب ما تريد البحث عنه .."  aria-describedby="button-addon1">

                        <select name="city" class="form-select mb-3" id="inputGroupSelect01">
                            <option value="" >المدينة...</option>
                            <?php
                            $Qcity = DB::table("tb_feature")->where("feature", 5)->get();
                            ?>
                            <?php foreach ($Qcity as $Rcity): ?>
                                <option <?= (uri(1) == "post" && request()->get("city") == $Rcity->id) ? "selected" : "" ?> value="<?= $Rcity->id ?>"><?= RC_trans($Rcity->title) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select name="section" class="form-select mb-3" id="inputGroupSelect01">
                            <option value="" > التخصص...</option>
                            <?php
                            $Qsection = DB::table("tb_feature")->where("feature", 8)->get();
                            ?>
                            <?php foreach ($Qsection as $Rsection): ?>
                                <option  <?= (uri(1) == "post" && request()->get("section") == $Rsection->id) ? "selected" : "" ?> value="<?= $Rsection->id ?>"><?= RC_trans($Rsection->title) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="text-center">
                            <button class="btn btn-lg btn-dark fs-6 mb-3" name="search" value="1" type="submit" id="button-addon1">بحث</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END  search  modal  -->


<!--  refused  modal -->
<div class="modal fade" id="refusedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    إلغاء الحجز
                </h5>
                <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close"> 
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="">
                    <div class="mt-4">
                        <textarea  class="form-control mb-3" required="" style="height: 100px;" placeholder="أدخل سبب إلغاء الحجز" name="refused"></textarea>
                        <div class="text-center">
                            <button class="btn btn-lg btn-dark fs-6 mb-3" value="1" type="submit" id="button-addon1">إلغاء الحجز</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END  search  modal  -->