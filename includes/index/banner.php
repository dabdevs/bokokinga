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
                        foreach ($categories as $category) { ?>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4><?= $category->name ?></h4>
                                            <span><?= $category->description ?></span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                                <h4><?= $category->name ?></h4>
                                                <p><?= $category->description ?></p>
                                                <div class="main-border-button">
                                                    <a href="collection.php?name=<?= str_replace(' ', '-', $category->name) ?>&c=<?= $category->id ?>">Ver más</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="public/img/categories/<?= $category->image ?>">
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