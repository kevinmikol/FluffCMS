$(document).ready(function() {
$(window).load(function(){
	$(".login").fadeIn();
	$(".loading").fadeOut();
});

if($.fn.placeholder) {
	$('[placeholder]').placeholder();
};

$("#login").submit( function () {    
  $.post(
	  'system/AJAX/login.php',
	$(this).serialize(),
	function(data){ 
	if(data=="true"){
		window.location.href = '../a';
		$("#login input[type=submit]").animate({
			width: '145',
			opacity: 0.7
		}, 35, function(){
			$("#login input[type=submit]").val('Logging in..');
			$('#login input[type=submit]').attr('disabled', 'disabled');
		});
	}else if(data!=="true"){
		$("#login").effect("shake", {distance: 6, times: 2}, 35);
		$("#login")[0].reset();
	}
	});
  return false;   
});
			
});
