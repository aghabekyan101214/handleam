<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php";?>
</head>

<body data-ma-theme="indigo">
<main class="main">
    <?php require "inc/header.php"?>

    <?php require "inc/aside.php"?>

    <section class="content">
        <div class="content__inner content__inner--sm" style="max-width:1100px;">
            <div class="col-md-12">
                <br>
                <h4>Օգտագործման պայմաններ </h4>
                <br>
            </div>
            <?php $privacy = $cnt->getPages(["type"=>'privacy']); ?>
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h6><b><?php echo $privacy['title_am']?></b></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control live" data-live="pages, title_am, id, <?php echo $privacy['id']?>" value="<?php echo $privacy['title_am']?>" placeholder="Անվանում АМ">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control live" data-live="pages, title_en, id, <?php echo $privacy['id']?>" value="<?php echo $privacy['title_en']?>" placeholder="Անվանում EN">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control live" data-live="pages, title_ru, id, <?php echo $privacy['id']?>" value="<?php echo $privacy['title_ru']?>" placeholder="Անվանում RU">
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <textarea class="form-control live" data-live="pages, descr_am, id, <?php echo $privacy['id']?>" placeholder="Նկարագրություն AM" style="min-height:200px"><?php echo $privacy['descr_am']?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <textarea class="form-control live" data-live="pages, descr_en, id, <?php echo $privacy['id']?>" placeholder="Նկարագրություն EN" style="min-height:200px"><?php echo $privacy['descr_en']?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <textarea class="form-control live" data-live="pages, descr_ru, id, <?php echo $privacy['id']?>" placeholder="Նկարագրություն RU" style="min-height:200px"><?php echo $privacy['descr_ru']?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-12 p-2"></div>
                    </div>
                </div>
            </div>
            <div class="p-1"></div>
        </div>

        <?php require "inc/footer.php"?>

    </section>
</main>

</body>
</html>