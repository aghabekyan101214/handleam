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
                      <br><h4>Ավելացնել սլայդ</h4><br>                         
                    </div>
                    <div class="card p-1">
                        <div class="card-header nav-bar">
                            <form action="?cmd=addSlide" method="post" style="width:100%;">
                                <div class="row">
                                      <div class="col-md-12">
                                        <input type="text" name="link" placeholder="Հղում" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="col-md-4">
                                        <input type="text" name="title_am" placeholder="Վերնագիր AM" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-4">
                                        <input type="text" name="title_en" placeholder="Վերնագիր EN" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                      <div class="col-md-4">
                                        <input type="text" name="title_ru" placeholder="Վերնագիր RU" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>    
                                       
                                       <div class="col-md-4">
                                        <input type="text" name="descr_am" placeholder="Պարբերություն AM" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-4">
                                        <input type="text" name="descr_en" placeholder="Պարբերություն EN" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                      <div class="col-md-4">
                                        <input type="text" name="descr_ru" placeholder="Պարբերություն RU" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>    
                                        
                                        <div class="col-md-4">
                                        <input type="text" name="btn_am" placeholder="Կոճակ AM" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-4">
                                        <input type="text" name="btn_en" placeholder="Կոճակ EN" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                      <div class="col-md-4">
                                        <input type="text" name="btn_ru" placeholder="Կոճակ RU" class="form-control" required>
                                            <i class="form-group__bar"></i>
                                        </div>    
                                        
                                    <div class="col-md-12">
                                           <br>
                                            <button style="float:right; width: 150px" type="submit" class="btn btn-success btn-block">Ավելացնել</button>
                                    </div>       
                                </div>
                            </form>
                        </div>
                    </div>            
                    
                   <div class="col-md-12">
                      <br>
                       <h4>Սլայդներ</h4> 
                       <br>   
                    </div>   
                <?php foreach($cnt->getSlide() as $slide ) {?>      
                       <div class="card">
                           <div class="card-block">
                                   <div style="font-size:16px; position: absolute; z-index:99; height: 30px; width: 30px; top: 2px; right: 2px; ">
                                    <i class="zmdi zmdi-delete actions__item" onClick="removeSlide(<?php echo $slide['id']?>)"></i>
                                    
                                </div>
                                 <div class="row">
                                   <div class="col-md-12">
                                        <input type="text" name="link" placeholder="Հղում" class="form-control live" data-live="slide, link, id, <?php echo $slide['id']?>" value="<?php echo $slide['link']?>"required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="col-md-4">
                                        <input type="text" name="title_am" placeholder="Վերնագիր AM" class="form-control live" data-live="slide, title_am, id, <?php echo $slide['id']?>" value="<?php echo $slide['title_am']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-4">
                                        <input type="text" name="title_en" placeholder="Վերնագիր EN" class="form-control live" data-live="slide, title_en, id, <?php echo $slide['id']?>" value="<?php echo $slide['title_en']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="col-md-4">
                                        <input type="text" name="title_en" placeholder="Վերնագիր RU" class="form-control live" data-live="slide, title_ru, id, <?php echo $slide['id']?>" value="<?php echo $slide['title_ru']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        
                                        <div class="col-md-4">
                                        <input type="text" name="descr_am" placeholder="Պարբերություն AM" class="form-control live" data-live="slide, descr_am, id, <?php echo $slide['id']?>" value="<?php echo $slide['descr_am']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-4">
                                        <input type="text" name="descr_en" placeholder="Պարբերություն EN" class="form-control live" data-live="slide, descr_en, id, <?php echo $slide['id']?>" value="<?php echo $slide['descr_en']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="col-md-4">
                                        <input type="text" name="descr_en" placeholder="Պարբերություն RU" class="form-control live" data-live="slide, descr_ru, id, <?php echo $slide['id']?>" value="<?php echo $slide['descr_ru']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        
                                          <div class="col-md-4">
                                        <input type="text" name="btn_am" placeholder="Կոճակ AM" class="form-control live" data-live="slide, btn_am, id, <?php echo $slide['id']?>" value="<?php echo $slide['btn_am']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                       <div class="col-md-4">
                                        <input type="text" name="btn_en" placeholder="Կոճակ EN" class="form-control live" data-live="slide, btn_en, id, <?php echo $slide['id']?>" value="<?php echo $slide['btn_en']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
                                        <div class="col-md-4">
                                        <input type="text" name="btn_en" placeholder="Կոճակ RU" class="form-control live" data-live="slide, btn_ru, id, <?php echo $slide['id']?>" value="<?php echo $slide['btn_ru']?>" required>
                                            <i class="form-group__bar"></i>
                                        </div>
            
                         <div class="row">   
                                <div class="col-md-12">
                                    <?php $group = 'slide';?>
                                    <?php $parent = $slide['id'];?>
                                    <?php $multiple = false;?>
                                    <?php $photos = $cnt->getPhoto($group, $parent);?>
                                    <button class="btn btn-info photo-btn">
                                          <i class="zmdi zmdi-cloud-download" style="font-size:25px"></i>
                                        <input type="file" onChange="addPhoto('<?php echo $group?>', '<?php echo $parent?>', this, '<?php echo $group?>'<?php if($multiple===false){?>, 'change'<?php }?>)" style="opacity:0;position:absolute;top:0;left:0;width:100%;height:100%;" <?php if($multiple===true){?>multiple<?php }?>> 
                                    </button>
                                    <?php foreach($photos as $photo){?>
                                    <div class="photo-box">
                                        <span onClick="removePhoto('<?php echo $group?>', <?php echo $photo['photoID']?>)">x</span>
                                        <img src="/public/gallery/<?php echo $group?>/<?php echo $photo['photoID']?>.jpg">
                                    </div>
                                    <?php }?>
                                </div>
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