//Após a leitura do documento...
jQuery(document).ready(function($){

	//Capturando largura e altura da tela
	var screenWidth = $('body').width();
	var screenHeight = $('body').height();
	
	//Animação do scroll da navegação
	$.scrollIt();
	//Aplicando altura da tela ao cabeçalho e seções principais...
    $('.header').css('height', screenHeight);
    if(screenWidth >= 768){
    	$('.navbar-menu-principal').css('height', screenHeight);
    }
	if(screenWidth > 1280){		
		$('section.principal').css('height', screenHeight);		
	}

	//Menu
	$('.navbar-toggler').click(function(){
		if($('#menu-principal').hasClass('show')){
            if(screenWidth >= 768){
			    $('.navbar-menu-principal .navbar-collapse').css('right', '-250px');
            }
            else{
                $('.navbar-menu-principal .navbar-collapse').css('visibility', 'hidden');                
            }
		}
		else{
			if(screenWidth < 768){
 	           	$('.navbar-menu-principal').css('height', screenHeight);
 	           	$('.navbar.navbar-menu-principal').css('position', 'fixed');
 	           	$('.navbar-menu-principal .navbar-collapse').css('visibility', 'visible');  
 	           	$('.navbar-menu-principal a').click(function(){
 	           		$('.navbar-menu-principal').css('height', 0);
 	           		$('.navbar.navbar-menu-principal').css('position', 'absolute');
 	           		$('.navbar-menu-principal .navbar-collapse').css('visibility', 'hidden');  	           		
 	           		if($('#menu-principal').hasClass('show')){
 	           			$('.navbar-toggler').attr('aria-expanded', 'false');
 	           			$('#menu-principal').removeClass('show');
 	           		} 	        	           	
 	           	});
 	        }
			else{
				$('.navbar-menu-principal .navbar-collapse').css('right', '0');
			}
		}
	});
	
});