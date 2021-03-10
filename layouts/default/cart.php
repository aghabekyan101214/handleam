<!doctype html>
<html class="no-js" lang="en">
	<head>
		<title>Handle | Cart</title>
		<?php include "layouts/default/inc/head.php"; ?>
	</head>
	<body>
		<div class="canvas-wrapper">
		<div class="content-wrap">
		<div class="content">
		<?php include "layouts/default/inc/header.php"; ?>
		<!-- breadcrumbs start -->
		<div class="breadcrumbs-area breadcrumb-bg ptb-50">
			<div class="container">
				<div class="breadcrumbs text-center">
					<h2 class="breadcrumb-title"><?= $cnt->val['cart'] ?></h2>
					<ul>
						<li>
							<a class="active" href="/"><?= $cnt->val['home'] ?></a>
						</li>
						<li><?= $cnt->val['cart'] ?></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- breadcrumbs area end -->
		<!-- shopping-cart-area start -->
		<div class="cart-area ptb-70">
			<div class="container">


			    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12
						col-xs-12">
						<form action="#">
							<div class="table-content
								table-responsive">
								<table>
									<thead>
										<tr>
											<th
												class="product-price"><?= $cnt->val['images'] ?>
											</th>
											<th
												class="product-name"><?= $cnt->val['products'] ?>
											</th>
											<th
												class="product-price"><?= $cnt->val['price'] ?>
											</th>
											<th
												class="product-quantity"><?= $cnt->val['quantity'] ?>
											</th>
											<th
												class="product-subtotal"><?= $cnt->val['total'] ?>
											</th>
											<th
												class="product-name"><?= $cnt->val['remove'] ?>
											</th>
										</tr>
									</thead>
									<tbody>
										<?
										$total = 0;
										$lang = $_SESSION['lang'];
                                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
										foreach ($_SESSION['cart'] as $product_id => $data) {
											$total+=($data['info']['price']*$data['count']);
											?>
											<tr>
												<td class="product-thumbnail">
													<a href="#"><img style="width: 90px; height: 82px;"
														src="<?=$data['info']['image']?>" alt=""/></a>
												</td>
												<td class="product-name">
													<a href="#"><?=$data['info']['title_'.$lang]?></a>
												</td>
												<td class="product-price">
													<span class="amount"><?=$data['info']['price']?> ֏</span>
												</td>
												<td class="product-quantity">
													<input disabled value="<?=$data['count']?>" type="number">
												</td>
												<td class="product-subtotal">
													<?=($data['info']['price']*$data['count'])?> ֏
												</td>
												<td class="product-remove" data-id="<?=$product_id;?>">
													<a href="#">
													<i class="fa fa-times"></i>
													</a>
												</td>
											</tr>
										<?php } ?>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>

				<div class="row tax-coupon-div">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="tax-coupon-all">
							<div class="tax-coupon">
								<ul role="tablist">
									<li class="active">
										<a href="#tax"><?=$cnt->val['choose_method']?></a>
									</li>
								</ul>
							</div>
							<div class="tax-coupon-details tab-content">
								<div id="tax" class="shipping-dec tab-pane active">
									<p><?=$cnt->val['method_descr']?></p>
									<div class="shipping-form">
										<div class="single-shipping-form">
											<select class="email s-email method">
												<option value="cache"><?=$cnt->val['cache']?></option>
												<option value="card"><?=$cnt->val['bank_cart']?></option>
											</select>
										</div>
										<div class="single-shipping-botton" data-toggle="modal" data-target="#payment-method">
											<button type="submit">
											<span><?=$cnt->val['order']?></span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12">
						<div class="cart-total">
							<ul>
								<li class="cart-black"><?=$cnt->val['total']?><span class="pay_total" data-total="<?=$total;?>"><?=$total;?> ֏</span></li>
							</ul>
						</div>
					</div>
				</div>
				<?php }else{?>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-price text-center" style="padding:60px 0;background:#fff;">Ձեր զամբյուղը դատարկ է<br><br><a href="/shop" class="btn btn-default">« Վերադառնալ</a></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
				<?php }?>


			</div>
		</div>
		<!-- quick view start -->
		<div class="quick-view modal fade in" id="payment-method">
			<div class="container">
				<div class="row">
					<div id="view-gallery">
						<div class="col-xs-12">
							<div class="d-table">
								<div class="d-tablecell">
									<div class="modal-dialog">
										<div class="main-view modal-content" style="width: 50% !important; margin: 0 auto;">
											<div class="modal-footer" data-dismiss="modal">
												<span>x</span>
											</div>
											<div class="tax-coupon-all">
												<div class="tax-coupon">
													<ul role="tablist">
														<li class="active">
															<a href="#tax"><?=$cnt->val['order_info']?></a>
														</li>
													</ul>
												</div>
												<div class="tax-coupon-details tab-content center-block" style="margin: 0 auto; width: 100%;">
													<div id="tax" class="shipping-dec tab-pane active">
														<p><?=$cnt->val['order_descr']?></p>
														<div class="shipping-form">
															<div class="single-shipping-form">
																<input type="text" name="name" placeholder="<?=$cnt->val['fname_lname']?>"><br><br>
																<input type="text" name="address" placeholder="<?=$cnt->val['order_address']?>"><br><br>
																<input type="text" name="phone" placeholder="<?=$cnt->val['phone_phd']?>"><br><br>
															</div>
															<div class="single-shipping-botton">
																<button id="submit">
																<span><?=$cnt->val['order']?></span>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- quick view end -->
		<!-- shopping-cart-area end -->
		<?php include "layouts/default/inc/footer.php"; ?>
	</body>
</html>
