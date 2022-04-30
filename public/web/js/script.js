(function($) {

	"use strict";

	$('[data-toggle="tooltip"]').tooltip();

 	// loader
 	var loader = function() {
 		setTimeout(function() { 
 			if($('#ftco-loader').length>0) {
 				$('#ftco-loader').removeClass('show');
 			}
 		}, 1);
 	};
 	loader();

 	$('.int').keypress(function() {
 		return event.charCode >= 48 && event.charCode <= 57;
 	});

 	// Lazy load
 	if($('.lazy').length) {
 		var lazyLoadInstance=new LazyLoad({
 			elements_selector: ".lazy"
 		});
 	}

	// Footer collapse
	if($('footer').length) {
		var headingFooter=$('footer h3');
		$(window).resize(function() {
			if($(window).width() <= 768) {
				headingFooter.attr("data-toggle","collapse");
			} else {
				headingFooter.removeAttr("data-toggle","collapse");
			}
		}).resize();
		headingFooter.on("click", function () {
			$(this).toggleClass('opened');
		});
	}

	// Opacity mask
	if($('.opacity-mask').length) {
		$('.opacity-mask').each(function(){
			$(this).css('background-color', $(this).attr('data-opacity-mask'));
		});
	}

	// Secondary fixed
	if($('.sticky_horizontal').length) {
		$('.sticky_horizontal').stick_in_parent({
			offset_top: 0
		});
	}

	// Secondary scroll
	if($('.secondary_nav').length) {
		$('.secondary_nav').find('a').on('click', function(e) {
			e.preventDefault();
			var target = this.hash;
			var $target = $(target);
			$('html, body').animate({
				'scrollTop': $target.offset().top - 60
			}, 700, 'swing');
		});
	}

	// Sticky sidebar
	if($('#sidebar_fixed').length) {
		$('#sidebar_fixed').theiaStickySidebar({
			minWidth: 991,
			updateSidebarHeight: false,
			containerSelector: '',
			additionalMarginTop: 90
		});
	}

	// Drodown options prevent close
	if($('.dropdown-options').length) {
		$('.dropdown-options .dropdown-menu').on("click", function(e) { e.stopPropagation(); });
	}

	//touchspin
	if ($('.qty-max').length) {
		var max=$(".qty-max").attr('max');
		$(".qty-max").TouchSpin({
			min: 1,
			max: max,
			buttondown_class: 'btn desc button_inc',
			buttonup_class: 'btn inc button_inc'
		});
	}

	// flatpickr
	if ($('#minTodayFlatpickr').length) {
		flatpickr(document.getElementById('minTodayFlatpickr'), {
			locale: locale,
			enableTime: false,
			dateFormat: "d-m-Y",
			minDate : "today"
		});
	}

	// dropify for more custom input file
	if ($('.dropify').length) {
		$('.dropify').dropify({
			messages: {
				default: Lang.get('admin.js.file.messages.default'),
				replace: Lang.get('admin.js.file.messages.replace'),
				remove: Lang.get('admin.js.file.messages.remove'),
				error: Lang.get('admin.js.file.messages.error')
			},
			error: {
				'fileSize': Lang.get('admin.js.file.error.fileSize', {value: '{{ value }}'}),
				'minWidth': Lang.get('admin.js.file.error.minWidth', {value: '{{ value }}'}),
				'maxWidth': Lang.get('admin.js.file.error.maxWidth', {value: '{{ value }}'}),
				'minHeight': Lang.get('admin.js.file.error.minHeight', {value: '{{ value }}'}),
				'maxHeight': Lang.get('admin.js.file.error.maxHeight', {value: '{{ value }}'}),
				'imageFormat': Lang.get('admin.js.file.error.imageFormat', {value: '{{ value }}'})
			}
		});
	}

	// Datatables normal
	if ($('.table-normal').length) {
		$('.table-normal').DataTable({
			"oLanguage": {
				"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
				"sInfo": Lang.get('admin.js.table.info', {start: '_START_', end: '_END_', total: '_TOTAL_'}),
				"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
				"sSearchPlaceholder": Lang.get('admin.js.table.search'),
				"sLengthMenu": Lang.get('admin.js.table.length', {menu: '_MENU_'}),
				"sProcessing": Lang.get('admin.js.table.processing'),
				"sZeroRecords": Lang.get('admin.js.table.empty.zero'),
				"sEmptyTable": Lang.get('admin.js.table.empty.table'),
				"sInfoEmpty": Lang.get('admin.js.table.empty.info'),
				"sInfoFiltered": Lang.get('admin.js.table.filter', {max: '_MAX_'}),
				"sInfoPostFix": "",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": Lang.get('admin.js.table.loading'),
				"oAria": {
					"sSortAscending": Lang.get('admin.js.table.sort.asc'),
					"sSortDescending": Lang.get('admin.js.table.sort.desc')
				}
			},
			"stripeClasses": [],
			"lengthMenu": [10, 20, 50, 100, 200, 500],
			"pageLength": 10
	    });
	}
})(jQuery);

