<aside class="sidebar">
    <div class="scrollbar-inner">
        <ul class="navigation">
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=='default'){?>class="navigation__active"<?php }?>><a href="/admin/"><i class="zmdi zmdi-view-carousel"></i>  Սլայդեր</a></li>
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="pages"){?>class="navigation__active"<?php }?>><a href="/admin/pages"><i class="zmdi zmdi-collection-text"></i> Մեր մասին</a></li> 
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="cat"){?>class="navigation__active"<?php }?>><a href="/admin/cat"><i class="zmdi zmdi-circle"></i>Կատեգորիա և տեսակ</a></li>
             <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="goods"){?>class="navigation__active"<?php }?>><a href="/admin/goods"><i class="zmdi zmdi-layers"></i>Ապրանքներ</a></li>
             <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="orders"){?>class="navigation__active"<?php }?>><a href="/admin/orders"><i class="zmdi zmdi-shopping-cart"></i>Պատվերներ</a></li>
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="contacts"){?>class="navigation__active"<?php }?>><a href="/admin/contacts"><i class="zmdi zmdi-phone"></i> Կոնտակտ</a></li>
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="blog"){?>class="navigation__active"<?php }?>><a href="/admin/blog"><i class="zmdi  zmdi-view-quilt"></i> Բլոգ</a></li>   
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="banner"){?>class="navigation__active"<?php }?>><a href="/admin/banner"><i class="zmdi zmdi-view-dashboard"></i> Գլխավոր բաններ</a></li>
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="banner_aside"){?>class="navigation__active"<?php }?>><a href="/admin/banner_aside"><i class="zmdi zmdi-view-dashboard"></i> Գովազդային բաններ</a></li>
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="privacy"){?>class="navigation__active"<?php }?>><a href="/admin/privacy"><i class="zmdi zmdi-shield-security"></i> Օգտագործման պայմաններ</a></li>
            <li <?php if(!isset($url->DIR[1]) && $url->PAGE=="settings"){?>class="navigation__active"<?php }?>><a href="/admin/settings"><i class="zmdi zmdi-settings"></i> Կարգավորումներ</a></li>
            <hr>

            <li>
                <a href="?cmd=logOut"><i class="zmdi zmdi-sign-in"></i> Ելք</a>
            </li>
        </ul>
    </div>
</aside>


<aside class="chat aside-content">
    <div class="page-loader">
        <div class="page-loader__spinner">
            <svg viewBox="25 25 50 50">
                <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <span class="zmdi zmdi-close hidden-sm-down" data-ma-action="aside-close" data-ma-target=".aside-content"></span>
    <div class="chat__header">
        <span class="zmdi zmdi-arrow-right" data-ma-action="aside-close" data-ma-target=".aside-content"></span>
        <a href="" target="_blank" class="chat__title">Դիտել հղումը <i class="zmdi zmdi-share"></i></a>
    </div>
    <div class="scrollbar-main content-box"></div>
</aside>