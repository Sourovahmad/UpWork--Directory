<!-- login modal  -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    تسجيل دخول
                </h5>
                <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("logging/login") ?>" method="post" id="form_login">

                    <div class="proccess_login"></div>

                    <div class="row mb-3">
                        <div class="col-md-4 mt-1 mb-1">
                            البريد الإلكتروني
                        </div>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control"  />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-1 mb-1">
                            كلمة المرور
                        </div>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 ">
                            <button type="button"  data-target="#register_type" data-toggle="modal"  data-dismiss="modal" aria-label="Close" class="btn btn-dark btn-lg fs-6 ">عضوية جديدة</button>
                        </div>
                        <div class="col-6 text-end ">
                            <button type="button"  class="btn btn-primary btn-lg fs-6 btn_login">تسجيل دخول</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="border-top text-center p-3">
                <a data-toggle="modal" data-target="#losspassModal" class="text-dark " data-dismiss="modal" aria-label="Close" href="javascript:void(0)">إستعادة كلمة المرور</a>
            </div>
        </div>
    </div>
</div>
<!-- END   login modal  -->


<!-- register_type modal  -->
<div class="modal fade" id="register_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    إختر نوع العضوية
                </h5>
                <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="text-center mt-3 mb-2 row">
                    <div class="col-6">
                        <a data-toggle="modal" data-target="#register" class="btn btn-primary btn-lg d-block fs-6" data-dismiss="modal" aria-label="Close" href="javascript:void(0)">
                            عضوية عميل
                        </a> 
                    </div>
                    <div class="col-6">
                        <a href="<?= base_url("register?type=2") ?>"  class="btn btn-primary d-block btn-lg fs-6">عضوية مقدم خدمة</a>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
<!-- END   login modal  -->


<!-- losspass modal  -->
<div class="modal fade" id="losspassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    إستعادة كلمة المرور
                </h5>
                <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= base_url("logging/losspass") ?>" id="form_losspass" method="post">
                    <div class="process_losspass"></div>
                    <div class="row mb-4 mt-3">
                        <div class="col-md-12 mt-1 mb-1">
                            البريد الإلكتروني
                        </div>
                        <div class="col-md-12">
                            <input type="email" name="email" class="form-control"  />
                        </div>
                    </div>


                    <div class="text-center mt-4 mb-4">
                        <button type="button" ajax=".process_losspass" form="#form_losspass" class="btn btn-primary btn-lg fs-6">إستعادة</button>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>
<!-- END   losspass modal  -->




<!-- register  -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    عضوية جديدة
                </h5>
                <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("register/ajax") ?>" method="post" id="form_register">

                    <div class="proccess_register"></div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="mb-2">الإسم بالكامل</label>
                            <input type="text" name="username" class="form-control"  />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="mb-2">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control"  />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="mb-2">رقم الجوال</label>
                            <input type="text" name="mobile" class="form-control"  />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="mb-2">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="mb-2">تأكيد كلمة المرور</label>
                            <input type="password" name="repassword" class="form-control" />
                        </div>
                    </div>


                    <div class="row mb-3">           
                        <div class="col-md-12  ">
                            <div class="form-check checkbox mb-4">
                                <label class="form-check-label">
                                    <input name="role" type="checkbox" style="" placeholder="" value="1" class="form-check-input">
                                    <a class="text-dark" target="_blank" href="<?= base_url("pages/v/64") ?>">قبول الشروط والأحكام</a> 
                                </label>
                            </div>
                        </div>
                    </div>


                    <?php $code = rand(10000, 100000); ?>
                    <input name="code" type="hidden" value="<?= $code ?>" />
                    <input name="type" type="hidden" value="1" />

                    <div class="row mt-3 mb-3">
                        <div class="col-12 text-center ">
                            <button type="button"  class="btn btn-primary btn-lg fs-6 btn_register">إتمام التسجيل</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END   login modal  -->