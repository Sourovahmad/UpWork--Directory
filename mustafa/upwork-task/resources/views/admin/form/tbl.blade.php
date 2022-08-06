<?php if (request()->get("ajax") != 1): ?>
    <div class="col-md-12">
        <div class="row wrap_tbl_search">
            <?php if (isset($search) && $search): ?>
                <?php foreach ($search as $k => $v): ?>
                    <div class="col-md-2 mb-2">
                        <input type="text" name="<?= $k ?>" class="border-grey-light form-control" placeholder="<?= $v["title"] ?>" />
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="row container_tbl">
        <?php endif; ?>
        <div class="col-sm-12 overflow-auto <?= $wrap_class ?>">


            <?php if (!empty($rows)): ?>
                <table class="table table-striped table-bordered datatable dataTable no-footer <?= $class ?>" <?= $data ?> id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" style="border-collapse: collapse !important">

                    <thead>
                        <tr role="row"> 
                            <?php if ($checkbox == true): ?>
                                <th style="width: 38px"><input class="check_all" rel="" type="checkbox" /></th>
                            <?php endif; ?>
                            <?php $x = 1; ?>
                            <?php foreach ($thead as $item): ?>
                                <?php $align = (count($thead) == $x) ? "text-left" : "" ?>
                                <th style="<?= @$item["features"]["th_style"] ?>" class="sorting_asc <?= @$item["features"]["th_class"] ?>  <?= (@$item["features"]["align"]) ? "text-" . @$item["features"]["align"] : $align ?> " ><?= $item["text"] ?></th>
                                <?php $x++ ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($rows as $row): ?>
                            <tr role="row" class="odd">
                                <?php $x = 1; ?>
                                <?php foreach ($row as $col): ?> 
                                    <?php if ($x == 1 && $checkbox == true): ?>
                                        <td><input type="checkbox" class="check_child_" name="id[]" value="<?= $col["id"] ?>" /></td>
                                    <?php endif; ?>
                                    <?= $align = ""; ?>
                                    <?php $align = (count($row) == $x) ? "text-left" : "" ?>
                                    <td style="<?= @$item["features"]["style"] ?>" class="<?= @$item["features"]["class"] ?> <?= (@$col["features"]["align"]) ? "text-" . @$col["features"]["align"] : $align ?> " ><?= $col["text"] ?></td>
                                    <?php $x++ ?>
                                <?php endforeach; ?>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>

                <div class="text-center pt-5 pb-5">
                    لا توجد بيانات متاحة الآن
                </div>

            <?php endif; ?>
        </div>
        <?php if (request()->get("ajax") != 1): ?>
        </div>

        <?php if (!empty($rows)): ?>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <!--data-toggle="modal"  data-target="#dangerModal"-->
                    <button type="button" class="btn btn-danger mb-2 val RC_table_delete_rows" >حذف المحدد</a>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                        <?= view('admin/form/pagination', ["paginator" => $pagination]) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
<?php endif; ?>



<div class="modal fade" id="dangerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger" role="document">
        <?php
        $settings = (request()->segment(1) == "rc-admin" && request()->segment(2) == "settings") ? "settings/" : "";
        ?>
        <form action="<?= RC_url($settings . RC_uri(1) . "/delete") ?>" method="post">
            @csrf
            <input type="hidden" value="" name="id" />
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">رسالة إدارية تحذيرية</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>هل تريد حذف المحدد بالفعل ؟</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary pr-3 pl-3" type="button" data-dismiss="modal">لا</button>
                    <button class="btn btn-danger" type="submit">نعم</button>
                </div>
            </div>
        </form>
    </div>
</div>

