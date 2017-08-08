function html5Tags(){
	document.createElement('header');  
	document.createElement('section');  
	document.createElement('nav');  
	document.createElement('footer');  
	document.createElement('menu');  
	document.createElement('hgroup');  
	document.createElement('article');  
	document.createElement('aside');  
	document.createElement('details'); 
	document.createElement('figure');
	document.createElement('time');
	document.createElement('mark');
}

html5Tags();

jQuery(document).ready(function($){	
	project = {		
		common : {
			commonLoad : function(){
				/*var nt_title = $('#nt-title').newsTicker({
                    row_height: 70,
                    max_rows: 2,
                    speed: 1000,
                    direction: 'up',
                    duration: 4000,
                    autostart: 1,
                    pauseOnHover: 1,
                    prevButton: $('#newsPrev'),
                    nextButton: $('#newsNext')
                });*/
				
				var nt_title = $('#nt-title').marquee({
    //speed in milliseconds of the marquee
    speed: 7000,
    //gap in pixels between the tickers
    gap: 50,
    //gap in pixels between the tickers
    delayBeforeStart: 0,
    //'left' or 'right'
    direction: 'left'
  });
				
				
				
				$('.pageMenu li:first-child a').addClass('active');
				$('.livenowItem').addClass('show');
								
				$('.pageMenu li a').live('click', function(e) {
														   
					$(".pageMenu").removeClass('show');	
					$(".btnMenu").removeClass('active');
					
					if ($(this).hasClass('active')) {
						
					} else {
						$(".pageMenu li a").removeClass('active');						
						$('.tabItem').removeClass("show");
						$(this).addClass('active');
						var MyHref = $(this).attr('rel');
						$(MyHref).addClass("show");
												
						var posTop = $(MyHref).offset().top;
						$('html,body').stop().animate({scrollTop: posTop},{queue: false, duration:2000, easing:'easeOutExpo'});
					
						e.preventDefault();
					}
				});
				
				
								
				$('.pageMenu.show li a').live('click', function() {
					$(".pageMenu").removeClass('show');	
					$(".btnMenu").removeClass('active');					
				});
				
				$('.settings em').click(function () {
                    if ($(this).parent().hasClass('active')) {
						
                        $(this).parent().removeClass('active');
						$('.settingsSectionCLose').removeClass('active');
						
                    } else {
                        $(this).parent().addClass('active');
						$('.settingsSectionCLose').addClass('active');
                        
                    }
                });
				
				
				
				
				$('.settingsSectionCLose.active').live("click",function(){
					$(this).removeClass('active');
					$('.settings').removeClass('active');
                });
				
				
				
				$('.pageMenu li a.dropdown').click(function () {
                    if ($(this).hasClass('active')) {
                      
						$('.dropsection').removeClass('active');
						$('.dropsectionClose').removeClass('active');
						
                    } else {
                       
						$('.dropsection').addClass('active');
						$('.dropsectionClose').addClass('active');
                        
                    }
                });
				
				
				
				$('.dropsectionClose.active').live("click",function(){
					$(this).removeClass('active');
					$('.dropsection').removeClass('active');
                });
				
				
				
				
			
				
			$('.btnMenu').click(function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $('.pageMenu').removeClass('show');
						$('.overlay').removeClass('show');
                    } else {
                        $(this).addClass('active');
                        $('.pageMenu').addClass('show');
						$('.overlay').addClass('show');
                    }
                });
				
				
				
				
				
					
			},
					
			commonInput : function(){
				$( ".queryInput" ).each(function(){
					var getInputId = $(this).find("input, textarea").attr('id');
					$(this).find("label").attr('for',getInputId);
				});
				var $inputText = $('.queryInput input, .queryInput textarea');
				$inputText.each(function(){
					var $thisHH = $(this);
					if(!$(this).val()){
						$(this).parent().find('label').show();
					}else{
						setTimeout(function(){
						$thisHH.parent().find('label').hide();
						},100);
					}
				});
				$inputText.focus(function(){
					if(!$(this).val()){
						$(this).parent().find('label').addClass('showLab');
						$(this).parent().find('input').addClass('new');
					}
				});
				$inputText.keydown(function(){
					if(!$(this).val()){
						$(this).parent().find('label').hide();
					}
				});
				$inputText.live("blur",function(){
					var $thisH = $(this);
					if(!$(this).val()){
						$(this).parent().find('label').show().removeClass('showLab');
						$(this).parent().find('input').show().removeClass('new');
					}else{
						$thisH.parent().find('label').hide();
					}
				});
			}
		}//end commonInput
	};
	project.common.commonLoad();
	project.common.commonInput();
});