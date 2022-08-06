<div class="col-md-<?= (isset($col)) ? $col : "3" ?> <?= (uri(1) == "home")?"":"col-6" ?>  mt-3 mb-4">
    <a href="<?= base_url("hospital/v/{$r->parent}") ?>">
        <div class="border rounded-3 position-relative" style="height: 160px;overflow: hidden">
            <small class="bg-danger text-white position-absolute rounded-3 p-1 top-10 left-10"><?= $r->discount ?>% خصم</small>
            <?php
            $user = user($r->user);
            $image = @$user->image;
            if ($r->image):
                $image = $r->image;
            endif;
            ?>
            <img src="<?= image_micro($image) ?>" class="card-img-top " alt="<?= RC_trans($r->title) ?>">
        </div>
        <div class="row">
            <div class="col-12">
                <h5 class="mt-2 mb-1 fs-6 text-primary"><?= RC_trans($r->title) ?></h5>
                <div class="mt-2">
                    <del class="text-secondary"><?= $r->price ?> ريال</del>
                    <span class="text-dark d-inline-block ms-3">
                        <?php
                        if ($r->discount > 0):
                            echo $r->price - ($r->price * ($r->discount / 100));
                        endif;
                        ?> ريال</span>
                </div>
            </div>
        </div>
    </a>
</div>
