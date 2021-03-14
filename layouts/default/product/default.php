<?php 
$id = $url->PAGE; 
if(!isset($id) || empty($id)) {
    header('location: /shop');
    exit;
} else {
   $goods = $cnt->getGoods(["id"=>$id]);
   if(!isset($goods['id']) || empty($goods['id'])) { 
       header('location: /shop');
       exit;
   }
}
$goods_price = $goods['price'];
?>


<!doctype html>
<html class="no-js" lang="">
<head>
    <title>Handle | <?=$cnt->val['about']?></title>
    <?php include "layouts/default/inc/head.php"; ?>
    
    <link rel="stylesheet" href="/public/lib/cloudzoom/cloudzoom.css">
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
                        <h2 class="breadcrumb-title"><?=$goods['title']?></h2>
                        <ul>
                            <li>
                                <a class="active" href="/"><?=$cnt->val['home']?></a>
                            </li>
                            <li><?=$goods['title']?></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            <div class="container ptb-100" style="padding-left:20px;padding-right:20px;">
                <div class="row">
                    <div id="view-gallery">
                        <div class="col-xs-12">
                            <div class="d-table">
                                <div class="d-tablecell">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-7">
                                            <div class="quick-image">
                                                <div class="single-quick-image tab-content text-center" style="border:1px solid #eee;margin-bottom:10px;">
                                                   <?php $i=0; foreach($cnt->getPhoto("goods", $goods['id']) as $photos) { $i++; ?>
                                                    <div class="tab-pane  fade in <?php if($i == 1) { echo 'active'; }?>" id="sin-pro-<?=$i?>">
                                                        <img class="cloudzoom" src="/public/gallery/<?= $photos['group']?>/large/<?= $photos['photoID'] ?>.jpg" alt=""  data-cloudzoom="zoomImage:'/public/gallery/<?= $photos['group']?>/large/<?= $photos['photoID'] ?>.jpg'"/>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                                <div class="quick-thumb" style="margin-left:0;">
                                                    <div class="nav nav-tabs">
                                                        <ul>
                                                         <?php $i=0; foreach($cnt->getPhoto("goods", $goods['id']) as $photos) { $i++; ?>   
                                                            <li style="float:left;width:24%;margin:0.5%;border:1px solid #eee;">
                                                                <a data-toggle="tab" href="#sin-pro-<?=$i?>">
                                                                    <img src="/public/gallery/<?= $photos['group']?>/small/<?= $photos['photoID'] ?>.jpg" alt="quick view"  style="max-width:100%;padding:0;">
                                                                </a>
                                                            </li>
                                                            <?php }?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-5">
                                            <div class="quick-right">
                                                <div class="quick-right-text">
                                                    <h3><strong><?=$goods['title']?></strong></h3>
                                                    <div class="amount">
                                                        <?php if($goods['discount']>0){?>
                                                        <h4><span style="text-decoration:line-through;margin-right:15px;"><?=$goods_price?> ֏ </span> <?=$goods_price-($goods_price/100*$goods['discount'])?> ֏</h4>
                                                        <?php }else{?>
                                                        <h4><?=$goods_price?> ֏</h4>
                                                        <?php }?>
                                                    </div>
                                                    <p style="border-bottom:0px">
                                                    <?php if(isset($cnt->getGoodsType(["id" => $goods['typeID']])["title"])){?>
                                                    <b><?=$cnt->getGoodsType(["id" => $goods['typeID']])["title"]?></b>
                                                    <br>
                                                    <br>
                                                    <?php }?>
                                                    <?=$goods['descr']?>
                                                    </p>

                                                    <div class="dse-btn">
                                                        <div class="row">
                                                            <!--
                                                            <div class="col-sm-12 col-md-12">
                                                                <div class="por-dse clearfix">
                                                                    <ul>
                                                                        <li class="share-btn clearfix">
                                                                            <span><?=$cnt->val['quantity']?></span>
                                                                            <input class="input-text qty" name="qty" maxlength="12" value="1" type="text">
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            -->
                                                            <div class="col-sm-12 col-md-12">
                                                                <div class="por-dse add-to">
                                                                    <a class="add-to-cart" data-id="<?php echo $goods['id']?>"  ><i class="pe-7s-cart"></i> <?=$cnt->val['add_cart']?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            

        <!-- about end -->
        <?php include "layouts/default/inc/footer.php"; ?>
            
        <script src="/public/lib/cloudzoom/cloudzoom.js"></script>
        <script>
        if($(window).width() >= 780){
            CloudZoom.quickStart();

            $(function(){
                $('.cloudzoom').bind('click',function(){
                    var cloudZoom = $(this).data('CloudZoom');
                    cloudZoom.closeZoom();
                    $.fancybox.open(cloudZoom.getGalleryList());
                    return false;
                });
            });
        }
        </script>
</body>
</html>
