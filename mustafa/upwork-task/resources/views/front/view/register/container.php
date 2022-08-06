<div class="pt-4 bg-light">

    <div class="container wrap_container mt-5">

        <h1 class="text-center fs-3 mb-5 pt-4 text-dark text-center mb-3 title">
            <?= $title ?>
        </h1>


        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="bg-white pt-4 p-4 rounded-3">
                    <?php if (request()->get("save") == true): ?>
                        <?php if (request()->get("type") == 2): ?>
                            <div class="alert alert-success">تم تسجيل العضوية بنجاح , وجاري مراجعتها من قبل الإدارة</div>
                        <?php else: ?>
                            <div class="alert alert-success">تم تسجيل العضوية بنجاح رجاء اللي الرجوع الى  البريد الإلكتروني الخاص بك لتفعيل حسابك .</div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="row">
                        <?= $content ?>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>