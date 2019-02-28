<?php
    include "adminNews/model/news.php";
    $news = News::getNewsList();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Actualites - CPEHN</title>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		
		<link id="wsite-base-style" rel="stylesheet" type="text/css" href="http://cdn2.editmysite.com/css/sites.css?buildTime=1234" />
<link rel="stylesheet" type="text/css" href="http://cdn1.editmysite.com/editor/libraries/fancybox/fancybox.css?1234" />
<link rel="stylesheet" type="text/css" href="http://cdn2.editmysite.com/css/social-icons.css?buildtime=1234" media="screen,projection" />
<link rel="stylesheet" type="text/css" href="files/main_style.css?1458291936" title="wsite-theme-css" />
<link href='http://fonts.googleapis.com/css?family=Lato:400,300,300italic,700,400italic,700italic&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Fjalla+One&subset=latin,latin-ext' rel='stylesheet' type='text/css' />

<style type='text/css'>
.wsite-elements.wsite-not-footer div.paragraph, .wsite-elements.wsite-not-footer p, .wsite-elements.wsite-not-footer .product-block .product-title, .wsite-elements.wsite-not-footer .product-description, .wsite-elements.wsite-not-footer .wsite-form-field label, .wsite-elements.wsite-not-footer .wsite-form-field label, #wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
#wsite-content div.paragraph, #wsite-content p, #wsite-content .product-block .product-title, #wsite-content .product-description, #wsite-content .wsite-form-field label, #wsite-content .wsite-form-field label, .blog-sidebar div.paragraph, .blog-sidebar p, .blog-sidebar .wsite-form-field label, .blog-sidebar .wsite-form-field label {}
.wsite-elements.wsite-footer div.paragraph, .wsite-elements.wsite-footer p, .wsite-elements.wsite-footer .product-block .product-title, .wsite-elements.wsite-footer .product-description, .wsite-elements.wsite-footer .wsite-form-field label, .wsite-elements.wsite-footer .wsite-form-field label{}
.wsite-elements.wsite-not-footer h2, .wsite-elements.wsite-not-footer .product-long .product-title, .wsite-elements.wsite-not-footer .product-large .product-title, .wsite-elements.wsite-not-footer .product-small .product-title, #wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {}
#wsite-content h2, #wsite-content .product-long .product-title, #wsite-content .product-large .product-title, #wsite-content .product-small .product-title, .blog-sidebar h2 {}
.wsite-elements.wsite-footer h2, .wsite-elements.wsite-footer .product-long .product-title, .wsite-elements.wsite-footer .product-large .product-title, .wsite-elements.wsite-footer .product-small .product-title{}
#wsite-title {}
.wsite-menu-default a {}
.wsite-menu a {}
.wsite-image div, .wsite-caption {}
.galleryCaptionInnerText {}
.fancybox-title {}
.wslide-caption-text {}
.wsite-phone {}
.wsite-headline {}
.wsite-headline-paragraph {}
.wsite-button-inner {}
.wsite-not-footer blockquote {}
.wsite-footer blockquote {}
.blog-header h2 a {}
#wsite-content h2.wsite-product-title {}
.wsite-product .wsite-product-price a {}
</style>
<style>
.wsite-background {background-image: url("images/Graph.jpg") !important;background-repeat: no-repeat !important;background-position: 50% 50% !important;background-size: 100% !important;background-color: transparent !important;background: inherit;}
body.wsite-background {background-attachment: fixed !important;}.wsite-background.wsite-custom-background{ background-size: cover !important}
</style>
		<script><!--
var STATIC_BASE = '//cdn1.editmysite.com/';
var STYLE_PREFIX = 'wsite';
//-->
</script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>

