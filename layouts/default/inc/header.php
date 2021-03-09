<!-- Loader -->
<div class="loader_container centering-block">
    <div class="loader centered">
        <div class="square square_one"></div>
        <div class="square square_two"></div>
        <div class="square square_three"></div>
        <div class="square square_four"></div>
        <div class="square square_five"></div>
        <div class="square square_six"></div>
        <div class="square square_seven"></div>
        <div class="square square_eight"></div>
        <div class="square square_nine"></div>
    </div>
</div>

<!-- header start -->
<header class="header-area home-style-2">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="logo">
                        <a href="/">
                            <img src="/public/assets/img/logo/logo-black.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <div class="social-icons text-center">
                        <a class="fb" target="_blank" href="<?=$cnt->getContacts()['fb']?>"><i class="fa fa-facebook"></i></a>
                        <a class="instagram" target="_blank" href="<?=$cnt->getContacts()['instagram']?>"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-9 col-xs-4">
                    <div class="cart-menu">
                        <div class="main-menu lang" style="float: right;">
                            <nav>
                                <ul>
                                    <li><a style="padding:2px 0!important;" href="#"><?php if($cnt->lang == "am"){echo "Հայ";}elseif ($cnt->lang == "en"){echo "Eng";}else{echo "Рус";}?></a>
                                        <ul class="dropdown" style="width:65px;">
                                            <li><a href="?lang=am">Հայ</a></li>
                                            <li><a href="?lang=en">Eng</a></li>
                                            <li><a href="?lang=ru">Рус</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
               
                        <!--  <div class="search-style-2 f-right">
                            <a class="icon-search-2" href="#">
                                <i class="pe-7s-search"></i>
                            </a>
                            <div class="search2-content">
                                <form action="#">
                                    <div class="search-input-button2">
                                        <input class="" placeholder="<?=$cnt->val['search']?>" type="search">
                                        <button class="search-button2" type="submit">
                                            <i class="pe-7s-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div> -->
                        <? $cart_data = $cnt->getToCart(); ?>
                        <div class="shopping-cart f-right">
                            <a class="top-cart" href="/cart"><i class="pe-7s-cart"></i></a>
                            <span class="cart_count"><?=((isset($cart_data['count'])) ? $cart_data['count'] : "0");?></span>
                            <div id="cart">
                                <?=@$cart_data['html'];?>
                            </div>
                        </div>
                        <div class="main-menu f-right">
                            <nav>
                                <ul>
                                    <li><a href="/"><?=$cnt->val['home']?></a></li>
                                    <li><a href="/shop"><?=$cnt->val['shop']?></a></li>
                                    <li><a href="/sell-out"><?=$cnt->val['liquidation_prices']?></a></li>
                                    <li><a href="/about"><?=$cnt->val['about']?></a></li>
                                    <!--<li><a href="/blog"><?=$cnt->val['blog']?></a></li>-->
                                    <li><a href="/contact"><?=$cnt->val['contact']?></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->
<!-- mobile-menu-area start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul>
                            <li><a href="/"><?=$cnt->val['home']?></a></li>
                            <li><a href="/shop"><?=$cnt->val['shop']?></a></li>
                            <li><a href="/sell-out"><?=$cnt->val['liquidation_prices']?></a></li>
                            <li><a href="/about"><?=$cnt->val['about']?></a></li>
                            <li><a href="/blog"><?=$cnt->val['blog']?></a></li>
                            <li><a href="/contact"><?=$cnt->val['contact']?></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- mobile-menu-area end -->