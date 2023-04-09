<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4><?= $title ?></h4>
                            <span>Uñas, decoración, etc</span>
                            <div class="main-border-button">
                                <a href="#">Shop Now!</a>
                            </div>
                        </div>
                        <img src="public/img/left-banner-image.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        <?php
                        foreach ($collections as $collection) { ?>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4><?= $collection->name ?></h4>
                                            <span><?= $collection->description ?></span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4><?= $collection->name ?></h4>
                                                <p><?= $collection->description ?></p>
                                                <div class="main-border-button">
                                                    <a href="collection.php?name=<?= str_replace(' ', '-', $collection->name) ?>">Ver más</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="public/img/categories/<?= $collection->image ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->