<script type="text/javascript" src="http://cdn2.editmysite.com/js/lang/fr/stl.js?buildTime=1234&"></script>
<script src="http://cdn2.editmysite.com/js/site/main.js?buildTime=1234"></script><script type="text/javascript">_W.configDomain = "www.weebly.com";</script><script>_W.relinquish && _W.relinquish()</script>
<script type="text/javascript" src="http://cdn2.editmysite.com/js/lang/fr/stl.js?buildTime=1234&"></script><script> _W.themePlugins = [];</script><script type="text/javascript"><!--
	
    var IS_ARCHIVE = 1;
	
	(function(jQuery){
		function initFlyouts(){
			initPublishedFlyoutMenus(
				[{"id":"242679570847589640","title":"Accueil","url":"index.html","target":""},{"id":"730197538380529733","title":"Formations","url":"formations.html","target":""},{"id":"918847769135821501","title":"Outplacement","url":"outplacement.html","target":""},{"id":"198683982784541924","title":"Ressources","url":"ressources.html","target":""},{"id":"212111847667000887","title":"Contact","url":"contact.html","target":""}],
				"495449991513054947",
				'',
				'active',
				false,
				{"navigation\/item":"<li {{#id}}id=\"{{id}}\"{{\/id}}\n\tclass=\"wsite-menu-item-wrap\"\n\t>\n\t<a href=\"{{url}}\"\n\t\t{{#target}}target=\"{{target}}\"{{\/target}}\n\t\tclass=\"wsite-menu-item\"\n\t\t{{#membership_required}}\n\t\t\tdata-membership-required=\"{{.}}\"\n\t\t{{\/membership_required}}\n\t\t>\n\t\t{{{title_html}}}\n\t<\/a>\n\t{{#has_children}}{{> navigation\/flyout\/list}}{{\/has_children}}\n<\/li>\n","navigation\/flyout\/list":"<div class=\"wsite-menu-wrap\" style=\"display:none\">\n\t<ul class=\"wsite-menu\">\n\t\t{{#children}}{{> navigation\/flyout\/item}}{{\/children}}\n\t<\/ul>\n<\/div>\n","navigation\/flyout\/item":"<li {{#id}}id=\"{{id}}\"{{\/id}}\n\tclass=\"wsite-menu-subitem-wrap {{#is_current}}wsite-nav-current{{\/is_current}}\"\n\t>\n\t<a href=\"{{url}}\"\n\t\t{{#target}}target=\"{{target}}\"{{\/target}}\n\t\tclass=\"wsite-menu-subitem\"\n\t\t>\n\t\t<span class=\"wsite-menu-title\">\n\t\t\t{{{title_html}}}\n\t\t<\/span>{{#has_children}}<span class=\"wsite-menu-arrow\">&gt;<\/span>{{\/has_children}}\n\t<\/a>\n\t{{#has_children}}{{> navigation\/flyout\/list}}{{\/has_children}}\n<\/li>\n"},
				{}
			)
		}
		if (jQuery) {
			jQuery(document).ready(function() { jQuery(initFlyouts); });
		}else{
			if (Prototype.Browser.IE) window.onload = initFlyouts;
			else document.observe('dom:loaded', initFlyouts);
		}
	})(window._W && _W.jQuery)
        
//-->
</script>
		
	</head>
	<body class="tall-header-page  wsite-page-actualites wsite-theme-light"><div class="wrapper">
	  <div class="paris-header">
      <div class="container">
      	<label class="hamburger"><span></span></label>
      	<div class="logo"><span class="wsite-logo">

	<a href="">
		<img src="images/cpehn2.png" style="margin-top:-10px;" />
	</a>

</span></div>
        <div class="nav desktop-nav"><ul class="wsite-menu-default">
		<li id="pg242679570847589640"
			class="wsite-menu-item-wrap"
			>
			<a href="index.html"
				
				class="wsite-menu-item"
				>
				Accueil
			</a>
			
		</li>
		<li id="pg730197538380529733"
			class="wsite-menu-item-wrap"
			>
			<a
				
				class="wsite-menu-item"
				>
				Formations
			</a>
			<div class="wsite-menu-wrap" style="display:none">
	<ul class="wsite-menu">
		<li id="wsite-nav-438550938267697333"
	class="wsite-menu-subitem-wrap "
	>
	<a href="entreprise.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Entreprise
		</span>
	</a>
	
</li>
<li id="wsite-nav-241818111694739291"
	class="wsite-menu-subitem-wrap "
	>
	<a href="demandeur-demploi.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Demandeur d'emploi
		</span>
	</a>
	
</li>
<li id="wsite-nav-988073380847008291"
	class="wsite-menu-subitem-wrap "
	>
	<a href="aides-aux-formations.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Aides aux formations
		</span>
	</a>
	
</li>

	</ul>
</div>

		</li>
		<li id="pg918847769135821501"
			class="wsite-menu-item-wrap"
			>
			<a href="outplacement.html"
				
				class="wsite-menu-item"
				>
				Outplacement
			</a>
			
		</li>
		<li id="pg198683982784541924"
			class="wsite-menu-item-wrap"
			>
			<a href="ressources.html"
				
				class="wsite-menu-item"
				>
				Ressources
			</a>
			<div class="wsite-menu-wrap" style="display:none">
	<ul class="wsite-menu">
		<li id="wsite-nav-572303556406734633"
	class="wsite-menu-subitem-wrap "
	>
	<a href="veille-technologique.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Veille Technologique
		</span>
	</a>
	
</li>
<li id="wsite-nav-594193428907302906"
	class="wsite-menu-subitem-wrap "
	>
	<a href="ateliers.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Ateliers
		</span>
	</a>
	
