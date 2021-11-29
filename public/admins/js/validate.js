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
					required: 'Select an option.'
				},

				state: {
					required: 'Select an option.'
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
					required: 'Select an option.'
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
				name: {
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
					required: 'Select an image.'
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
				name: {
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

				description: {
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
					required: 'Select an image.'
				},

				category_id: {
					required: 'Select an option.'
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
				name: {
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

				description: {
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
					required: 'Select an image.'
				},

				category_id: {
					required: 'Select an option.'
				}
			},
			submitHandler: function(form) {
				$("button[action='product']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Agencies
	$("button[action='agency']").on("click",function(){
		$("#formAgency").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				route: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				price: {
					required: true,
					min: 0
				},

				description: {
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
				name: {
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
});