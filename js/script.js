$(document).ready(function() {
	
	// login form
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});

	// set focus on first form elemnt
	$("form").find('input[type=text],textarea,select').filter(':visible:first').focus();

	// get info empresa
	//$.get("info_empresa.php", function(data){$("#datosEmpresa").html(data);});

	// initialize tabs
	if ($("#tabs").size()) {
		initTabs('tabs',Array('Inicio'),0,99,250,Array(false));
	}
	
	// set focus on next element
 	$('form').on('keydown', 'input', function (event) {
		if (event.which == 13) {
			//event.preventDefault();
			var index = $('input').index(this) + 1;
			$('input').eq(index).focus();
		}
    });

 	//login form submit
	if ($(".login-form").size()) {
		$(".login-form").validate({
	  		debug: true,
	  		onfocusout: false,
	  		//errorLabelContainer: ".mensaje",
	  		//wrapper: "li",
	  		//messages: {
	    	//	usuario: "El campo Usuario es obligatorio.",
	    	//	clave: "El campo Clave es obligatorio.",
			//},
			submitHandler: function(form) {
				$.post("login.php", $('.login-form').serialize() ,function(data) {
					if (data == 200) {
						window.location.href="/";
					}else{
						$('.mensaje').html(data).fadeIn(500).fadeOut(7000);
						$("#usuario").focus();
					}
				});
			}
		});
	}








});