function errorNotification() {
  Lobibox.notify('error', {
    title: Lang.get('admin.js.500.title'),
    sound: true,
    msg: Lang.get('admin.js.500.msg')
  });
}

// Sticky nav
if($('.element_to_stick').length) {
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 1) {
			$('.element_to_stick').addClass("sticky");
		} else {
			$('.element_to_stick').removeClass("sticky");
		}
	});
	$(window).scroll();
}

// Menu
$('a.open_close').on("click", function () {
	$('.main-menu').toggleClass('show');
	$('.layer').toggleClass('layer-is-visible');
});
$('a.show-submenu').on("click", function () {
	$(this).next().toggleClass("show_normal");
});

// Scroll to top
if($('#toTop').length) {
	var pxShow = 800; // height on which the button will show
	var scrollSpeed = 500; // how slow / fast you want the button to scroll to top.
	$(window).scroll(function(){
		if($(window).scrollTop() >= pxShow){
			$("#toTop").addClass('visible');
		} else {
			$("#toTop").removeClass('visible');
		}
	});
	$('#toTop').on('click', function(){
		$('html, body').animate({scrollTop:0}, scrollSpeed);
		return false;
	});
}

// Reserve Fixed on mobile
if($('.btn_reserve_fixed').length) {
	$('.btn_reserve_fixed a').on('click', function() {
		$(".box_order").show();
	});
	$(".close_panel_mobile").on('click', function (event){
		event.stopPropagation();
		$(".box_order").hide();
	});
}

// Shipping option, hide or show delivery data
$('input[name="shipping"]').change(function() {
	if ($(this).val()=='3') {
		$('#shippingCheckout select, #shippingCheckout input').attr('disabled', false);
		$('#shippingCheckout').removeClass('d-none');
	} else {
		$('#shippingCheckout').addClass('d-none');
		$('#shippingCheckout select, #shippingCheckout input').attr('disabled', true);
	}
});

// Select agency for delivery
$('#shippingCheckout select[name="agency_id"]').change(function() {
	if ($(this).val()=='') {
		Livewire.emit('cartDelivery', null);
	} else {
		Livewire.emit('cartDelivery', $(this).val());
	}
});

// Stripe
if($('#card-stripe-element').length) {
	var public=$("#card-stripe-element").attr('public');
	var style={
		base: {
			color: '#32325d',
			lineHeight: '18px',
			fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
			fontSmoothing: 'antialiased',
			fontSize: '16px',
			'::placeholder': {
				color: '#aab7c4'
			}
		},
		invalid: {
			color: '#fa755a',
			iconColor: '#fa755a'
		}
	};

	// Create a Stripe client.
	const stripe = Stripe(public, { locale: locale });
  	// Create an instance of Elements.
  	const elements = stripe.elements();
  	// Create an instance of the card Element.
  	const card = elements.create('card', { style: style });
  	// Add an instance of the card Element into the `card-stripe-element` <div>.
  	card.mount('#card-stripe-element');

  	card.on('change', function(event) {
  		var displayError = document.getElementById('card-errors');
  		if (event.error) {
  			displayError.textContent=event.error.message;
  		} else {
  			displayError.textContent='';
  		}
  	});

	// Create stripe token
	function createStripeToken() {
		stripe.createToken(card).then(function(result) {
			if (result.error) {
				// Inform the user if there was an error.
				var errorElement = document.getElementById('card-errors');
				errorElement.textContent = result.error.message;
				$("button[action='checkout']").attr('disabled', false);

			} else {
				// Send the token to your server.
				stripeTokenHandler(result.token);
			}
		});
	}

	// Submit the form with the token ID.
	function stripeTokenHandler(token) {
    	// Insert the token ID into the form so it gets submitted to the server
    	var form = document.getElementById('formCheckout');
    	var hiddenInput = document.createElement('input');
    	hiddenInput.setAttribute('type', 'hidden');
    	hiddenInput.setAttribute('name', 'stripeToken');
    	hiddenInput.setAttribute('value', token.id);
    	form.appendChild(hiddenInput);

		// Submit the form
		form.submit();
	}
}

