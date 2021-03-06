<?php
/*
Plugin Name: Monocle Ipsum - Generator Form
Description: Generates the input form for generating monocle ipsum
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

//add_shortcode('sdm-monocle-ipsum-form', 'sdm_monocle_ipsum_form');
function sdm_monocle_ipsum_form($atts)
{
	$output = '';

	// Our elegant, bespoke lorem ipsum text is expertly assembled by Florian-san and his team of the finest Swiss-Japanese craftsmen in their workshop on the shores of the Zürisee.

	$form = '
		<div id="monocle-ipsum-form">

			<form id="make-it-bespoke" action="' . site_url('/') . '" method="get">
				<div id="monocle-ipsum-paras">
					<label for="paras">Paragraphs:</label>
					<input type="text" name="paras" id="paras" value="5" maxlength="2" />
				</div>
				<fieldset id="monocle-ipsum-type">
					<label for="">Type:</label>
					<div id="monocle-ipsum-type-buttons">
						<label for="business-class"><input id="business-class" type="radio" name="type" value="business-class" checked="checked" /> <span>Business Class</span></label>
						<label for="economy-class"><input id="economy-class" type="radio" name="type" value="economy-class" /> <span>Economy Class</span></label>
					</div>
				</fieldset>
				<div id="monocle-ipsum-start-with">
					<label for="start-with-lorem"><input id="start-with-lorem" type="checkbox" name="start-with-lorem" id="start-with-lorem" value="1" checked="checked" /> <span>Start with &lsquo;Monocle ipsum dolor sit amet...&rsquo;</span></label>
				</div>
				<div id="monocle-ipsum-submit">
					<button type="submit">With our compliments</button>
				</div>
			</form>
		</div>
	';


	if (isset($_REQUEST["type"]))
	{

		require_once 'sdm-MonocleIpsumGenerator.php';

		$generator = new MonocleIpsumGenerator();
		$number_of_paragraphs = 5;
		if (isset($_REQUEST["paras"]))
			$number_of_paragraphs = intval($_REQUEST["paras"]);

		$output = '';
					
		if ($number_of_paragraphs < 1)
			$number_of_paragraphs = 1;

		if ($number_of_paragraphs > 100)
			$number_of_paragraphs = 100;

		$paragraphs = $generator->Make_Some_Meaty_Filler(
			$_REQUEST["type"], 
			$number_of_paragraphs,
			isset($_REQUEST["start-with-lorem"]) && $_REQUEST["start-with-lorem"] == "1");


		$output = '<div id="monocle-ipsum-generated">';
		foreach($paragraphs as $paragraph)
			$output .= '<p>' . $paragraph . '</p>';
		 
		$output .= '</div>';
	}



	return $output . $form;

}

