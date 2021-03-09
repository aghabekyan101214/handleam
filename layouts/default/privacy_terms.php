<!doctype html>
<html class="no-js" lang="">
<head>
    <title>Handle | <?= $cnt->val['privacy_terms'] ?></title>
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
                        <h2 class="breadcrumb-title"><?= $cnt->val['privacy_terms'] ?></h2>
                        <ul>
                            <li>
                                <a class="active" href="/"><?= $cnt->val['home'] ?></a>
                            </li>
                            <li><?= $cnt->val['privacy_terms'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="about-area pt-70 pb-0">
                <div class="container">
                    <p class="terms-title"><?= $cnt->getPages(["type" => "privacy"])['title'] ?></p>
                    <p class="terms-descr"><?= nl2br($cnt->getPages(["type" => "privacy"])['descr'])?></p>
                </div>
            </div>
            <?php include "layouts/default/inc/footer.php"; ?>
</body>
</html>
