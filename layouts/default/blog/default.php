<?php
     $id = $url->PAGE; 
    if(!isset($id) || empty($id))  {
    header('location: /'); exit;
  } else {
   $blog = $cnt->getBlog(["id"=>$id]);
   if(!isset($blog['id'])) { header('location: /'); exit;}
 }
 $photo = $cnt->getPhoto("blog", $blog['id'], 1);  
 $cnt->addView("blog", $blog['id']);
?>
<!doctype html>
<html>
<head>
    <title>Handle | <?=$cnt->val['blog']?></title>
    <?php include "layouts/default/inc/head.php"; ?>
</head>
<body>
<div class="canvas-wrapper">
    <div class="content-wrap">
        <div class="content">
            <?php include "layouts/default/inc/header.php"; ?>
            <!-- breadcrumbs start -->
            <div class="breadcrumbs-area breadcrumb-bg ptb-100">
                <div class="container">
                    <div class="breadcrumbs text-center">
                        <h2 class="breadcrumb-title"><?=$cnt->val['blog']?></h2>
                        <ul>
                            <li>
                                <a class="active" href="/"><?=$cnt->val['home']?></a>
                            </li>
                            <li><?=$cnt->val['blog']?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs area end -->
            <div class="about-area pt-100 pb-70">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-30">
                            <div class="about-all">
                                <h2><?=$blog['title']?></h2>
                                <p><?=nl2br($blog['descr'])?></p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-30">
                            <div class="about-img">
                                <img alt="" src="/public/gallery/blog/large/<?=$photo['photoID']?>.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "layouts/default/inc/footer.php"; ?>
</body>
</html>
