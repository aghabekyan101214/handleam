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
            <div class="card">
                <?php $admin = $cnt->getAdmin(1);?>
                <div class="card-block">
                    <h3>Մուտքային տվյալներ</h3>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control live" data-live="admin, email, adminID, <?php echo $admin['adminID']?>" value="<?php echo $admin['email']?>" placeholder="Մուտքանուն">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-12">
                            <input type="password" class="form-control live" data-live="admin, password, adminID, <?php echo $admin['adminID']?>" value="<?php echo $admin['password']?>" placeholder="Գաղտնաբառ">
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                </div>
                <br>
                <div class="p-3"></div>
            </div>
            <div class="p-1"></div>
        </div>

        <?php require "inc/footer.php"?>

    </section>
</main>

</body>
</html>