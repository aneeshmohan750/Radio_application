 <!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <title><?php echo $page_title; ?></title>
         <link rel="shortcut icon" type="image/x-icon" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        
        <link rel="icon" type="image/png" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>"href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>" sizes="192x192">
        <link rel="icon" type="image/png" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>" sizes="16x16">
        <link rel="shortcut icon" href="<?php if($favicon){ ?><?php echo base_url();?>uploads/favicon/<?php echo $favicon; }else{ ?><?php echo $this->config->item('assets_url')?>onair-icon.png <?php } ?>">
        
        <script src="<?php echo $this->config->item('assets_url')?>js/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('assets_url')?>js/jquery.flexslider.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('assets_url')?>js/easing.js" type="text/javascript"></script>
        <script src="<?php echo $this->config->item('assets_url')?>js/custom_scripts.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('assets_url')?>js/wow.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('assets_url')?>js/jquery.newsTicker.js" type="text/javascript"></script>
		<script src="<?php echo $this->config->item('assets_url')?>build/mediaelement-and-player.min.js"></script>
        <script src="<?php echo $this->config->item('assets_url')?>js/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="<?php echo $this->config->item('assets_url')?>js/jquery.marquee.js"></script>
        <script src="<?php echo $this->config->item('assets_url')?>js/jquery.flexslider.js"></script>
		<script src="<?php echo $this->config->item('assets_url')?>js/jwplayer.js"></script>
        <script>jwplayer.key="wSJ9xXfWQLSUNJ5bO6bz38JeQVq15S9am4oPIg==";</script>
        <!--<script src="<?php echo $this->config->item('assets_url')?>js/jquery.tickerNews.min.js"></script>   -->
		
		<script>
			(function(doc){var addEvent='addEventListener',type='gesturestart',qsa='querySelectorAll',scales=[1,1],meta=qsa in doc?doc[qsa]('meta[name=viewport]'):[];function fix(){meta.content='width=device-width,minimum-scale='+scales[0]+',maximum-scale='+scales[1];doc.removeEventListener(type,fix,true);}if((meta=meta[meta.length-1])&&addEvent in doc){fix();scales=[.25,1.6];doc[addEvent](type,fix,true);}}(document));
		</script>
        
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url')?>css/audioplayer.css" />
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url')?>css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('assets_url')?>css/flexslider.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('assets_url')?>css/styles.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url')?>css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url')?>css/flexslider.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('assets_url')?>css/theme.css">
		<link rel="stylesheet" href="<?php echo $this->config->item('assets_url')?>build/mediaelementplayer.min.css" />
		<style>
			#pageHeader{border-top:4px solid <?php echo $company_color_theme; ?>}	
			
			.settings.active .settingsSection {border-bottom:4px solid <?php echo $company_color_theme; ?>}
			
			
		</style>
     
    <!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75467434-1', 'auto');
  ga('send', 'pageview');

</script>-->
        
    </head>
	<body>   	
		<div class="wrapper">
        	<header id="pageHeader" class="newColor">
            <?php if($check_radio_logo){ ?>
                <?php if($company_radio_logo){ ?>
            	<a class="pageLogo" href="javascript:void(0);"><img src="<?php echo base_url(); ?>uploads/radio_logo/<?php echo $company_radio_logo; ?>"></a>               <?php } ?>
            <?php } 
             else{ ?>
            	<a class="pageLogo" href="javascript:void(0);"><img src="<?php echo base_url(); ?>uploads/logo/<?php echo $company_logo; ?>"></a>
            <?php } ?>      
                
                <div class="welcomeSection">
                   <?php if($check_radio_logo){  ?>
                	<div class="logoSection"><a class="pageLogo" href="javascript:void(0);"><img src="<?php echo base_url(); ?>uploads/logo/<?php echo $company_logo; ?>"></a></div> <?php }
				  else{	?>
                   <div class="adminNameSection"><?php echo $name; ?></div>
                   <?php } ?>
                	<div class="settings">
					   <em></em>
                    	<span class="settingsSectionCLose"></span>
                    	<div class="settingsSection">
                        	<a href="<?php base_url(); ?>logout/<?php echo $company_url;?><?php if($auth_code){?>?auth=<?php echo $auth_code;?><?php }?>">logout</a>
                            <!--<a href="javascript:void(0);">Your thoughts</a>-->
                        </div>
                    </div>
                </div>
                <div class="clearFix"></div>
            </header>
            
            <menu>
            	<h4><?php if($check_radio_logo){   echo $name;  } else{ echo $company_radio; } ?> </h4>
            	<ul class="pageMenu">
                   <?php if($company_custom_menu){ ?>
                     <?php $i=1; ?>
                     <?php foreach($company_custom_menu as $custom_menu): ?>
                        <li class="<?php echo $custom_menu['class_name']; ?>"><a <?php if($i==1){echo "class='active'";} ?> href="javascript:void(0);" rel=".<?php echo $custom_menu['rel_name']; ?>"><?php echo $custom_menu['menu_name']; ?></a></li>
                        <?php $i++; ?>
                     <?php endforeach; ?>
                   <?php } ?>
                   <?php if(!$company_custom_menu){ ?>
                    <li class="menu1"><a class="active" href="javascript:void(0);" rel=".livenowItem">Live now </a></li>
                	<li class="menu2"><a class="dropdown" href="javascript:void(0);" rel=".recordedShowsItem">Recorded Shows</a></li>
                    <li class="menu3"><a href="javascript:void(0);" rel=".schedulesItem">Highlights</a></li>
                    <li class="menu4"><a href="javascript:void(0);" rel=".yourThoughtsItem">Your thoughts</a></li>
                   <?php } ?>  
                </ul>
                <span class="btnMenu">Menu</span>
                <div class="clearFix"></div>
            </menu>
            
            
 			<div class="clearFix"></div>
            
            