</li>
<li id="wsite-nav-717189709598601288"
	class="wsite-menu-subitem-wrap "
	>
	<a href="stages-pour-enfants.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Stages pour enfants
		</span>
	</a>
	
</li>
<li id="wsite-nav-959504763171472677"
	class="wsite-menu-subitem-wrap "
	>
	<a href="evenements.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Evenements
		</span><span class="wsite-menu-arrow">&gt;</span>
	</a>
	<div class="wsite-menu-wrap" style="display:none">
	<ul class="wsite-menu">
		<li id="wsite-nav-940394758294440406"
	class="wsite-menu-subitem-wrap "
	>
	<a href="hacknowledge.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Hacknowledge
		</span>
	</a>
	
</li>
<li id="wsite-nav-963625043323705847"
	class="wsite-menu-subitem-wrap "
	>
	<a href="30-ans-du-cpe-hn.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			30 ans du CPE-HN
		</span>
	</a>
	
</li>

	</ul>
</div>

</li>

	</ul>
</div>

		</li>
		<li id="pg212111847667000887"
			class="wsite-menu-item-wrap"
			>
			<a href="contact.html"
				
				class="wsite-menu-item"
				>
				Contact
			</a>
			
		</li>
</ul>
</div>
      </div><!-- end .container -->
	  </div><!-- end .header -->  
	        
		<div class="banner-wrap wsite-background wsite-custom-background">
			<div class="container">
				<div class="banner">
					<h2><span class="wsite-text wsite-headline">
	CPE-HN
</span></h2>
					<p><span class="wsite-text wsite-headline-paragraph">
	ACtualités récentes
</span></p>	
				</div>
			</div>
		</div>


		<div class="main-wrap">
	    <div class="container">
	 			<div class="content-wrap">
                                    <div id='wsite-content' class='wsite-elements wsite-not-footer'>
<div class="wsite-spacer" style="height:10px;"></div>

<div class="paragraph" style="text-align:center;"><span>Conseil : venez visiter cette page r&eacute;guli&egrave;rement pour rester informer des derni&egrave;res activit&eacute;s du CPE-HN.<br /> Consultez aussi notre lettre d'information<br />&#8203;</span></div>

<div class="wsite-spacer" style="height:10px;"></div>

<div id="cadre_news" style="height: 288px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                        <?php 
                        
                            $index = 0;
                            $nbrNewsAffichees = 0;
                            foreach($news as $key => $new){
                                if($new['accueil'] == 1){
                                    $nbrNewsAffichees++;                                    
                                ?>
                                    <div id="news_<?php echo $index+1; ?>" class="pv-30 feature-box margin-clear text-center" <?php if($index != 0){echo " style=\"display:none;\" ";} ?> >
                                        <h3 style="text-align:center;font-size: 24px;color: #333333;line-height: 1.2;"><?php echo $new['titre']; ?></h3>
                                        <div class="separator clearfix" style="background-color:#666666;text-align:justify;width: 100%;margin: 20px auto 15px;position: relative;height: 1px;margin-top: 15px;"></div>
                                        <?php echo str_replace("../images","images",$new['contenu']); ?>
                                    </div>
                                <?php
                                $index++;
                                }
                            }
                        
                        ?>
                    </div>
                    <div style="text-align:center;">
                        <?php
                        
                            $index = 0;
                            foreach($news as $key => $new){
                                if($new['accueil'] == 1){
                                ?>
                                    <span id="bouton_news_<?php echo $index+1; ?>" 
                                        class="bouton_news " 
                                        onclick="news(<?php echo $index+1; ?>);" 
                                        style="<?php if($index == 0){echo "height:14px;width:14px;";}else{echo "height:12px;width:12px;";} ?>background-color:#09afdf;display:inline-block;cursor:pointer;border-radius:7px;"></span> 
                                <?php
                                $index++;
                                }
                            }
                         
                         
                        ?>
                    </div>

</div></div>
</div>
	  	</div><!-- end container -->
	  </div>

    <div class="footer-wrap">
    	<div class="container">
    		<div class="footer">(c) CPE-HN Centre de Perfectionnement pour Employés des provinces de Hainaut et de Namur - 2016</div>
    	</div><!-- end container -->
    </div><!-- end footer-wrap -->
	</div>

    <div class="nav mobile-nav">
        <label class="hamburger"><span></span></label>
        <ul class="wsite-menu-default">
        		<li id="pg242679570847589640"
        			class="wsite-menu-item-wrap"
        			>
        			<a href="index.html"
        				
        				class="wsite-menu-item"
        				>
        				Accueil
        			</a>
        			
        		</li>
        		<li id="pg730197538380529733"
        			class="wsite-menu-item-wrap"
        			>
        			<a
        				
        				class="wsite-menu-item"
        				>
        				Formations
        			</a>
        			<div class="wsite-menu-wrap" style="display:none">
	<ul class="wsite-menu">
		<li id="wsite-nav-438550938267697333"
	class="wsite-menu-subitem-wrap "
	>
	<a href="entreprise.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Entreprise
		</span>
	</a>
	
