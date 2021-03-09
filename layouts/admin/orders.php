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
                       <h4>Պատվերներ </h4> 
                       <br>                         
                      </div>
                <?php foreach($cnt->getOrder() as $order) {?>                  
                  <div class="card">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-1">
                                    <b>ID</b><br>
                                    <?php echo $order['orderID']?>
                                </div>  
                                <div class="col-md-2">
                                    <b>Անուն</b><br>
                                    <?php echo $order['client_name']?>
                                </div>  
                                <div class="col-md-2">
                                    <b>Հեռ․՝</b><br>
                                    <?php echo $order['client_phone']?>
                                </div>  
                                <div class="col-md-2">
                                    <b>Հասցե՝</b><br>
                                    <?php echo $order['client_address']?>
                                </div>  
                                <div class="col-md-2">
                                    <b>Գումար՝</b><br>
                                    <?php echo $order['pay_amount']?> ֏
                                    <?php if($order['status']==1){?>
                                    <span style="color:white;background:green;display:block;padding:2px 5px;">Վճարված է</span>
                                    <?php }?>
                                </div>  
                                <div class="col-md-3">
                                    <b>Ամսաթիվ՝</b><br>
                                    <?php echo $order['date']?>
                                </div>   
                            </div>
                            <hr>
                            <?php 
                            $products = json_decode($order["order_data"], true);
                            if(!empty($products) && is_array($products)){
                            foreach($products as $product){?>
                            <div class="row">
                                <div class="col-md-1">
                                    <a href="/product/<?php echo $product["info"]["id"]?>" target="_blank">
                                        <img src="<?php echo $product["info"]['image']?>" style="width:100%;">
                                    </a>
                                </div>
                                <div class="col-md-11">
                                    <b>Անվանում՝</b> <a href="/product/<?php echo $product["info"]["id"]?>" target="_blank"><?php echo $product["info"]['title_am']?></a><br>
                                    <b>Քանակ՝</b> <?php echo $product["count"]?><br>
                                    <b>ID: </b> <?php echo $product["info"]["id"]?><br>
                                </div>
                            </div>
                            <hr>
                            <?php }}?>  
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