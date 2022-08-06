<?php
$user = user();
?>
<div class="pt-4 bg-light">
    <div class="container wrap_container mt-5">
        <div class="row">
            <div class="col-md-3">
                 <?= view(RC_urlForm("account_menu")) ?>
            </div> 
            <div class="col-md-9">
                <div class="row">
                    <?= (isset($content) && $content) ? $content : "" ?>
                </div>
            </div> 
        </div>
    </div>
</div>
