var config = {};

let lang = $("meta[name=lang]").attr('content');

$(function(){
    $.ajax({
        url: '?cmd=getConfig',
        dataType: 'json',
        async: false,
        data: '',
        success: function(data) {
           config = data;
        }
    });
});

// Form ajax

$(document).on('submit', '.form-ajax', function(e){
	e.preventDefault();
	var form = this;
	$(form).find(".form-message").html("");
	$(form).find(".form-control").removeClass("form-control-warning");
	$(form).find(".form-control").parent().removeClass("has-warning");
	$(form).find(".page-loader").fadeIn();
	$(this).ajaxSubmit(function(data){
		$(form).find(".page-loader").fadeOut();
		var response = $.parseJSON(data);

		if(response.location !== false && typeof response.location !== "undefined"){
			if(response.location.hash !== false){
				sendAlert("Ok", "", "success");
			}else if(response.location.href !== false){
				sendAlert("Ok", "", "success");
			}else if(response.location.reload === true){
				if($("form.login").length > 0){
					location.reload();
				}else{
					sendAlert("Ok", "", "success");
				}
			}
		}

		if(response.alert !== false && typeof response.alert !== "undefined"){
			sendAlert(response.alert.title, response.alert.message, response.alert.type);
		}

		if(response.error !== false && typeof response.error !== "undefined"){
			if(response.error.field !== false){
				response.error.field.forEach(function(index){
					$(form).find("[name="+index+"]").addClass("form-control-warning");
					$(form).find("[name="+index+"]").parent().addClass("has-warning");
				});
			}
			if(response.error.message !== false){
				$(form).find(".form-message").html(response.error.message).hide().fadeIn();
			}
		}

		if(response.reset === true){
			form.reset();
		}

	});
});


$(function(){
	$("body").on("click", "a[href^='/overlay/']", function(e){
		e.preventDefault();
		var a = this;
		if($('.modal').length > 0){
			$(".modal").remove();
			$(".modal-backdrop").remove();
			$("body").removeClass("modal-open");
			$("body").css("padding-right", 0);
			$("body").css("padding-left", 0);
		}
		getOverlay(a);
	});
});

	function getOverlay(a){
		var url = a.href;
		if(url != "" && url != "close"){
			$.get(url, function(data){
				if($('.modal').length == 0){
					$("body").append(data);
					$('.modal').modal('show');
				}
			});
		}
	}

$(document).on('hide.bs.modal','.modal', function (){
	history.pushState({}, '', "#");
});
$(document).on('show.bs.modal','.modal', function (){
});
$(document).on('shown.bs.modal','.modal', function (){
	$("body").addClass("modal-open");
});
$(document).on('hidden.bs.modal','.modal', function (){
	$("body").removeClass("modal-open");
	$(".modal").remove();
	$(".modal-backdrop").remove();
});

//////////// Cart
var config = {};

$(function(){
	$.ajax({
		url: '?cmd=getConfig',
		dataType: 'json',
		async: false,
		data: '',
		success: function(data) {
		   config = data;
		}
	});
});

