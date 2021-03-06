<!DOCTYPE html>
<html>
    <head>
        <?php require "inc/head.php";?>
        <style>
            .nav-category li {
                display: inline-block;
            }
        </style>
    </head>
    <body data-ma-theme="indigo">
        <main class="main">
            <?php require "inc/header.php"?>

            <?php require "inc/aside.php"?>
            <?php $categories = $cnt->getCat(['page_type' => ($_GET['page_type'] ?? 0)]); ?>
            <?php $goodsTypes = $cnt->getGoodsType(['filter_in_categories' => array_column($categories, 'id')]); ?>
            <section class="content">
                <div class="content__inner content__inner--sm" style="max-width:1100px;">
                    <div class="col-md-12">
                      <br><h4>Ավելացնել կատեգորիա</h4><br>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <ul class='navigation nav-category'>
                                <li class="<?php if(!isset($_GET['page_type'])) echo 'navigation__active'; ?>">
                                    <a href="/admin/cat">Հիմնական</a>
                                </li>
                                <li class="<?php if(isset($_GET['page_type']) && $_GET['page_type'] == '1') echo 'navigation__active'; ?>">
                                    <a href="/admin/cat?page_type=1">Անհատական Պատվերներ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card p-1">
                        <div class="card-header nav-bar p-3">
                            <form action="?cmd=addCat&page_type=<?php $_GET['page_type'] ?? 0; ?>" method="post" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select name="parent_category" id="" class="form-control">
                                            <option value="">-----</option>
                                            <?php foreach($categories as $cat) {?>
                                                <option value="<?php echo $cat['id']?>"><?php echo $cat['title_am']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" name="title_am" placeholder="Վերնագիր AM" class="form-control" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                   <div class="col-md-2">
                                        <input type="text" name="title_en" placeholder="Վերնագիր EN" class="form-control" required>
                                        <i class="form-group__bar"></i>
                                   </div>
                                    <div class="col-md-2">
                                        <input type="text" name="title_ru" placeholder="Վերնագիր RU" class="form-control" required>
                                        <i class="form-group__bar"></i>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="show_in_menu">ՄԵնյու</label>
                                        <input style="appearance: auto; height: 25px; width: 25px" type="checkbox" id="show_in_menu" name="show_in_menu" value="1" placeholder="Մենյու" class="form-control">
                                    </div>
                                    <?php if(isset($_GET['page_type'])) {?>
                                        <input type="hidden" value="1" name="page_type">
                                    <?php }?>
                                    <div class="col-md-2">
                                        <button style="float:right; width:100%" type="submit" class="btn btn-success btn-block">Ավելացնել </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php foreach($categories as $cat) {?>

                        <div class="card" style="margin-top:-25px">
                            <div class="card-block p-1">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select name="parent_category" data-live="cat, parent_id, id, <?php echo $cat['id']?>" class="form-control live">
                                            <option value="">-----</option>
                                            <?php foreach($categories as $c) {?>
                                                <?php if($c['id'] == $cat['id']) continue; ?>
                                                <option <?php if($cat['parent_id'] == $c['id']) echo 'selected'; ?> value="<?php echo $c['id']?>"><?php echo $c['title_am']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                     <div class="col-md-2">
                                         <input type="text" name="title_am" placeholder="Վերնագիր AM" class="form-control live"  data-live="cat, title_am, id, <?php echo $cat['id']?>" value="<?php echo $cat['title_am']?>">
                                         <i class="form-group__bar"></i>
                                     </div>
                                     <div class="col-md-2">
                                         <input type="text" name="title_en" placeholder="Վերնագիր EN" class="form-control live"  data-live="cat, title_en, id, <?php echo $cat['id']?>" value="<?php echo $cat['title_en']?>">
                                         <i class="form-group__bar"></i>
                                     </div>
                                     <div class="col-md-2">
                                         <input type="text" name="title_ru" placeholder="Վերնագիր RU" class="form-control live"  data-live="cat, title_ru, id, <?php echo $cat['id']?>" value="<?php echo $cat['title_ru']?>">
                                         <i class="form-group__bar"></i>
                                     </div>
                                    <div class="col-md-1">
                                        <label for="show_in_menu">ՄԵնյու</label>
                                        <input style="appearance: auto; height: 25px; width: 25px" type="checkbox" data-live="cat, show_in_menu, id, <?php echo $cat['id']?>" id="show_in_menu" name="show_in_menu" value="1" <?php if($cat['show_in_menu']) echo 'checked'; ?> placeholder="Մենյու" class="form-control live">
                                    </div>
                                     <div class="col-md-1">
                                         <button style="float:right;width:100%" type="submit" class="btn btn-danger btn-block" onClick="removeCat(<?php echo $cat['id']?>)">x</button>
                                     </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>


                    <div class="col-md-12">
                       <br>
                       <h4>Ավելացնել տեսակ</h4>
                       <br>
                    </div>
            <div class="card p-1">
                        <div class="card-header nav-bar p-3">
                            <form action="?cmd=addGoodsType" method="post" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-2">
                                           <select class="select2" name="catID" required>
                                          <option value="">-----</option>
                                           <?php foreach($categories as $cat) {?>
                                           <?php if(!is_null($cat['parent_id'])) continue; ?>
                                            <option value="<?=$cat['id']?>"><?=$cat['title']?></option>
                                            <?php }?>
                                        </select>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="col-md-3">
                                        <input type="text" name="title_am" placeholder="Վերնագիր AM" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-3">
                                        <input type="text" name="title_en" placeholder="Վերնագիր EN" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="col-md-3">
                                        <input type="text" name="title_ru" placeholder="Վերնագիր RU" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    <div class="col-md-1">
                                            <button style="float:right; width:100%" type="submit" class="btn btn-success btn-block"> &radic;</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php foreach($goodsTypes as $goodsType) {?>
                        <div class="card" style="margin-top:-25px">
                            <div class="card-block p-1">
                                <div class="row">
                                    <div class="col-md-2">
                                         <select class="select2 live" name="catID" required data-live="goods_type, catID, id, <?php echo $goodsType['id']?>">
                                             <option value="">-----</option>
                                           <?php foreach($categories as $cat) {?>
                                            <option <?php if($cat['id'] == $goodsType['catID']) {?> selected <?php }?> value="<?=$cat['id']?>"><?=$cat['title']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                     <div class="col-md-3">
                                         <input type="text" name="title_am" placeholder="Վերնագիր AM" class="form-control live"  data-live="goods_type, title_am, id, <?php echo $goodsType['id']?>" value="<?php echo $goodsType['title_am']?>">
                                         <i class="form-group__bar"></i>
                                     </div>
                                     <div class="col-md-3">
                                         <input type="text" name="title_en" placeholder="Վերնագիր EN" class="form-control live"  data-live="goods_type, title_en, id, <?php echo $goodsType['id']?>" value="<?php echo $goodsType['title_en']?>">
                                         <i class="form-group__bar"></i>
                                     </div>
                                     <div class="col-md-3">
                                         <input type="text" name="title_ru" placeholder="Վերնագիր RU" class="form-control live"  data-live="goods_type, title_ru, id, <?php echo $goodsType['id']?>" value="<?php echo $goodsType['title_ru']?>">
                                         <i class="form-group__bar"></i>
                                     </div>
                                     <div class="col-md-1">
                                         <button style="float:right;width:100%" type="submit" class="btn btn-danger btn-block" onClick="removeType(<?php echo  $goodsType['id']?>)">x</button>
                                     </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    <div class="p-1"></div>
                </div>
                <?php require "inc/footer.php"?>
            </section>
        </main>
    </body>
</html>
