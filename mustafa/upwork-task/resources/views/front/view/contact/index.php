<div class="pt-4 bg-light">

    <div class="container wrap_container mt-5">

        <div class="four mb-3 text-right">
            <h1 class="text-center fs-3 mb-3 text-primary title d-inline-block">
                إتصل بنا
            </h1>
        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="bg-white pt-4 p-4 rounded-3">
                    <?php if (request()->get("save") == true): ?>
                        <div class="alert alert-success">تم إرسال رسالتك الي الإدارة بنجاح .</div>
                    <?php endif; ?>

                    <div class="row">
                        <?= $content ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-white p-3 rounded-3">
                    <div class="mx-3 mt-3 ">
                        <?php if (settings("mobile")): ?>
                            <div class="mb-4">
                                <a class="text-dark" href="tel:<?= settings("mobile") ?>">
                                    <i class="fas fa-phone-volume"></i>
                                    <?= settings("mobile") ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (settings("whatsapp")): ?>
                            <div class="mb-4">
                                <a class="text-dark" href="https://wa.me/<?= settings("whatsapp") ?>?text=">
                                    <i class="fab fa-whatsapp"></i>
                                    <?= settings("whatsapp") ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <a class="text-dark" href="mailto:<?= settings("email") ?>">
                                <i class="far fa-envelope"></i>
                                <?= settings("email") ?>
                            </a>
                        </div>

                        <?php
                        $q = DB::table("tb_feature")->where("feature", 3)->get()
                        ?>
                        <?php foreach ($q as $r): ?>
                            <div class="mb-4">
                                <a class="text-dark" target="_blank" href="<?= $r->content ?>">
                                    <i class="<?= $r->details ?>"></i>
                                    <?= RC_trans($r->title) ?>
                                </a>
                            </div>
                        <?php endforeach; ?>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