/*

function exchangeCurrency(sum){
	var sum_exchange = 0;
	$.ajax({
		url: '?cmd=exchangeCurrency&sum='+sum,
		async: false,
		data: '',
		success: function(data) {
		   sum_exchange = data;
		}
	});
	return Number(sum_exchange);
}



$(function(){

	function getToCartJSON(){
		$.getJSON("?cmd=getToCartJSON", function(products){
			$(".shopping-cart > ul").html("");
			var count = 0;
			var total = 0;
			var list = "";
			list += '<li>';
			list += '<table>';
			$(products).each(function(index){
				list += '<tr>';
				list += '<td>';
				list += '<a href="item?id='+this.productID+'">';
				list += '<img src="/public/gallery/items/small/'+this.photoID+'.jpg">';
				list += '</a>';
				list += '</td>';
				list += '<td>';
				list += '<table>';
				list += '<tr>';
				list += '<td colspan="2">';
				list += ''+this.count+'';
				list += '</td>';
				list += '</tr>';
				list += '<tr>';
				list += '<td>';
				list += '<a href="?cmd=removeToCart&productID='+this.productID+'">';
				list += '<i class="fa fa-minus" aria-hidden="true"></i>';
				list += '</a>';
				list += '</td>';
				list += '<td>';
				list += '<a href="?cmd=addToCart&productID='+this.productID+'">';
				list += '<i class="fa fa-plus" aria-hidden="true"></i>';
				list += '</a>';
				list += '</td>';
				list += '</tr>';
				list += '</table>';
				list += '</td>';
				list += '<td>';
				list += ''+exchangeCurrency(this.amount)+' '+config.currency_symbol+'';
				list += '</td>';
				list += '<td>';
				list += '<a href="?cmd=removeToCart&productID='+this.productID+'&type=all">';
				list += '<i class="fa fa-trash-o" aria-hidden="true"></i>';
				list += '</a>';
				list += '</td>';
				//list += '<td>';
				//list += '<a href="/item/'+this.productID+'">';
				//list += ''+this.title+'';
				//list += '</a>';
				//list += '</td>';
				list += '</tr>';
				count++;
				total += exchangeCurrency(this.amount) * this.count;
			});
			list += '</table>';
			list += '</li>';
			$(".shopping-cart > ul").append(list);
			if(count == 0){
				$(".shopping-cart > ul").append('<li><a href="#" style="text-align:center;padding:35px;">'+config.val.cart_empty+'</a></li>');
			}else{
				$(".shopping-cart > ul").append('<li><p>'+config.val.total+' <span>'+total+' '+config.currency_symbol+'<span></p><a href="/inc/overlay" class="get-order"><button class="btn btn-info btn-block">'+config.val.order+'</button></a></li>');
			}
			$(".shopping-cart > span").html(count);
		});
	}
	getToCartJSON();

	$("body").on("click", "a[href^='?cmd=addToCart']", function(e){

		e.preventDefault();
		//e.stopPropagation();

		var a = this;

		if(($(a).parent("td").length == 0)){
			var cart = $('.shopping-cart > span');
			var fly_element = $(a).find("i");
			//$(fly_element).addClass("active");
			var fly_element_clone = fly_element.clone().offset({
				top: fly_element.offset().top-2,
				left: fly_element.offset().left+3
			}).addClass("fa-plus").removeClass("fa-shopping-cart").css({
				'opacity': 1,
				'position': 'absolute',
				'color': "#ff4800",
				'font-size': '30px',
				'z-index': '99999'
			}).appendTo($('body')).animate({
				'top': cart.offset().top-5,
				'left': cart.offset().left-3,
				'color': "#ffdc28"
			}, 1100).fadeOut(250, function(){
				$(this).remove();
				cart.html(Number(cart.html())+1);
				addToCart();
			});
		}else{
			addToCart();
		}

		function addToCart(){
			$.getJSON(a.href, function(data){
				//if(data.count > 0 && $("a#pr_"+data.productID+"").length != 0){
				//    $("a#pr_"+data.productID+"").attr("href", $("a#pr_"+data.productID+"").attr("href").replace("addToCart", "removeToCart"));
					//$("a#pr_"+data.productID+"").find("i").removeClass("fa-star-o");
					//$("a#pr_"+data.productID+"").find("i").addClass("fa-star").hide().fadeIn();
					//$("a#pr_"+data.productID+"").addClass("active").hide().fadeIn();
				//}
				getToCartJSON();
			});
		}

	});

	$("body").on("click", "a[href^='?cmd=removeToCart']", function(e){
		var a = this;
		$.getJSON(a.href, function(data){
			if(data.count == 0 && $("a#pr_"+data.productID+"").length != 0){
				$("a#pr_"+data.productID+"").attr("href", $("a#pr_"+data.productID+"").attr("href").replace("removeToCart", "addToCart"));
				//$("a#pr_"+data.productID+"").find("i").removeClass("fa-star");
				//$("a#pr_"+data.productID+"").find("i").addClass("fa-star-o").hide().fadeIn();
				$("a#pr_"+data.productID+"").removeClass("active").hide().fadeIn();
			}
			getToCartJSON();
		});
		e.preventDefault();
		e.stopPropagation();
	});

});




$(function(){
	//$(".img-small img").on("click", function(e){
	//    document.querySelector('.img-middle img').src = this.dataset.src;
	//});
});

$(function(){
	//$("a[href^='/?lang'], a[href^='/?currency']").on("click", function(e){
	//    $.get(this.href, function(data){
	//        location.reload();
	//    });
	//    e.preventDefault();
	//});
});
*/

