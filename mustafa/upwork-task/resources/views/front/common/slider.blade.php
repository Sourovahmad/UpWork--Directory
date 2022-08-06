<div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
    <div class="carousel-inner">


        <?php
        $x = 0;
        $q = DB::table("tb_feature")->where("feature", 4)->get();
        ?>
        <?php foreach ($q as $r): ?>
        <div class="carousel-item <?=($x == 0)?"active":""?> wrap_slider" >
                <img class="d-block w-100 " src="<?= image_larg($r->image) ?>" alt="First slide">
            </div>
        <?php $x++;?>
        <?php endforeach; ?>
    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
</div>