<!doctype html>
<html class="no-js" lang="en">
	<head>
		<title>Handle | <?=$cnt->val['home']?></title>
		<?php include "layouts/default/inc/head.php"; ?>
	</head>
	<body>
		<div class="canvas-wrapper">
		<div class="content-wrap">
		<div class="content">
		<?php include "layouts/default/inc/header.php"; ?>
        <?php $categories = $cnt->getCat(['page_type' => ($_GET['page_type'] ?? 0)]); ?>
		<!-- slider start -->
		<section class="hero-slider-container">
			<div class="hero-slider owl-carousel">
				<?php foreach($cnt->getSlide() as $slide) {
					$photo = $cnt->getPhoto("slide", $slide['id'], 1); ?>
				<div class="hero-slider-item hero-slider-item-3" style="background: url('/public/gallery/slide/<?=$photo['photoID']?>.jpg'); background-size: cover">
					<div class="hero-slider-contents">
						<div class="container">
							<h1 class="title1"><?=$slide['title']?></h1>
							<p class="title2"><?=$slide['descr']?></p>
<!--							<a href="<?/*=$slide['link']*/?>" class="button-hover"><?/*=$slide['btn']*/?></a>
-->						</div>
					</div>
				</div>
				<?php }?>
			</div>
			<a href="#" class="hero-slider-nav prev"><i class="fa fa-angle-left"></i></a>
			<a href="#" class="hero-slider-nav next"><i class="fa fa-angle-right"></i></a>
		</section>
		<!-- slider end -->
		<!-- banner style 2 start -->
		<div class="banner-style-3 pt-50 big_banner">
			<div class="container">
				<div class="section-title text-center mb-30">
					<h2><?=$cnt->val['top_collections']?> <i class="fa fa-shopping-cart"></i></h2>
				</div>
				<div class="row">
					<?php foreach($cnt->getBanner(["type"=>'large']) as $banner_l) {
						$photo_large = $cnt->getPhoto("banner", $banner_l['id'], 1);?>
					<div class="col-md-6 col-sm-12">
						<div class="banner-style-3-img mb-30">
							<img class="img-responsive center-block" src="/public/gallery/banner/<?=$photo_large['photoID']?>.jpg"
								onclick="location = '<?=$banner_l['link']?>';">
							<div class="banner-style-3-dec">
								<a href="<?=$banner_l['link']?>"><?=$banner_l['title']?></a>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
				<div class="row">
					<?php foreach($cnt->getBanner(["type"=>'small']) as $banner_s) {
						$photo_small = $cnt->getPhoto("banner", $banner_s['id'], 1);?>
					<div class="col-md-3 col-sm-6">
						<div class="banner-style-3-img mb-30">
							<img src="/public/gallery/banner/<?=$photo_small['photoID']?>.jpg" onclick="location = '<?=$banner_s['link']?>';">
							<div class="banner-style-3-dec">
								<a href="<?=$banner_s['link']?>"><?=$banner_s['title']?></a>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
		<!-- banner style 2 end -->

		<!-- shop area start -->
		<div class="home-product-area pt-50 pb-50">
			<div class="container">
				<div class="section-title text-center mb-40">
					<h2><?=$cnt->val['featured_collections']?> <i class="fa fa-shopping-cart"></i></h2>
				</div>
				<div class="features-tab">
					<div class="home-2-tab">
						<ul role="tablist">
							<?php $i = 1; foreach($categories as $cat) { ?>
                            <?php if (null !== $cat['parent_id']) continue; ?>

                                <li class="<?php if($i == 1) echo 'active'; ?>">
                                    <a href="#<?=$i; ?>" data-toggle="tab"><?=$cat['title']?></a>
                                </li>

							<?php $i++; }?>
						</ul>
					</div>
					<div class="tab-content">
						<?php $a=1; foreach($categories as $cat) { ?>
                        <?php if (null !== $cat['parent_id']) continue; ?>
						<div class="tab-pane <?php if($a == 1) {?>active<?php }?>" id="<?=$a?>">
							<div class="row">
								<div class="product-curosel product-curosel-style owl-carousel">
									<?php
										$getGoods = $cnt->getGoods(["catID"=>$cat['id'], "limit"=>'8', "orderby_rand"=>true]);
                                        $goods = "";
										foreach($getGoods as $goods) {
											if($goods['discount'] > 0) {
											    //$goods_prc = ($goods['price'] * $goods['discount'] /100);
												$goods_price = $goods['price']; //($goods['price'] - $goods_prc);
											} else {
                                                $goods_price = $goods['price'];
                                            }
											$photo = $cnt->getPhoto("goods", $goods['id'], 1);?>
									<div class="col-md-3 col-sm-6 col-xs-12">
										<div class="single-shop">
											<div class="shop-img">
												<a href="/overlay/goods?goodsID=<?=$goods['id']?>" data-toggle="modal"><img src="/public/gallery/goods/small/<?=$photo['photoID']?>.jpg" alt=""/></a>
												<div class="shop-quick-view">
													<a href="/overlay/goods?goodsID=<?=$goods['id']?>">
													<i class="pe-7s-look"></i>
													</a>
												</div>
												<?php if($goods['discount'] > 0) {?>
												<div class="price-up-down">
													<span class="sale-discount">-<?=$goods['discount']?>%</span>
												</div>
												<?php }?>
												<?php if ($goods['status']=='0'){?>
												<div class="price-up-down">
													<span class="not-stock"><?=$cnt->val['not_stock']?></span>
												</div>
												<?php }?>
												<?php if ($goods['status_new']=='1'){?>
												<div class="price-up-down">
													<span class="status-new"><?=$cnt->val['status_new']?></span>
												</div>
												<?php }?>
												<div class="button-group">
													<a class="plus add-to-cart" data-id="<?php echo $goods['id']?>" role="button" title="<?=$cnt->val['add_cart']?>">
													<i class="pe-7s-cart"></i>
													<?=$cnt->val['add_cart']?>
													</a>
												</div>
											</div>
											<div class="shop-text-all">
												<div class="title-color fix">
													<div class="shop-title f-left">
														<h3><a href="/product/<?=$goods['id']?>" target="_blank"><?=mb_substr($goods['title'], 0, 15)?></a></h3>
													</div>
													<span class="price f-right">
													    <span class="new" <?php if($goods['discount']>0){?>style="text-decoration:line-through;"<?php }?>><?=$goods_price?> ֏</span>
													</span>
												</div>
												<div class="title-color fix">
													<div class="shop-title f-left">
														<span><?=@$cnt->getGoodsType(["id" => $goods['typeID']])["title"]?></span>
													</div>
													<?php if($goods['discount']>0){?>
													<span class="price f-right">
													    <span class="new"><?=$goods_price-($goods_price/100*$goods['discount'])?> ֏</span>
													</span>
													<?php }?>
												</div>
											</div>
										</div>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
						<?php $a++;  }?>
					</div>
				</div>
			</div>
		</div>



		<!-- shop area start -->
		<div class="home-product-area pt-50 pb-100">
			<div class="container">
				<div class="section-title text-center mb-40">
					<h2><?=$cnt->val["liquidation_prices"]?> <i class="fa fa-shopping-cart"></i></h2>
				</div>
                <div class="row">
                    <div class="product-curosel product-curosel-style owl-carousel">
                        <?php
                            $getGoods = $cnt->getGoods(["discount_start"=>1, "limit"=>'8', "orderby_rand"=>true]);
                            $goods = "";
                            foreach($getGoods as $goods) {
                            if($goods['discount'] > 0) {
                                $goods_price = $goods['price'];
                            } else {
                                $goods_price = $goods['price'];
                            }
                            $photo = $cnt->getPhoto("goods", $goods['id'], 1);
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="single-shop">
                                <div class="shop-img">
                                    <a href="/overlay/goods?goodsID=<?=$goods['id']?>" data-toggle="modal"><img src="/public/gallery/goods/small/<?=$photo['photoID']?>.jpg" alt=""/></a>
                                    <div class="shop-quick-view">
                                        <a href="/overlay/goods?goodsID=<?=$goods['id']?>">
                                        <i class="pe-7s-look"></i>
                                        </a>
                                    </div>
                                    <?php if($goods['discount'] > 0) {?>
                                    <div class="price-up-down">
                                        <span class="sale-discount">-<?=$goods['discount']?>%</span>
                                    </div>
                                    <?php }?>
                                    <?php if ($goods['status']=='0'){?>
                                    <div class="price-up-down">
                                        <span class="not-stock"><?=$cnt->val['not_stock']?></span>
                                    </div>
                                    <?php }?>
                                    <?php if ($goods['status_new']=='1'){?>
                                    <div class="price-up-down">
                                        <span class="status-new"><?=$cnt->val['status_new']?></span>
                                    </div>
                                    <?php }?>
                                    <div class="button-group">
                                        <a class="plus add-to-cart" data-id="<?php echo $goods['id']?>" role="button" title="<?=$cnt->val['add_cart']?>">
                                        <i class="pe-7s-cart"></i>
                                        <?=$cnt->val['add_cart']?>
                                        </a>
                                    </div>
                                </div>
                                <div class="shop-text-all">
                                    <div class="title-color fix">
                                        <div class="shop-title f-left">
                                            <h3><a href="/product/<?=$goods['id']?>" target="_blank"><?=mb_substr($goods['title'], 0, 15)?></a></h3>
                                        </div>
                                        <span class="price f-right">
                                            <span class="new" <?php if($goods['discount']>0){?>style="text-decoration:line-through;"<?php }?>><?=$goods_price?> ֏</span>
                                        </span>
                                    </div>
                                    <div class="title-color fix">
                                        <div class="shop-title f-left">
                                            <span><?=@$cnt->getGoodsType(["id" => $goods['typeID']])["title"]?></span>
                                        </div>
                                        <?php if($goods['discount']>0){?>
                                        <span class="price f-right">
                                            <span class="new"><?=$goods_price-($goods_price/100*$goods['discount'])?> ֏</span>
                                        </span>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <div class="row mt-40">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="/sell-out">
                                <button class="submit"><?=$cnt->val["read_more"]?></button>
                            </a>
                        </div>
                    </div>
                </div>
			</div>
		</div>



		<?php include "layouts/default/inc/footer.php"; ?>
	</body>
</html>
