<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>Handle | <?=$cnt->val['contact']?></title>
    <?php include "layouts/default/inc/head.php"; ?>
</head>
<body>
<div class="canvas-wrapper">
    <div class="content-wrap">
        <div class="content">
            <?php include "layouts/default/inc/header.php"; ?>
            <!-- breadcrumbs start -->
            <div class="breadcrumbs-area breadcrumb-bg pt-120 pb-50">
                <div class="container">
                    <div class="breadcrumbs text-center">
                        <h2 class="breadcrumb-title"><?=$cnt->val['contact']?></h2>
                        <ul>
                            <li>
                                <a class="active" href="/"><?=$cnt->val['home']?></a>
                            </li>
                            <li><?=$cnt->val['contact']?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- breadcrumbs area end -->
            <div id="contact-area" class="contact-area ptb-100 gray-bg">
                <div class="container">
                    <div class="section-title text-center mb-70">
                        <h2><?=$cnt->val['get_in_touch']?> <i class="fa fa-phone"></i></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-offset-2 col-lg-8 col-sm-12">
                            <div class="row">
                                <div class="col-md-5 col-lg-5 col-sm-5">
                                    <div class="contact-info-area">
                                        <ul>
                                            <li>
                                                <div class="contact-icon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <div class="contact-address">
                                                    <h5><?=$cnt->val['phone']?></h5>
                                                    <span> <?=$cnt->getContacts()['phone']?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="contact-icon">
                                                    <i class="fa fa-envelope-o"></i>
                                                </div>
                                                <div class="contact-address">
                                                    <h5><?=$cnt->val['email']?></h5>
                                                    <span><a> <?=$cnt->getContacts()['email']?></a></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="contact-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <div class="contact-address">
                                                    <h5><?=$cnt->val['address']?></h5>
                                                    <span> <?=$cnt->getContacts()['address']?></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-7 col-lg-7 col-sm-7">
                                    <div>
                                        <form class="form-ajax"   action="?cmd=sendMail" method="post">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="main-input mb-10">
                                                        <input name="name" placeholder="<?=$cnt->val['name_phd']?> *"
                                                               type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="main-input mrg-eml mrg-contact mb-10">
                                                        <input name="email" type="email"
                                                               placeholder="<?=$cnt->val['email_phd']?> *">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text-leave2 mb-20">
                                                        <textarea name="message" 
                                                                  placeholder="<?=$cnt->val['message_phd']?>"></textarea>
                                                    </div>
                                                </div>
                                                    <div class="col-md-12">
                                                         <div class="form-message"></div>
                                                         <br>
                                                    </div>
                                                <div class="col-md-12">
                                                    <button class="submit" type="submit" ><?=$cnt->val['send']?>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-map">
                <div style="width: 100%"><iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=40.184108, 44.505738&amp;q=Yerevan+(Handle)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed&amp;center=40.184108, 44.505738" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/map-my-route/">Map a route</a></iframe></div><br />
            </div>
            <?php include "layouts/default/inc/footer.php"; ?>
</body>
</html>