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
			locale: 'es',
			enableTime: false,
			dateFormat: "d-m-Y",
			minDate : "today"
		});
	}

	// mCustomScrollbar
	if ($('.cart-header').length) {
		$(".cart-header").mCustomScrollbar({
			setHeight: 200,
			autoHideScrollbar: true,
			scrollbarPosition: "outside",
			theme: "dark-1" 
		});
	}

	// dropify for more custom input file
	if ($('.dropify').length) {
		$('.dropify').dropify({
			messages: {
				default: 'Arrastre y suelte una imagen o da click para seleccionarla',
				replace: 'Arrastre y suelte una imagen o haga click para reemplazar',
				remove: 'Remover',
				error: 'Lo sentimos, el archivo es demasiado grande'
			},
			error: {
				'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} máximo).',
				'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
				'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
				'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
				'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
				'imageFormat': 'El formato de imagen no está permitido (Debe ser {{ value }}).'
			}
		});
	}

	// Datatables normal
	if ($('.table-normal').length) {
		$('.table-normal').DataTable({
			"oLanguage": {
				"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
				"sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
				"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
				"sSearchPlaceholder": "Buscar...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sProcessing":     "Procesando...",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún resultado disponible en esta tabla",
				"sInfoEmpty":      "No hay resultados",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
			"stripeClasses": [],
			"lengthMenu": [10, 20, 50, 100, 200, 500],
			"pageLength": 10
		});
	}
})(jQuery);

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
	const stripe = Stripe(public, { locale: 'es' });
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

    // mCustomScrollbar
	// if($('.cart-header').length) {
	// 	$(".cart-header").mCustomScrollbar({
	// 		setHeight: 200,
	// 		autoHideScrollbar: true,
	// 		scrollbarPosition: "outside",
	// 		theme: "dark-1" 
	// 	});
	// }
});