// Inputs complements validation
function validationModalComplements(id) {
	var max=parseInt($('#modal-product .modal-complements').attr('max')), length=$('#modal-product .modal-complements ul input:checked').length;

	if (!$('#modal-product .modal-complements input[value="'+id+'"]').attr('checked')) {
		$('#modal-product .modal-complements input[value="'+id+'"]').attr('checked', true);
	} else {
		$('#modal-product .modal-complements input[value="'+id+'"]').attr('checked', false);
	}

	if (max<=length) {
		$('#modal-product .modal-complements ul input:not(:checked)').each(function(index, el) {
			$(this).attr('disabled', true);
		});
	} else {
		$('#modal-product .modal-complements ul input[disabled]').each(function(index, el) {
			$(this).attr('disabled', false);
		});
	}

	$('#modal-product .modal-complements ul input.disabled').each(function(index, el) {
		$(this).attr('disabled', true);
	});
}

// Add complements and continue
function nextModalComplements() {
	var complements=[], validationComplements=true, complementsCount=0, i=0;
	var groupMin=parseInt($('#modal-product .modal-complements').attr('min')), groupMax=parseInt($('#modal-product .modal-complements').attr('max'));

	$('#modal-product .modal-complements input[checked]').each(function(index, el) {
		complements[i]=$(this).val();
		complementsCount++;
		i++;
	});

	validationComplements=validationRequired(validationComplements, complementsCount, groupMin, groupMax);

	if (validationComplements) {
		$('#next-complements').attr('disabled', true);
		var data={"complements": complements};
		Livewire.emit('nextStepComplements', data);
	}
}

// Add product to cart
function addProductCart() {
	var complements=[], validationComplements=true, complementsCount=0, i=0;
	var groupMin=parseInt($('#modal-product .modal-complements').attr('min')), groupMax=parseInt($('#modal-product .modal-complements').attr('max'));

	$('#modal-product .modal-complements input[checked]').each(function(index, el) {
		complements[i]=$(this).val();
		complementsCount++;
		i++;
	});

	validationComplements=validationRequired(validationComplements, complementsCount, groupMin, groupMax);

	if (validationComplements) {
		$('#add-cart').attr('disabled', true);
		var data={"complements": complements};
		Livewire.emit('addCart', data);
	}
}

function validationRequired(validationComplements, complementsCount, groupMin, groupMax) {
	var validationMinComplements=true, validationMaxComplements=true;
	validationComplements=false;

	if (complementsCount<groupMin) {
		validationMinComplements=false;
		if (groupMin>1) {
			$('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.min', groupMin, {min: groupMin}));
		} else {
			$('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.min', 1));
		}
	}

	if (complementsCount>groupMax) {
		validationMaxComplements=false;
		if (groupMax>1) {
			$('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.max', groupMax, {max: groupMax}));
		} else {
			$('#modal-product .modal-complements p').text(Lang.choice('web.shop.modal.validations.choose.max', 1));
		}
	}

	if (validationMinComplements && validationMaxComplements) {
		validationComplements=true;
		$('#modal-product .modal-complements p').text("");
	}

	return validationComplements;
}

window.addEventListener('contentChanged', event => {
	if($('.lazy').length) {
		var lazyLoadInstance=new LazyLoad({
			elements_selector: ".lazy"
		});
	}

 	// Sticky sidebar
 	if($('#sidebar_fixed').length) {
 		$('#sidebar_fixed').theiaStickySidebar({
 			minWidth: 991,
 			updateSidebarHeight: false,
 			containerSelector: '',
 			additionalMarginTop: 90
 		});
 	}

    // Reserve Fixed on mobile
    if($('.btn_reserve_fixed').length) {
    	$('.btn_reserve_fixed a').on('click', function() {
    		$(".box_order").show();
    	});
    	$(".close_panel_mobile").on('click', function (event){
    		event.stopPropagation();
    		$(".box_order").hide();
    	});
    }
});

