<?php
if (isset($_GET['id']) && !empty($_GET['id'])) { $blogID = $_GET['id'];} else {header('location: /admin/blog');}
$blog = $cnt->getBlog(["id"=>$blogID]);
if(!isset($blog["id"]) || empty($blog["id"])) {
   header('location: /admin/blog');
}
?>
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
                       <h5>Խմբագրել նյութը</h5> 
                       <br>                         
                      </div>
                  <div class="card">
                        <div class="card-block">
                            <div class="row">   
                                <div class="col-md-4">
                                   <label>AM</label>
                                    <input type="text" class="form-control live" data-live="blog, title_am, id, <?php echo $blog['id']?>" value="<?php echo $blog['title_am']?>" placeholder="Անվանում ">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-4">
                                   <label>EN</label>
                                    <input type="text" class="form-control live" data-live="blog, title_en, id, <?php echo $blog['id']?>" value="<?php echo $blog['title_en']?>" placeholder="Անվանում ">
                                    <i class="form-group__bar"></i>
                                </div>
                                   <div class="col-md-4">
                                   <label>RU</label>
                                    <input type="text" class="form-control live" data-live="blog, title_ru, id, <?php echo $blog['id']?>" value="<?php echo $blog['title_ru']?>" placeholder="Անվանում ">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-4">
                                    <textarea type="text" class="form-control live editor" data-live="blog, descr_am, id, <?php echo $blog['id']?>" placeholder="Նկարագրություն" style="min-height:250px;"><?php echo $blog['descr_am']?></textarea>
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-4">
                                    <textarea type="text" class="form-control live editor" data-live="blog, descr_en, id, <?php echo $blog['id']?>" placeholder="Նկարագրություն" style="min-height:250px;"><?php echo $blog['descr_en']?></textarea>
                                    <i class="form-group__bar"></i>
                                </div>
                                    <div class="col-md-4">
                                    <textarea type="text" class="form-control live editor" data-live="blog, descr_ru, id, <?php echo $blog['id']?>" placeholder="Նկարագրություն" style="min-height:250px;"><?php echo $blog['descr_ru']?></textarea>
                                    <i class="form-group__bar"></i>
                                </div>
                                
                            <div class="col-md-12">
		                        <?php $group = 'blog';?>
		                        <?php $parent = $blog['id'];?>
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
                                        <img src="/public/gallery/<?php echo $group?>/small/<?php echo $photo['photoID']?>.jpg">
                                    </div>
		                        <?php }?>
                            </div>
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