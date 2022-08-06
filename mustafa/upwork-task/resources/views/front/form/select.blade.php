<div class="col-md-<?= $col ?> <?= $wrap_class ?> mb-3">
    <div class="form-group">
        <?php if ($title != null): ?>
            <label class="col-form-label" for="input_{{$name}}">
                <?= $title ?>
            </label>
        <?php endif; ?>

        <select <?= ($ajax_column) ? "col='$ajax_column'" : "" ?> <?= ($ajax_relation) ? "rel='$ajax_relation'" : "" ?> <?= ($ajax_table) ? "tbl='$ajax_table'" : "" ?>  <?= ($ajax) ? "ajax='{$ajax}'" : "" ?>  <?= $data ?> id="input_{{$name}}" class="form-control select2 <?= $class ?>">
            <option value="" ><?= @$placeholder ?></option> 
            <?php
            if ($option):
                if ($option && !empty($option) && is_array($option)):
                    foreach ($option as $k => $v):
                        $selected = ($k == $value) ? "selected='selected'" : "";
                        if (is_array($v)):
                            echo "<option data-icon='" . @$v[1] . "' {$selected} value='{$k}'>" . @$v[0] . "</option>";
                        else:
                            echo "<option {$selected} value='{$k}'>{$v}</option>";
                        endif;

                    endforeach;
                endif;
            endif;
            if ($q):
                foreach ($q->get() as $r):
                    $selected = ($r->$key == $value) ? "selected='selected'" : "";
                    echo "<option  {$selected} value='{$r->$key}'>" . RC_trans($r->$column) . "</option>";
                endforeach;
            endif;
            ?>

        </select>

        <?php if ($error): ?>
            <div class="text-danger"><?= $error ?></div>
        <?php endif; ?>
    </div>
</div>
<?php if ($inline == false): ?>
    <div class="col-md-12"></div>
<?php endif; ?>
