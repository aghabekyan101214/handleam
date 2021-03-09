<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Handle | <?=$cnt->val["liquidation_prices"]?></title>
    <?php include "layouts/default/inc/head.php"; ?>
</head>
<body>
<div class="canvas-wrapper">
    <div class="content-wrap">
        <div class="content">
            <?php include "layouts/default/inc/header.php"; ?>
            <!-- breadcrumbs start -->
            <div class="breadcrumbs-area breadcrumb-bg ptb-50">
                <div class="container">
                    <div class="breadcrumbs text-center">
                        <h2 class="breadcrumb-title"><?=$cnt->val["liquidation_prices"]?></h2>
                        <ul>
                            <li>
                                <a class="active" href="/"><?= $cnt->val['home'] ?></a>
                            </li>
                            <li><?=$cnt->val["liquidation_prices"]?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs area end -->
            <!-- login area end -->
            <div class="shop-page-area pt-60 pb-20">
                <div class="container">
                    <div class="row">
                        <?php 
                            $getGoods = $cnt->getGoods(["discount_start"=>1, "orderby_rand"=>true]);
                            $goods = "";
                            foreach($getGoods as $goods) {
                            if($goods['discount'] > 0) {
                                $goods_price = $goods['price'];
                            } else {
                                $goods_price = $goods['price'];
                            } 
                            $photo = $cnt->getPhoto("goods", $goods['id'], 1);
                        ?>                
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-shop mb-20">
                                <div class="shop-img">
                                    <a href="/overlay/goods?goodsID=<?=$goods['id']?>" data-toggle="modal"><img src="/public/gallery/goods/small/<?=$photo['photoID']?>.jpg" alt=""/></a>
                                    <div class="shop-quick-view">
                                        <a href="/overlay/goods?goodsID=<?=$goods['id']?>">
                                        <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <?php if($goods['discount'] > 0) {?>
                                    <div class="price-up-down">
                                        <span class="sale-discount">-<?=$goods['discount']?>%</span>
                                    </div>
                                    <?php }?>
                                    <?php if ($goods['status']=='0'){?>
                                    <div class="price-up-down">
                                        <span class="not-stock"><?=$cnt->val['not_stock']?></span>
                                    </div>
                                    <?php }?>
                                    <?php if ($goods['status_new']=='1'){?>
                                    <div class="price-up-down">
                                        <span class="status-new"><?=$cnt->val['status_new']?></span>
                                    </div>
                                    <?php }?>
                                    <div class="button-group">
                                        <a class="plus add-to-cart" data-id="<?php echo $goods['id']?>" role="button" title="<?=$cnt->val['add_cart']?>">
                                        <i class="pe-7s-cart"></i>
                                        <?=$cnt->val['add_cart']?>
                                        </a>
                                    </div>
                                </div>
                                <div class="shop-text-all" style="min-height:100px;">
                                    <div class="title-color fix">
                                        <div class="shop-title f-left">
                                            <h3><a href="/product/<?=$goods['id']?>" target="_blank"><?=mb_substr($goods['title'], 0, 15)?></a></h3>
                                        </div>
                                        <span class="price f-right">
                                            <span class="new" <?php if($goods['discount']>0){?>style="text-decoration:line-through;"<?php }?>><?=$goods_price?> ֏</span>
                                        </span>
                                    </div>
                                    <div class="title-color fix">
                                        <div class="shop-title f-left">
                                            <span><?=@$cnt->getGoodsType(["id" => $goods['typeID']])["title"]?></span>
                                        </div>
                                        <?php if($goods['discount']>0){?>
                                        <span class="price f-right">
                                            <span class="new"><?=$goods_price-($goods_price/100*$goods['discount'])?> ֏</span>
                                        </span>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <!-- login area end -->

            <?php include "layouts/default/inc/footer.php"; ?>
</body>
</html>
