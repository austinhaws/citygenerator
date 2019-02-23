<?php

namespace App\Http\Controllers\Dictionary\Services;

class ConvertService
{
    /**
     * convert text to another language
     *
     * @param string $dictionaryName which dictionary to use
     * @param string $text the text to convert
     * @param bool $shuffle can the words be shuffled
     * @return string the translated string
     */
    public function convert(string $dictionaryName, string $text, bool $shuffle)
    {
echo "TODO: dictionary convert needs created\n";
        return $text;
    }
//
// 	require_once('global.inc');
//
// 	function get_random_weighted_array($array) {
// 		if (!is_array($array)) {
// 			return $array;
// 		}
// 		$count = 0;
// 		for ($i = count($array); $i >= 0; --$i) {
// 			$count += $i;
// 		}
// 		$count = rand(0, $count - 1);
// 		$pos = count($array) - 1;
// 		while ($count > 0) {
// 			$count -= $pos + 1;
// 			--$pos;
// 		}
// 		return $array[$pos];
// 	}
//
// 	function get_phrase_to($phrase_array) {
// 		$phrase = get_random_weighted_array($phrase_array);
// 		return get_random_weighted_array(explode(' ', is_array($phrase) ? $phrase['to_phrase'] : $phrase ));
// 	}
//
// 	function array_key_exists_nc($key, $search) {
// 		if (array_key_exists($key, $search)) {
// 			return $key;
// 		}
// 		if (!(is_string($key) && is_array($search) && count($search))) {
// 			return false;
// 		}
// 		$key = strtolower($key);
// 		foreach ($search as $k => $v) {
// 			if (strtolower($k) == $key) {
// 				return $k;
// 			}
// 		}
// 		return false;
// 	}
//
// 	function has_translation($phrases, $word) {
// 		foreach ($phrases as $phrase) {
// 			if (strcasecmp($phrase['from_phrase'], $word) == 0) {
// 				return true;
// 			}
// 		}
// 		return false;
// //		return array_key_exists_nc($word, $phrases);
// 	}
//
// 	function get_translation($phrases, $word, $history) {
// 		foreach ($phrases as $phrase) {
// 			if (strcasecmp($phrase['from_phrase'], $word) == 0) {
// 				return do_chain($phrases, get_phrase_to($phrase['to_phrase']), $history);
// 			}
// 		}
// 		return false;
// /*		$key = array_key_exists_nc($word, $phrases);
// 		return $key ? do_chain($phrases, get_phrase_to($phrases[$key]), $history) : false;
// */
// 	}
//
// 	function do_chain($phrases, $word, $history) {
// 		while (substr($word, 0, 1) == '*') {
// 			$word = substr($word, 1);
// 			if (has_translation($phrases, $word) && false === array_search($word, $history)) {
// 				$history[] = $word; // don't infinitely repeat!
// 				$temp = get_phrase_to(get_translation($phrases, $word, $history));
// 				if ($temp) {
// 					$word = $temp;
// 				}
// 			}
// 		}
// 		return $word;
// 	}
//
// 	function convert_word($phrases, $word, $history) {
// 		// if '*' is the first character of the word, then lookup chain for matching
// 		if (substr($word, 0, 1) == '*') {
// 			$word = do_chain($phrases, $word, $history);
// 		} else {
// 			// ELSE, lookup word
// 			$translation = get_translation($phrases, $word, $history);
// 			if ($translation) {
// 				$word = do_chain($phrases, get_phrase_to($translation), $history);
// 			} elseif (strlen($word) > 1) {
// 				// if word not found then replace character by character
// 				$temp = '';
// 				$count = strlen($word);
// 				for ($i = 0; $i < $count; ++$i) {
// 					$temp .= convert_word($phrases, substr($word, $i, 1), $history);
// 				}
// 				$word = $temp;
// 			} else {
// 				// leave single character as is since it doesn't have a conversion
// 			}
// 		}
// 		return $word;
// 	}
//
// 	function convert($text, $shuffle, $dictionary_id) {
// 		$result_strs = array();
//
// 		// get phrases
// 		$phrases = new adodb_phrase();
// 		$phrases = adodb_to_array($phrases, $phrases->find('dictionary_id = ? ORDER BY from_phrase ASC', array($dictionary_id), 'from_phrase'));
//
// 		foreach ($phrases as $key => $value) {
// 			$phrases[trim($key)] = $value;
// 		}
// 		// separate phrases by having a space or not having a space
//
// 		foreach ($phrases as $from => $phrase_array) {
// 			if (false !== strpos($from, ' ')) {
// 				// it's a spacer, so replace it in the phrase since later word will be chunked by spaces
// 				// spacers replace with spacers, so don't pick just one of the items from the space result
// 				while (false !== ($pos = stripos($text, $from))) {
// 					$phrase = $phrase_array[rand(0, count($phrase_array) - 1)];
// 					$result_strs[] = array('phrase' => substr($text, 0, $pos - 1), 'converted' => false);
// 					$result_strs[] = array('phrase' => do_chain($phrases, $phrase['to_phrase'], array()), 'converted' => true);
// 					$text = substr($text, $pos + strlen($phrase['from_phrase']));
// 				}
// 			}
// 		}
// 		if ($text) {
// 			$result_strs[] = array('phrase' => $text, 'converted' => false);
// 		}
//
// 		// convert all parts that are not yet converted
// 		foreach ($result_strs as $key => $result_str) {
// 			if (!$result_str['converted']) {
// 				$chunks = explode(' ', $result_str['phrase']);
// 				$result_str['converted'] = true;
// 				// chunk words of text
// 				$result_str['phrase'] = array();
// 				foreach ($chunks as $chunk) {
// 					if ($chunk) {
// 						// go through words, and convert_word() on them
// 						$result_str['phrase'][] = convert_word($phrases, $chunk, array());
// 					}
// 				}
// 				// if "shuffle" then shuffle the converted words
// 				if ($shuffle) {
// 					shuffle($result_str['phrase']);
// 				}
// 				$result_str['phrase'] = implode(' ', $result_str['phrase']);
//
// 				$result_strs[$key] = $result_str;
// 			}
// 		}
//
// 		// combine result strs
// 		$str = '';
// 		foreach ($result_strs as $result_str) {
// 			if ($str) {
// 				$str .= ' ';
// 			}
// 			$str .= $result_str['phrase'];
// 		}
//
// 		return $str;
// 	}
}
