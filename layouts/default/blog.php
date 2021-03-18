<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Handle | <?=$cnt->val['blog']?></title>
    <?php include "layouts/default/inc/head.php"; ?>
</head>
<body>
<div class="canvas-wrapper">
    <div class="content-wrap">
        <div class="content">
            <!-- breadcrumbs start -->
            <?php include "layouts/default/inc/header.php"; ?>
            <div class="breadcrumbs-area breadcrumb-bg pt-120 pb-50">
                <div class="container">
                    <div class="breadcrumbs text-center">
                        <h2 class="breadcrumb-title"><?=$cnt->val['blog']?></h2>
                        <ul>
                            <li>
                                <a class="active" href="default.php"><?=$cnt->val['home']?></a>
                            </li>
                            <li><?=$cnt->val['blog']?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs area end -->
            <!-- blog area start -->
            <div class="blog-fullwidth-area ptb-100">
                <div class="container">
                    <div class="row">
                       <?php foreach($cnt->getBlog() as $blog) {
                        $photo = $cnt->getPhoto("blog", $blog['id'], 1);  ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="blog-details mb-30">
                                <div class="blog-img">
                                    <a href="blog/<?=$blog['id']?>"><img src="/public/gallery/blog/small/<?=$photo['photoID']?>.jpg" alt=""></a>
                                    <div class="blog-quick-view">
                                        <a href="blog/">
                                            <i class="pe-7s-link"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="blog-meta">
                                    <h4><a href="blog/<?=$blog['id']?>"><?=mb_substr($blog['title'],0 , 19).'...'?></a></h4>
                                    <ul class="meta">
                                        <li><i class="fa fa-calendar"></i> <?=$blog['date']?></li>
                                        <li><i class="fa fa-eye"></i> <?=$blog['view']?></li>
                                    </ul>
                                    <p><?=mb_substr($blog['descr'],0 , 90).'...'?></p>
                                    <a href="blog/<?=$blog['id']?>"><?=$cnt->val['read_more']?></a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                   <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="page-pagination text-center">
                                <ul>
                                    <li><a class="active" href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <!-- blog area end -->
            <?php include "layouts/default/inc/footer.php"; ?>
</body>
</html>
