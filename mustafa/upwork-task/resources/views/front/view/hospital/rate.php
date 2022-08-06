<?php
$user = user($r->user);
?>
<div class="row pt-3 mt-5 border-top">
    <div class="col-md-9 text-primary">
        <h5><?= $user->username ?></h5>
    </div>
    <div class="col-md-3 text-end">
        منذ 
        <?= RC_date($r->date_insert) ?>
    </div>

    <div class="col-md-12">
        <div class="mb-1 wrap_stars_<?= $r->val ?>">
            <i class="fas fa-star "></i> 
            <i class="fas fa-star "></i> 
            <i class="fas fa-star "></i> 
            <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i> 
        </div>
    </div>
    <div class="col-md-12 text-secondary mt-2"><?= $r->content ?></div>

</div>