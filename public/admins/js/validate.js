$(document).ready(function(){
	// User login
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='login']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// User register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/users/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				terms: {
					required: true
				}
			},
			submitHandler: function(form) {
				$("button[action='register']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Recover password
	$("button[action='recovery']").on("click",function(){
		$("#formRecovery").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='recovery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reset Password
	$("button[action='reset']").on("click",function(){
		$("#formReset").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='reset']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Profile
	$("button[action='profile']").on("click",function(){
		$("#formProfile").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				address: {
					required: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			submitHandler: function(form) {
				$("button[action='profile']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Users
	$("button[action='user']").on("click",function(){
		$("#formUser").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/users/email",
						type: "get"
					}
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				address: {
					required: true,
					minlength: 5,
					maxlength: 191
				},

				type: {
					required: true
				},

				state: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				type: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='user']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Customers
	$("button[action='customer']").on("click",function(){
		$("#formCustomer").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/users/email",
						type: "get"
					}
				},

				state: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='customer']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Categories
	$("button[action='category']").on("click",function(){
		$("#formCategory").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: false
				}
			},
			messages:
			{
				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='category']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Products (Create)
	$("button[action='product']").on("click",function(){
		$("#formProduct").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: true
				},

				price: {
					required: true,
					min: 0
				},

				"description[]": {
					required: false,
					minlength: 2,
					maxlength: 1000
				},

				category_id: {
					required: true
				}
			},
			messages:
			{
				image: {
					required: 'Seleccione una imagen.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='product']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Products (Edit)
	$("button[action='product']").on("click",function(){
		$("#formProductEdit").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: false
				},

				price: {
					required: true,
					min: 0
				},

				"description[]": {
					required: false,
					minlength: 2,
					maxlength: 1000
				},

				category_id: {
					required: true
				}
			},
			messages:
			{
				image: {
					required: 'Seleccione una imagen.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='product']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Products (Assign Groups)
	$("button[action='product']").on("click",function(){
		$("#formAssignProductGroup").validate({
			rules:
			{
				group_id: {
					required: true
				}
			},
			messages:
			{
				group_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='product']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Complements (Create)
	$("button[action='complement']").on("click",function(){
		$("#formComplement").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: true
				},

				price: {
					required: true,
					min: 0
				},

				"description[]": {
					required: false,
					minlength: 2,
					maxlength: 1000
				}
			},
			messages:
			{
				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='complement']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Complements (Edit)
	$("button[action='complement']").on("click",function(){
		$("#formComplementEdit").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: false
				},

				price: {
					required: true,
					min: 0
				},

				"description[]": {
					required: false,
					minlength: 2,
					maxlength: 1000
				}
			},
			messages:
			{
				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='complement']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Groups
	$("button[action='group']").on("click",function(){
		$("#formGroup").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				condition: {
					required: true
				},

				min: {
					required: true,
					min: 0,
					max: 100
				},

				max: {
					required: true,
					min: 1,
					max: 100
				},

				attribute_id: {
					required: true
				},

				state: {
					required: true
				}
			},
			messages:
			{
				condition: {
					required: 'Seleccione una opción.'
				},

				attribute_id: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='group']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Groups (Assign Complements)
	$("button[action='group']").on("click",function(){
		$("#formAssignGroupComplement").validate({
			rules:
			{
				"complement_id[]": {
					required: true
				},

				"price[]": {
					required: true,
					min: 0
				},

				"state[]": {
					required: true
				}
			},
			messages:
			{
				"name[]": {
					required: 'Seleccione una opción.'
				},

				"price[]": {
					min: 'Ingrese un valor mayor o igual que {0}.'
				},

				"state[]": {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='group']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Agencies
	$("button[action='agency']").on("click",function(){
		$("#formAgency").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				"route[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				price: {
					required: true,
					min: 0
				},

				"description[]": {
					required: false,
					minlength: 2,
					maxlength: 1000
				}
			},
			submitHandler: function(form) {
				$("button[action='agency']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Attributes
	$("button[action='attribute']").on("click",function(){
		$("#formAttribute").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			submitHandler: function(form) {
				$("button[action='attribute']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Currencies
	$("button[action='currency']").on("click",function(){
		$("#formCurrency").validate({
			rules:
			{
				"name[]": {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				iso: {
					required: true,
					minlength: 3,
					maxlength: 3
				},

				symbol: {
					required: true,
					minlength: 1,
					maxlength: 2
				}
			},
			submitHandler: function(form) {
				$("button[action='currency']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Settings
	$("button[action='setting']").on("click",function(){
		$("#formSetting").validate({
			rules:
			{
				currency_id: {
					required: true
				},

				"terms[]": {
					required: false,
					minlength: 1,
					maxlength: 16770000
				},

				"privacity[]": {
					required: false,
					minlength: 1,
					maxlength: 16770000
				},

				stripe_public: {
					required: true,
					minlength: 5,
					maxlength: 191
				},

				stripe_secret: {
					required: true,
					minlength: 5,
					maxlength: 191
				}
			},
			messages:
			{
				currency_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='setting']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Checkout
	$("button[action='checkout']").on("click",function(){
		$("#formCheckout").validate({
			rules:
			{
				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				shipping: {
					required: true
				},

				agency_id: {
					required: true
				},

				address: {
					required: true,
					minlength: 5,
					maxlength: 191
				},

				payment: {
					required: true
				}
			},
			messages:
			{
				shipping: {
					required: 'Seleccione una opción.'
				},

				agency_id: {
					required: 'Seleccione una opción.'
				},

				payment: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='checkout']").attr('disabled', true);
				// Create Stripe Token
				createStripeToken();
    		}
    	});
	});
});