function cart_refresh() {
	$.post('?cmd=getToCart', {}, function(data) {
		var data = $.parseJSON(data);
		$('#cart').empty().html(data.html);
		$('.cart_count').empty().html(data.count);
	});
}

$(function(){

	$("body").on("click", ".get-order", function(e){
		$.get(this.href, function(data){
			$(".modal-order").remove();
			$("body").append(data);
			$('.modal-order').modal('show');
		});
		e.preventDefault();
	});

	$(document).on('click','.add-to-cart',function() {


        if($(this).parent().hasClass("por-dse")){
            $(this).find("i").removeClass("pe-7s-cart");
            $(this).find("i").addClass("pe-7s-plus");
        }
        if($(this).parent().hasClass("button-group")){
            var cart = $('.cart_count');
            var fly_element = $(this).find("i");
            var fly_element_clone = fly_element.clone().offset({
                top: fly_element.offset().top-2,
                left: fly_element.offset().left+3
            }).css({
                'opacity': 1,
                'position': 'absolute',
                'color': "#fff",
                'font-size': '24px',
                'z-index': '99999',
                'background': '#330e06b8',
                'border-radius':'50%',
                'padding':'7px 7px',
                'display':'block'
            }).appendTo($('body')).animate({
                'top': cart.offset().top-12,
                'left': cart.offset().left-12,
            }, 900).fadeOut(250, function(){
                $(this).remove();
            });
         }





		$.post('?cmd=addToCart', {productID: $(this).attr('data-id')}, function(data) {
			cart_refresh();
		});
	});

	$(document).on('click','.cart-del',function() {
		$.post('?cmd=removeToCart', {productID: $(this).attr('data-id')}, function(data) {
			cart_refresh();
		});
	});

	$(document).on('click','.product-remove',function() {
		$.post('?cmd=removeToCart', {productID: $(this).attr('data-id')}, function(data) {
			location.reload();

		});
	});

	$(window).on('load',function() {
		$(".cat:first").change();
    });

	$(window).on('load',function() {
		if($(".cat:checked").length > 0){
            $(".goods-type").css("display", "none");
            $(".type").prop("checked", false);
            var id = $(".cat:checked").data("id");
			$(".type-"+id).css("display", "block");
		}
    });

	$("body").on('change keyup','.cat,.type, #amount_start, #amount_end',function() {
		if($(this).hasClass("cat")){
            $(".goods-type").css("display", "none");
            $(".type").prop("checked", false);
            var id = $(this).data("filter-by");
			$(".type-"+id).css("display", "block");
		}
		var cat = [];
		$('.cat').each(function(index) {
			if(this.checked) {
				cat.push($(this).attr('data-id'));
		    }
		});
		var type = [];
		$('.type').each(function(index) {
			if(this.checked) {
				type.push($(this).attr('data-id'));
		    }
		});
		var amount = [$("#amount_start").val(), $("#amount_end").val()];
		let searchParams = new URLSearchParams(window.location.search);
		let page_type = '';
		if(searchParams.has('page_type')) page_type = '&page_type=' + searchParams.get('page_type');
		$.post('?cmd=ax_get_filtered_products' + page_type, {cat: cat, type:type, amount:amount, orderby_rand:true}, function(data) {
			var html = '';
			$.each(data, function(index, val) {
				html +='<div class="col-md-6 col-lg-4 col-sm-6">';
				html +='	<div class="single-shop mb-40">';
				html +='		<div class="shop-img">';
                if(val.status == 0){
                    html +='		<span class="price f-right">';
                    html +='			<span class="not-stock">'+config.val.not_stock+'</span>';
                    html +='		</span>';
                }
                if(val.status_new == 1){
                    html +='		<span class="price f-right">';
                    html +='			<span class="status-new">'+config.val.status_new+'</span>';
                    html +='		</span>';
                }
				html +='			<a href="/overlay/goods?goodsID='+val.id+'" data-toggle="modal" data-target="#quick-view"><img src="'+val.photo+'" alt=""></a>';
				html +='			<div class="shop-quick-view">';
				html +='				<a href="/overlay/goods?goodsID='+val.id+'" title="Quick View">';
				html +='				<i class="pe-7s-look"></i>';
				html +='				</a>';
				html +='			</div>';
                if(val.discount > 0){
                    html +='		<div class="price-up-down">';
                    html +='		    <span class="sale-discount">-'+val.discount+'%</span>';
                    html +='		</div>';
                }
				html +='			<div class="button-group">';
				html +='				<a class="plus add-to-cart" data-id="'+val.id+'" role="button" title="">';
				html +='				<i class="pe-7s-cart"></i>';
				html +=' 				'+config.val.add_cart+'';
				html +='				</a>';
				html +='			</div>';
				html +='		</div>';
				html +='		<div class="shop-text-all" style="min-height:100px;">';
				html +='			<div class="title-color fix">';
				html +='				<div class="shop-title f-left">';
				let propertyName = 'title_' + lang;
				html +='					<h3>';
				html +='						<a href="/product/'+val.id+'" target="_blank">'+val[propertyName]+'</a>';
				html +='					</h3>';
				html +='				</div>';
				html +='				<span class="price f-right">';
                if(val.discount > 0){
                    html +='				<span class="new" style="text-decoration:line-through;">'+val.price+' ֏</span>';
                }else{
                    html +='				<span class="new">'+val.price+' ֏</span>';
                }
				html +='				</span>';
				html +='			</div>';
				html +='			<div class="title-color fix">';
				html +='				<div class="shop-title f-left">';
				html +='					<span>'+val.size+'</span>';
				html +='				</div>';
                if(val.discount > 0){
                    html +='			<span class="price f-right">';
                    html +='			    <span class="new">';
                    html +='			    '+(val.price-(val.price/100*val.discount))+' ֏';
                    html +='			    </span>';
                    html +='			</span>';
                }
				html +='			</div>';
				html +='		</div>';
				html +='	</div>';
				html +='</div>';
			});
			$('#grid .row').empty().html(html);

		},'json');
	});

	$('#submit').click(function() {
		$.post('?cmd=getPay', {
			amount: $('.pay_total').attr('data-total'),
			method: $('.method').val(),
			name: $('[name="name"]').val(),
			address: $('[name="address"]').val(),
			phone: $('[name="phone"]').val()
		}, function(data) {
			if (data == 'ok') {
				alert('Շնորհակալություն պատվերի համար։');
				location.reload();
				return true;
			}
			if(isJson(data)){
				data = JSON.parse(data);
        if($(".method").val() == 'idram') {
          $("input[name=EDP_BILL_NO]").val(data.order_id);
          $("#idram-form").submit();
        } else {
          document.location.replace(data.url);
        }
				return true;
			}
			alert(data);
		});
	});


});

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

/************ CART ************/

$(function () {



})
