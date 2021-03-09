<!doctype html>
<html class="no-js" lang="">
<head>
    <title>Handle | <?=$cnt->val['about']?></title>
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
                        <h2 class="breadcrumb-title"><?=$cnt->val['about']?></h2>
                        <ul>
                            <li>
                                <a class="active" href="default.php"><?=$cnt->val['home']?></a>
                            </li>
                            <li><?=$cnt->val['about']?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs area end -->
                 <?php $photo1 = $cnt->getPhoto("pages", $cnt->getPages(["type"=>'about1'])['id'], 1);
                          $photo2 = $cnt->getPhoto("pages", $cnt->getPages(["type"=>'about2'])['id'], 1); ?>
            <!-- about start -->
            <div class="about-area pt-70 pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-30">
                            <div class="about-all">
                                <h2><?=$cnt->getPages(["type"=>'about2'])['title']?></h2>
                                <p><?=nl2br($cnt->getPages(["type"=>'about2'])['descr'])?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-30">
                            <div class="about-img">
                                <img alt="" src="/public/gallery/pages/<?=$photo1['photoID']?>.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="about-area pt-20 pb-70">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-30">
                            <div class="about-img">
                                <img alt="" src="/public/gallery/pages/<?=$photo2['photoID']?>.jpg">
                            </div>
                        </div>
                        <div class="col-md-6 mb-30">
                            <div class="about-all">
                              <h2><?=$cnt->getPages(["type"=>'about1'])['title']?></h2>
                                <p><?=nl2br($cnt->getPages(["type"=>'about1'])['descr'])?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about end -->
            <?php include "layouts/default/inc/footer.php"; ?>
</body>
</html>
