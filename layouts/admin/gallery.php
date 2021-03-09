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
                      <br><h4>Պատկերասրահ</h4><br>                         
                    </div>
                    <div class="card p-1">
                        <div class="card-header nav-bar p-3">
                            <form action="?cmd=addGallery" method="post" style="width:100%;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="title_am" placeholder="Վերնագիր AM" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-4">
                                        <input type="text" name="title_en" placeholder="Վերնագիր EN" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                    <div class="col-md-4">
                                            <button style="float:right; width:100%" type="submit" class="btn btn-success btn-block">Ավելացնել</button>
                                    </div>       
                                </div>
                            </form>
                        </div>
                    </div> 
                    
                    <?php foreach($cnt->getGallery() as $gallery) {?>
                    <div class="card">
                        <div class="card-block" style="padding: 1.4rem 2.1rem 0;">
                            <div style="font-size:16px;position:absolute;right:15px;top:15px;z-index:99;">
                                <i class="zmdi zmdi-delete actions__item" onClick="removeGallery(<?php echo $gallery['id']?>)"></i>
                            </div>
                       
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control live" data-live="gallery, title_am, id, <?php echo $gallery['id']?>" value="<?php echo $gallery['title_am']?>" placeholder="Անվանում AM">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control live" data-live="gallery, title_en, id, <?php echo $gallery['id']?>" value="<?php echo $gallery['title_en']?>" placeholder="Անվանում EN">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <?php $group = 'gallery';?>
                                    <?php $parent = $gallery['id'];?>
                                    <?php $multiple = true;?>
                                    <?php $photos = $cnt->getPhoto($group, $parent);?>
                                    <button class="btn btn-info photo-btn">
                                          <i class="zmdi zmdi-cloud-download" style="font-size:25px"></i>
                                        <input type="file" onChange="addPhoto('<?php echo $group?>', '<?php echo $parent?>', this, '<?php echo $group?>'<?php if($multiple===false){?>, 'change'<?php }?>)" style="opacity:0;position:absolute;top:0;left:0;width:100%;height:100%;" <?php if($multiple===true){?>multiple<?php }?>> 
                                    </button>
                                    <?php foreach($photos as $photo){?>
                                    <div class="photo-box">
                                        <span onClick="removePhoto('<?php echo $group?>', <?php echo $photo['photoID']?>)">x</span>
                                        <img src="/public/gallery/<?php echo $group?>/large/<?php echo $photo['photoID']?>.jpg">
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            
                        </div>
                        </div> 
                        <?php }?>
                </div>
                
                <?php require "inc/footer.php"?>
                    
            </section>
        </main>
 
    </body>
</html>