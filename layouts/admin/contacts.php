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
                <div class="content__inner content__inner--sm" style="max-width:800px;">
                    
                    <div class="card">
                        <?php $contact = $cnt->getContacts();?>
                        <div class="card-block" style="padding: 1.4rem 2.1rem 0;">
                            <h3>Կոնտակտային տվյալներ</h3>
                                <br>
                            <div class="row">
                                 <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, address_am, id, <?php echo $contact['id']?>" value="<?php echo $contact['address_am']?>" placeholder="Հասցե AM">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, address_en, id, <?php echo $contact['id']?>" value="<?php echo $contact['address_en']?>" placeholder="Հասցե EN">
                                    <i class="form-group__bar"></i>
                                </div> 
                                <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, address_ru, id, <?php echo $contact['id']?>" value="<?php echo $contact['address_ru']?>" placeholder="Հասցե RU">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, phone, id, <?php echo $contact['id']?>" value="<?php echo $contact['phone']?>" placeholder="Հեռախոս">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, email, id, <?php echo $contact['id']?>" value="<?php echo $contact['email']?>" placeholder="Էլ. փոստ">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-12">
                                    <div class="p-3"></div>
                                </div>
                                <div class="col-md-12">
                                    <label>Սոց ցանցեր</label>
                                    <input type="text" class="form-control live" data-live="contacts, fb, id, <?php echo $contact['id']?>" value="<?php echo $contact['fb']?>" placeholder="Facebook հղում">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, instagram, id, <?php echo $contact['id']?>" value="<?php echo $contact['instagram']?>" placeholder="Instagram հղում">
                                    <i class="form-group__bar"></i>
                                </div>
                                    <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, twitter, id, <?php echo $contact['id']?>" value="<?php echo $contact['twitter']?>" placeholder="Twitter հղում">
                                    <i class="form-group__bar"></i>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, google, id, <?php echo $contact['id']?>" value="<?php echo $contact['google']?>" placeholder="Google հղում">
                                    <i class="form-group__bar"></i>
                                </div> 
                                   <div class="col-md-12">
                                    <input type="text" class="form-control live" data-live="contacts, pinterest, id, <?php echo $contact['id']?>" value="<?php echo $contact['pinterest']?>" placeholder="Pinterest հղում">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <br>    
                        <div class="p-3"></div>
                    </div>

                </div>
                
                <?php require "inc/footer.php"?>
                    
            </section>
        </main>
 
    </body>
</html>