// Open and close add coupons
$('#btn-coupon').click(function(event) {
	toggleBtnCoupon();
});

function toggleBtnCoupon() {
	$("#card-add-coupon").toggle();
	if ($('#btn-coupon').hasClass('open')) {
		$('#btn-coupon').text(Lang.get('web.js.coupons.buttons.add'));
		$('#btn-coupon').removeClass('open');
	} else {
		$('#btn-coupon').text(Lang.get('web.js.coupons.buttons.close'));
		$('#btn-coupon').addClass('open');
	}
}

// Add coupon
$('#btn-add-coupon').click(function() {
	addCoupon();
});

function addCoupon() {
	$("#card-add-coupon .validate-coupon, #card-add-coupon .validate-email").addClass('d-none');
	$('#btn-add-coupon').attr('disabled', true);
	var coupon=$('#input-coupon').val(), email=$('input[type="email"]').val();
	if (coupon!="" && email!="") {
		$.ajax({
			url: '/coupon/add',
			type: 'POST',
			dataType: 'json',
			data: {coupon: coupon, email: email},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
		.done(function(obj) {
			if (obj.state) {
				Livewire.emit('cartCoupon', obj.coupon);

				$("#div-coupon div").remove();
				$("#div-coupon").html('<div class="alert alert-success">'+
				'<div>'+
				'<p class="mb-1">'+Lang.get('web.js.coupons.notifications.add.message')+'</p>'+
				'<a href="javascript:void(0);" id="remove-coupon">'+Lang.get('web.js.coupons.buttons.remove')+'</a>'+
				'</div>'+
				'<div>');

				// Remove coupon
				$('#remove-coupon').on('click', function() {
					removeCoupon();
				});

				Lobibox.notify('success', {
					title: Lang.get('web.js.coupons.notifications.add.title'),
					sound: true,
					msg: Lang.get('web.js.coupons.notifications.add.message')
				});
			} else {
				$('#btn-add-coupon').attr('disabled', false);
				Lobibox.notify('error', {
					title: obj.title,
					sound: true,
					msg: obj.message
				});
			}
		})
		.fail(function() {
			$('#btn-add-coupon').attr('disabled', false);
			errorNotification();
		});
	} else {
		if (email=="") {
			$("#card-add-coupon .validate-email").removeClass('d-none');
		}
		if (coupon=="") {
			$("#card-add-coupon .validate-coupon").removeClass('d-none');
		}
		$('#btn-add-coupon').attr('disabled', false);
	}
}

// Remove coupon
$('#remove-coupon').click(function() {
	removeCoupon();
});

function removeCoupon() {
	$.ajax({
		url: '/coupon/remove',
		type: 'POST',
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.state) {
			Livewire.emit('cartCoupon', null);

			$("#div-coupon div").remove();
			$("#div-coupon").html('<a href="javascript:void(0);" id="btn-coupon">'+Lang.get('web.js.coupons.buttons.add')+'</a>'+
			'<div class="row" style="display: none;" id="card-add-coupon">'+
			'<div class="form-group col-lg-8 col-md-8 col-12">'+
			'<input type="text" class="form-control" name="coupon" placeholder="'+Lang.get('form.coupon.placeholder')+'" id="input-coupon">'+
			'<p class="text-danger font-weight-bold validate-coupon d-none mb-0">'+Lang.get('validation.validate.required.default')+'</p>'+
			'<p class="text-danger font-weight-bold validate-email d-none mb-0">'+Lang.get('validation.validate.required.email')+'</p>'+
			'</div>'+
			'<div class="form-group col-lg-4 col-md-4 col-12">'+
			'<button type="button" class="btn_1 gradient full-width mb_5" id="btn-add-coupon">'+Lang.get('form.buttons.add')+'</button>'+
			'</div>'+
			'</div>');

			// // Open and close add coupons
			$('#btn-coupon').on('click', function(event) {
				toggleBtnCoupon();
			});

			// Add coupon
			$('#btn-add-coupon').on('click', function() {
				addCoupon();
			});

			Lobibox.notify('success', {
				title: Lang.get('web.js.coupons.notifications.remove.title'),
				sound: true,
				msg: Lang.get('web.js.coupons.notifications.remove.message')
			});
		} else {
			errorNotification();
		}
	})
	.fail(function() {
		errorNotification();
	});
}