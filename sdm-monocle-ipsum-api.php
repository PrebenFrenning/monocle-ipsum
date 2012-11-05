<?php
/*
Plugin Name: Monocle Ipsum - API
Description: Handles incoming API requests
Plugin URI: https://github.com/sdalmonte/monocle-ipsum
Version: 1.0
Author: Sam Dal Monte (@samd)
Author URI: http://negativeboy.com
*/

/*
Based on Bacon Ipsum 2.1.1 by Pete Nelson
https://github.com/petenelson/bacon-ipsum
http://petenelson.com
@GunGeekATX
*/

add_action('posts_selection', 'sdm_monocle_ipsum_api');
function sdm_monocle_ipsum_api() {

	if (is_page('api') && isset($_REQUEST['type'])) { 
		
		require_once 'sdm-MonocleIpsumGenerator.php';
		
		$generator = new MonocleIpsumGenerator();
		$number_of_sentences = 0;
		$number_of_paragraphs = 5;

		if (isset($_REQUEST["paras"]))
			$number_of_paragraphs = intval($_REQUEST["paras"]);

		if (isset($_REQUEST["sentences"]))
			$number_of_sentences = intval($_REQUEST["sentences"]);

		$output = '';
					
		if ($number_of_paragraphs < 1)
			$number_of_paragraphs = 1;

		if ($number_of_paragraphs > 100)
			$number_of_paragraphs = 100;

		if ($number_of_sentences > 100)
			$number_of_sentences = 100;

		$start_with_lorem = isset($_REQUEST["start-with-lorem"]) && $_REQUEST["start-with-lorem"] == "1";

		$paras = $generator->Make_Some_Meaty_Filler(
			filter_var($_REQUEST["type"], FILTER_SANITIZE_STRING), 
			$number_of_paragraphs, 
			$start_with_lorem, 
			$number_of_sentences);

		if (isset($_REQUEST["callback"])) {
			header("Content-Type: application/javascript");
			echo $_GET['callback'] . '(' . json_encode($paras) . ')';
		}
		else {
			header("Content-Type: application/json; charset=utf-8");
			echo json_encode($paras);
		}		

		exit;

	}

}
