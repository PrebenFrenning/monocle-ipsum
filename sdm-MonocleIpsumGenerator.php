<?php 
/*
Class: Monocle Ipsum Generator
Author: Sam Dal Monte (@samd)
Version: 1.0

Based on Bacon Ipsum 2.1.1 by Pete Nelson
https://github.com/petenelson/bacon-ipsum
http://petenelson.com
@GunGeekATX
*/

class MonocleIpsumGenerator {
		
	function GetWords($type) {


		$meat = array(
			'bitches',
			'dollars',
			'hoes',
			'brus',
			'playa',
			'game',
			'penger',
			'gangsta',
			'tone',
			'jumanji',
			'pimp',
			'g-party',
			'money',
			'vanilla coke',
			'pimp lotion',
			'g-shit',
			'booty',
			'famous',
			'Breezy',
			'bossy',
			'bawler',
			'Bosko',
			'Big Ice',
			'Dreamliner',
			'bling',
			'sjarm',
			'barm',
			'wardrobe',
			'big Big Ice',
			'perfect',
			'champions',
			'bag med penger',
			'cash',
			'millioner',
			'ambisjoner',
			'baby',
			'hensynsløs kapitalist',
			'fuck yeah',
			'popper min colla',
			'Code Red',
			'easy',
			'Cherry Coke',
			'finest',
			'Beezyboy',
			'instamatic',
			'Grandiose',
			'grade A-shit',
			'playaz',
			'remix',
			'extraordinary',
			'Montebello',
			'international',
			'boulevard',
			'Anders Anaconda',
			'smart',
			'smestad',
			'hardcore',
			'ligge med',
			'exquisite',
			'handsome',
			'remarkable',
			'joy',
			'playboy',
			'classic',
			'premium',
			'west coast',
			'LA',
			'Lotion',
			'Pimp Smestad',
			'wheelz',
			'norsk boss',
			'lyrics',
			'superhorny',
			'St Moritz',
			'iconic',
			'Baby Bash',
			'Snoop',
			'the best',
			'essential',
			'Da Playboy Foundation',
			'sophisticated',
			'lady',
			'korte topper',
			'Oral Nadal',
			'hardcore',
			'craftsmanship',
			'lobster og shrimp',
			'first-class',
			'mack-hand',
			'sexy',
			'smooth',
			'Big Beezy McEnroe',
			'talk box'		
		);

		$filler = array(
				'consectetur',
				'adipisicing',
				'elit',
				'sed',
				'do',
				'eiusmod',
				'tempor',
				'incididunt',
				'ut',
				'labore',
				'et',
				'dollare',
				'magna',
				'aliqua',
				'ut',
				'enim',
				'ad',
				'minim',
				'veniam',
				'quis',
				'nostrud',
				'exercitation',
				'ullamco',
				'laboris',
				'nisi',
				'ut',
				'aliquip',
				'ex',
				'ea',
				'commodo',
				'consequat',
				'duis',
				'aute',
				'irure',
				'dolor',
				'in',
				'reprehenderit',
				'in',
				'voluptate',
				'velit',
				'esse',
				'cillum',
				'dolore',
				'eu',
				'fugiat',
				'nulla',
				'pariatur',
				'excepteur',
				'sint',
				'occaecat',
				'cupidatat',
				'non',
				'proident',
				'sunt',
				'in',
				'vulva',
				'qui',
				'officia',
				'deserunt',
				'mollit',
				'anim',
				'id',
				'est',
				'laborum');


		if ($type == 'economy-class')
			$words = array_merge($meat, $filler);
		else
			$words = $meat;


		shuffle($words);

		return $words;

	}
	

	function Make_a_Sentence($type)	{
		// A sentence should be between 4 and 15 words.
		$sentence = '';
		$length = rand(4, 15);
		
		// Add a little more randomness to commas, about 2/3rds of the time
		$includeComma = $length >= 7 && rand(0,2) > 0;

		$words = $this->GetWords($type);
			
		if (count($words) > 0)
		{
			// Capitalize the first word.
			$words[0] =  ucfirst($words[0]);

			for ($i = 0; $i < $length; $i++) {
				
				if ($i > 0) {
					if ($i >= 3 && $i != $length - 1 && $includeComma) {
						
						if (rand(0,1) == 1) {	
							$sentence = rtrim($sentence) . ', ';
							$includeComma = false;
						}
						else 
							$sentence .= ' ';
					}
					else
						$sentence .= ' ';
				
				}			

				$sentence .= $words[$i];
			}				
			

			$sentence = rtrim($sentence) . '. ';
		}

		return $sentence;

	}

	public function Make_a_Paragraph($type)	{
		// A paragraph should be bewteen 4 and 7 sentences.

		$para = '';
		$length = rand(4, 7);
		
		for ($i = 0; $i < $length; $i++)
			$para .= $this->Make_a_Sentence($type) . ' ';
		
		return rtrim($para);

	}

	public function Make_Some_Meaty_Filler(
		$type = 'economy-class', 
		$number_of_paragraphs = 5, 
		$start_with_lorem = true, 
		$number_of_sentences = 0) {

		$paragraphs = array();
		if ($number_of_sentences > 0)
			$number_of_paragraphs = 1;

		$words = '';

		for ($i = 0; $i < $number_of_paragraphs; $i++) {

			if ($number_of_sentences > 0) {
				for ($s = 0; $s < $number_of_sentences; $s++)
					$words .= $this->Make_a_Sentence($type);
			}
			else
				$words = $this->Make_a_Paragraph($type);

			if ($i == 0 && $start_with_lorem && count($words) > 0) { 	
				$words[0] = strtolower($words[0]);
				$words = 'Oral ipsum dolor sit amet ' . $words;
			}
					
			$paragraphs[]  = rtrim($words);

		}

		return $paragraphs;

	}


}