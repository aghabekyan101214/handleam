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
                      <br><h4>Բլոգ</h4><br>                         
                    </div>
                    <div class="card p-1">
                        <div class="card-header nav-bar p-3">
                            <form action="?cmd=addBlog" method="post" style="width:100%;">
                                 <div class="row">
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
                                    <div class="col-md-3">
                                            <button style="float:right; width:100%" type="submit" class="btn btn-success btn-block">Ավելացնել </button>
                                    </div>       
                                </div>
                                 </form>      
                                </div>
                        </div>
                    </div> 
                           <div class="card">
                           <div class="card-block">
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-bnewsed">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>ID</th>
                                                <th>Նկար</th>
                                                <th>Անվանում</th>
                                                <th>Դիտում</th>
                                                <th width="250">Խմբագրել | Հեռացնել</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($cnt->getBlog() as $blog) {?>
                                            <?php $photo = $cnt->getPhoto("blog", $blog['id'], 1);?> 
                                            <tr>
                                                <td><?=$blog['id']?></td>    
                                                <td><img src="/public/gallery/blog/small/<?=$photo['photoID']?>.jpg" alt="" width="80"></td>    
                                                <td><?=$blog['title']?></td>    
                                                <td><?=$blog['view']?></td>    
                                                <td>
                                                    <a href="/admin/item?id=<?=$blog['id']?>">
                                                        <button class="btn btn-default">Խմբագրել</button>
                                                    </a>
                                                     <button class="btn btn-danger" onClick="removeBlog(<?php echo $blog['id']?>)">Հեռացնել</button>
                                                </td>    
                                            </tr>
                                            <?php }?>
                                    </tbody>
                                </table>
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