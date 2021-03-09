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
                       <h4>Գլխավոր բաններ</h4> 
                      <br>                         
                  </div>
                  <?php foreach($cnt->getBanner(["type_large_small"=>true]) as $banner) {?>                  
                  <div class="card">
                        <div class="card-block">
                            <div class="row">
                              <div class="col-md-12">
                                   <h6><b><?php echo $banner['title_am']?></b></h6>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="banner, link, id, <?php echo $banner['id']?>" value="<?php echo $banner['link']?>" placeholder="Հղում " readonly>
                                    <i class="form-group__bar"></i>
                                </div>  
                                   <div class="col-md-4">
                                    <input type="text" class="form-control live" data-live="banner, title_am, id, <?php echo $banner['id']?>" value="<?php echo $banner['title_am']?>" placeholder="Անվանում АМ">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control live" data-live="banner, title_en, id, <?php echo $banner['id']?>" value="<?php echo $banner['title_en']?>" placeholder="Անվանում EN">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control live" data-live="banner, title_ru, id, <?php echo $banner['id']?>" value="<?php echo $banner['title_ru']?>" placeholder="Անվանում RU">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                                 <div class="row">
                                <div class="col-md-12">
                                    <?php $group = 'banner';?>
                                    <?php $parent = $banner['id'];?>
                                    <?php $multiple = false;?>
                                    <?php $photos = $cnt->getPhoto($group, $parent);?>
                                    <div class="p-2"></div>
                                    <button class="btn btn-info photo-btn">
                                        <i class="zmdi zmdi-cloud-download" style="font-size:25px"></i>
                                        <input type="file" onChange="addPhoto('<?php echo $group?>', '<?php echo $parent?>', this, '<?php echo $group?>'<?php if($multiple===false){?>, 'change'<?php }?>)" style="opacity:0;position:absolute;top:0;left:0;width:100%;height:200%;" <?php if($multiple===true){?>multiple<?php }?>> 
                                    </button>
                                    <?php foreach($photos as $photo){?>
                                    <div class="photo-box">
                                        <span onClick="removePhoto('<?php echo $group?>', <?php echo $photo['photoID']?>)">x</span>
                                        <img src="/public/gallery/<?php echo $group?>/<?php echo $photo['photoID']?>.jpg">
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="p-2"></div>
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