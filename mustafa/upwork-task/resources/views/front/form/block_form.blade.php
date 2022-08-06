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
                <div class="bg-white pt-4 p-4 rounded-3">
                    <div class="row">
                        <?= (isset($content) && $content) ? $content : "" ?>
                    </div>
                    <div class="row">
                        <?php if ($button == "true"): ?>
                            <div class="col-md-12 mt-3">
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit" name="submit" value="1"><?= ($button_title) ? $button_title : "حفظ" ?></button>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
