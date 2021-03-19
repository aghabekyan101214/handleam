<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Handle | <?= $cnt->val['shop'] ?></title>
    <?php include "layouts/default/inc/head.php"; ?>

</head>
<body>
<div class="canvas-wrapper">
    <div class="content-wrap">
        <div class="content">
            <?php include "layouts/default/inc/header.php"; ?>
            <?php $categories = $cnt->getCat(['page_type' => ($_GET['page_type'] ?? 0)]); ?>
            <?php $goodsTypes = $cnt->getGoodsType(['filter_in_categories' => array_column($categories, 'id')]); ?>
            <!-- breadcrumbs start -->
            <div class="breadcrumbs-area breadcrumb-bg pt-120 pb-50">
                <div class="container">
                    <div class="breadcrumbs text-center">
                        <h2 class="breadcrumb-title"><?= $cnt->val['shop'] ?></h2>
                        <ul>
                            <li>
                                <a class="active" href="default.php"><?= $cnt->val['home'] ?></a>
                            </li>
                            <li><?= $cnt->val['shop'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs area end -->
            <!-- login area end -->
            <div class="shop-page-area pt-60 pb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="blog-sidebar">
                                <div class="single-sidebar">
                                    <h3 class="sidebar-title"><?= $cnt->val['choose_price'] ?></h3>
                                    <div class="price-filter">
                                        <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" style="display:none;">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"
                                                 style="left: 0%; width: 100%;"></div>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                                  style="left: 0%;"></span><span
                                                    class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                                    style="left: 100%;"></span>
                                        </div>
                                        <div class="price-slider-amount">
                                            <input type="text" id="amount" name="price" style="display:none;">
                                            <input type="number" id="amount_start" name="amount_start" style="background:#eceff8;border:2px solid #eceff8;width:49%;padding:7px;" placeholder="<?= $cnt->val['from'] ?>">
                                            <input type="number" id="amount_end" name="amount_end" style="background:#eceff8;border:2px solid #eceff8;width:49%;padding:7px;" placeholder="<?= $cnt->val['to'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="single-sidebar">
                                    <h3 class="sidebar-title"><?= $cnt->val['category'] ?></h3>
                                    <div class="sidebar-list">
                                        <ul>
                                            <?php $lang = $_SESSION['lang'];
                                            foreach ($categories as $key => $value) { ?>
                                                <li>
                                                    <label>
                                                        <input class="cat" data-id="<?= $value['id'] ?>"
                                                               type="radio" name="cat" <?php if(@$_GET['cat'] == $value['id']){echo "checked";} ?>>
                                                        <span style="margin-left:8px;"><?= $value['title_' . $lang] ?></span>
                                                    </label>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-sidebar">
                                    <h3 class="sidebar-title"><?= $cnt->val['choose_type'] ?></h3>
                                    <div class="sidebar-list">
                                        <ul>
                                            <?php $lang = $_SESSION['lang'];
                                            foreach ($goodsTypes as $key => $value) { ?>
                                                <li class="goods-type type-<?= $value['catID'] ?>">
                                                    <label>
                                                        <input class="type" data-id="<?= $value['id'] ?>"
                                                               type="checkbox">
                                                        <span style="margin-left:8px;"><?= $value['title_' . $lang] ?></span>
                                                    </label>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <?php $banners = $cnt->getBanner(["type"=>"aside", "orderby_rand"=>true, "limit"=>'1']);?>
                            <?php if(count($banners) > 0){?>
                            <div class="blog-sidebar mt-40">
                                <?php foreach($banners as $banner) {?>
                                <?php $photo = $cnt->getPhoto("banner", $banner["id"], 1);?>
                                <div class="single-sidebar" style="padding:20px 15px;">
                                    <a href="<?=$banner["link"]?>" target="_blank">
                                        <h3 class="sidebar-title" style="margin-bottom:5px;"><?= $banner['title']?></h3>
                                        <?php if(isset($photo['photoID'])){?>
                                        <img src="/public/gallery/<?php echo $photo["group"]?>/<?php echo $photo['photoID']?>.gif" style="width:100%;">
                                        <?php }?>
                                    </a>
                                </div>
                                <?php }?>
                            </div>
                            <?php }?>
                        </div>


                        <div class="col-md-9">
                            <div class="blog-wrapper shop-page-mrg">
                                <div class="tab-menu-product">
                                    <!--
									<div class="tab-menu-sort">
										<div class="tab-menu">
											<ul role="tablist">
												<li class="active">
													<a href="#grid" data-toggle="tab">
														<i class="fa fa-th-large"></i>
														<?= $cnt->val['grid'] ?>
													</a>
												</li>
												<li>
													<a href="#list" data-toggle="tab">
														<i class="fa fa-align-justify"></i>
														<?= $cnt->val['list'] ?>
													</a>
												</li>
											</ul>
										</div>
									</div>
									-->
                                    <div class="tab-product">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="grid">
                                                <div class="row">
                                                </div>
                                            </div>

                                            <!-- <div class="page-pagination text-center">
                                                <ul>
                                                    <li><a class="active" href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                                                </ul>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- login area end -->

            <?php include "layouts/default/inc/footer.php"; ?>
</body>
</html>