</li>
<li id="wsite-nav-241818111694739291"
	class="wsite-menu-subitem-wrap "
	>
	<a href="demandeur-demploi.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Demandeur d'emploi
		</span>
	</a>
	
</li>
<li id="wsite-nav-988073380847008291"
	class="wsite-menu-subitem-wrap "
	>
	<a href="aides-aux-formations.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Aides aux formations
		</span>
	</a>
	
</li>

	</ul>
</div>

        		</li>
        		<li id="pg918847769135821501"
        			class="wsite-menu-item-wrap"
        			>
        			<a href="outplacement.html"
        				
        				class="wsite-menu-item"
        				>
        				Outplacement
        			</a>
        			
        		</li>
        		<li id="pg198683982784541924"
        			class="wsite-menu-item-wrap"
        			>
        			<a href="ressources.html"
        				
        				class="wsite-menu-item"
        				>
        				Ressources
        			</a>
        			<div class="wsite-menu-wrap" style="display:none">
	<ul class="wsite-menu">
		<li id="wsite-nav-572303556406734633"
	class="wsite-menu-subitem-wrap "
	>
	<a href="veille-technologique.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Veille Technologique
		</span>
	</a>
	
</li>
<li id="wsite-nav-594193428907302906"
	class="wsite-menu-subitem-wrap "
	>
	<a href="ateliers.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Ateliers
		</span>
	</a>
	
</li>
<li id="wsite-nav-717189709598601288"
	class="wsite-menu-subitem-wrap "
	>
	<a href="stages-pour-enfants.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Stages pour enfants
		</span>
	</a>
	
</li>
<li id="wsite-nav-959504763171472677"
	class="wsite-menu-subitem-wrap "
	>
	<a href="evenements.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Evenements
		</span><span class="wsite-menu-arrow">&gt;</span>
	</a>
	<div class="wsite-menu-wrap" style="display:none">
	<ul class="wsite-menu">
		<li id="wsite-nav-940394758294440406"
	class="wsite-menu-subitem-wrap "
	>
	<a href="hacknowledge.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			Hacknowledge
		</span>
	</a>
	
</li>
<li id="wsite-nav-963625043323705847"
	class="wsite-menu-subitem-wrap "
	>
	<a href="30-ans-du-cpe-hn.html"
		
		class="wsite-menu-subitem"
		>
		<span class="wsite-menu-title">
			30 ans du CPE-HN
		</span>
	</a>
	
</li>

	</ul>
</div>

</li>

	</ul>
</div>

        		</li>
        		<li id="pg212111847667000887"
        			class="wsite-menu-item-wrap"
        			>
        			<a href="contact.html"
        				
        				class="wsite-menu-item"
        				>
        				Contact
        			</a>
        			
        		</li>
        </ul>
    </div>
            
            <script type="text/javascript" src="files/theme/plugins.js"></script>
            <script type="text/javascript" src="files/theme/custom.js"></script>
            <script>
    var last_news = 1;
    
    var nbr_news = <?php echo $nbrNewsAffichees; ?>;
    var hauteur_max_news = 0;
    
    for(i=1; i<= nbr_news; i++){
        hauteur_temp =  $("#news_"+i).height();
        if(hauteur_temp > hauteur_max_news){
            hauteur_max_news = hauteur_temp;
        }
    }
    
    hauteur_max_news += 60;
    
    $("#cadre_news").height(hauteur_max_news);
    
    var newsTimeout;

    function news(id_news){      
        
        if(last_news != id_news)
        {
            $("#news_"+last_news).fadeOut(400, function(){
                $("#news_"+id_news).fadeIn(400, function(){});
            });
            for(i=1; i<= nbr_news; i++){
                if(id_news == i){
                    $("#bouton_news_"+i).animate({height : "14px",width : "14px"}, 200);
                    
                }else{
                    $("#bouton_news_"+i).animate({height : "12px",width : "12px"}, 200);
                }
            }
            last_news = id_news;
            window.clearTimeout(newsTimeout);
        }
    }  
    
    function defilement_news(){
        if(last_news+1 > nbr_news){
            news(1);
        }else{
            news(last_news+1);
        }
        newsTimeout = window.setTimeout(function(){defilement_news()}, 10000);
    }
    
    newsTimeout = window.setTimeout(function(){defilement_news()}, 10000);
    </script>

		
		
	</body>
</html>
