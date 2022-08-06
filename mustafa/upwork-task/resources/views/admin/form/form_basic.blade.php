<div class="col-md-12">
    <form method="POST" enctype="multipart/form-data" action="<?= $action ?>"> 
        @csrf
            <?= (isset($content)) ? $content : "" ?>
    </form>
</div>
