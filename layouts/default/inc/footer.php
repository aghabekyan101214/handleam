<!-- footer area start -->
<footer class="footer-area">
    <div class="container">
        <div class="footer-top pt-60 pb-30">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-widget mb-30">
                        <div class="footer-logo">
                            <a href="/">
                                <img src="/public/assets/img/logo/handle-logo.png" alt="">
                            </a>
                        </div>
                        <div class="widget-info">
                            <p>
                                <i class="pe-7s-map-marker"> </i>
                                <span>
                                    <?=$cnt->getContacts()['address']?>
                                </span>
                            </p>
                            <p>
                                <i class="pe-7s-mail"></i>
                                <span>
                                    <a href="mailto:<?=$cnt->getContacts()['email']?>"><?=$cnt->getContacts()['email']?></a>
                                </span>
                            </p>
                            <p>
                                <i class="pe-7s-call"></i>
                                <span><?=$cnt->getContacts()['phone']?></span>
                            </p>
                        </div>
                        <div class="footer-social">
                            <ul>
                               <?php if($cnt->getContacts()['fb'] != '') {?>
                                <li><a href="<?=$cnt->getContacts()['fb']?>"><i class="fa fa-facebook"></i></a></li>
                                <?php }?>
                                <?php if($cnt->getContacts()['twitter'] != '') {?>
                                <li><a href="<?=$cnt->getContacts()['twitter']?>"><i class="fa fa-twitter"></i></a></li>
                                <?php }?>
                                <?php if($cnt->getContacts()['google'] != '') {?>
                                <li><a href="<?=$cnt->getContacts()['google']?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php }?>
                                <?php if($cnt->getContacts()['instagram'] != '') {?>
                                <li><a href="<?=$cnt->getContacts()['instagram']?>"><i class="fa fa-instagram"></i></a></li>
                                <?php }?>
                                <?php if($cnt->getContacts()['pinterest'] != '') {?>
                                <li><a href="<?=$cnt->getContacts()['pinterest']?>"><i class="fa fa-pinterest-p"></i></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-widget mb-30">
                        <div class="footer-title">
                            <h3><?=$cnt->val['site_map']?></h3>
                        </div>
                        <div class="widget-text">
                            <ul>
                                <li><a href="/shop"><?=$cnt->val['shop']?></a></li>
                                <li><a href="/sell-out"><?=$cnt->val['liquidation_prices']?></a></li>
                                <li><a href="/about"><?=$cnt->val['about']?></a></li>
                                <li><a href="/blog"><?=$cnt->val['blog']?></a></li>
                                <li><a href="/contact"><?=$cnt->val['contact']?></a></li>
                                <li><a href="/privacy_terms"><?=$cnt->val['privacy_terms']?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="footer-widget mb-30">
                        <div class="footer-title">
                            <h3><?=$cnt->val['blog']?></h3>
                        </div>
                        <div class="row">
                             <?php foreach($cnt->getBlog(["limit"=>'4']) as $blog) {
                             $photo = $cnt->getPhoto("blog", $blog['id'], 1); ?>
                            <div class="col-md-6">
                                <?php if(isset($photo['photoID'])){?>
                                <a href="/blog/<?=$blog['id']?>">
                                    <img style="height:90px;border:1px solid #eee;" src="/public/gallery/blog/small/<?=$photo['photoID']?>.jpg" alt="news">
                                </a>
                                <?php }?>
                                <p><a href="/blog/<?=$blog['id']?>" style="font-size:12px;"><?=mb_substr($blog['title'],0 , 15).'...'?></a></p>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <div class="footer-bottom ptb-20">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="copyright">
                        <p> Copyright © <?=date("Y")?> <a href="#">Handle.am </a>Created by <a href="https://unisoft.am/" target="_blank"><img class="vertica_sub" src="http://unisoft.am/img/logo-copyright/dark.png" height="29"></a></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="payment f-right">
                        <ul>
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                            <li><a href="#"><img src="/public/assets/img/logo/idram logo_rgb.png" alt="" style="display: block;height: 22px;"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->
<!-- quick view end -->
</div>
<!-- content end -->
</div>
<!-- content-wrap end -->
</div>

<!-- all js here -->
<!-- external javascripts -->
<script src="/public/js/jquery-2.2.4.min.js"></script>
<script src="/public/lib/jquery/jquery.form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script src="/public/assets/js/snap.svg-min.js"></script>
<script src="/public/assets/js/bootstrap.min.js"></script>
<script src="/public/assets/js/jquery.meanmenu.js"></script>
<script src="/public/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/public/assets/js/isotope.pkgd.min.js"></script>
<script src="/public/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="/public/assets/js/owl.carousel.min.js"></script>
<script src="/public/assets/js/jquery.validate.min.js"></script>
<script src="/public/lib/js/jquery.nivo.slider.js"></script>
<script src="/public/lib/home.js"></script>
<script src="/public/assets/js/plugins.js"></script>
<script src="/public/assets/js/main.js"></script>
<script src="/public/js/main.js?v=1.6"></script>
<script src="/public/assets/js/classie.js"></script>
<script src="/public/assets/js/main3.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    <?php if(!isset($_SESSION['lang']) || $_SESSION['lang'] == 'en') { ?>
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/60490e2b385de407571ec1da/1f0elums9';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s1.lang='en'
            s0.parentNode.insertBefore(s1,s0);
        })();
    <?php } elseif (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ru') {?>
    <!--Start of Tawk.to Script-->
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/60598f03067c2605c0bb4094/1f1etda0b';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    <!--End of Tawk.to Script-->
    <?php } else { ?>
    <!--Start of Tawk.to Script-->
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/60598fd3f7ce18270932e3c5/1f1etjkrt';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    <!--End of Tawk.to Script-->
    <?php } ?>
</script>
<!--End of Tawk.to Script-->
<script>
    $(document).ready(function () {
        $(".loader_container").delay(1000).fadeOut(800);
    });
</script>
<script>
    $(function(){
        $(window).on("scroll load resize", function (e){
            if($(window).scrollTop() >= $(".header-area").height()+100){
                if($(".header-area").hasClass("stick")===false){
                    $(".header-area").addClass("stick");
                }
            }else{
                $(".header-area").removeClass("stick");
            }
        });
    });
</script>

<!-- Chat - https://app.purechat.com/ -->
<!--<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'f513a8e4-7c91-4884-a9d7-85cab11ba377', f: true }); done = true; } }; })();</script>-->


