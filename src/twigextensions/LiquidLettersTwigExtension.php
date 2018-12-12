<?php
/**
 * Liquid Letters plugin for Craft CMS 3.x
 *
 * Count words, get reading times, and convert text to list items.
 *
 * @link      https://www.theindigoviking.com
 * @copyright Copyright (c) 2018 The Indigo Viking
 */

namespace indigoviking\liquidletters\twigextensions;

use indigoviking\liquidletters\LiquidLetters;

use Craft;

/**
 * @author    The Indigo Viking
 * @package   LiquidLetters
 * @since     1.0.0
 */
class LiquidLettersTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'LiquidLetters';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('wordCount', [$this, 'wordCount']),
            new \Twig_SimpleFilter('readTime', [$this, 'readTime']),
			new \Twig_SimpleFilter('toList', [$this, 'toList']),
        ];
    }
    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('wordCount', [$this, 'wordCount']),
            new \Twig_SimpleFunction('readTime', [$this, 'readTime']),
            new \Twig_SimpleFunction('toList', [$this, 'toList']),
        ];
    }
    /**
     * php pathinfo() wrapper -- http://php.net/manual/en/function.pathinfo.php
     *
     * @param $path
     * @param bool $options
     * @return mixed
     */
    public function explodeIt($content)
    {
	    $content = strip_tags($content);
		$content = str_replace("\n", ' ', $content);
		$content = preg_replace("/\s+/", ' ', $content);
		$content = trim($content);
		$words = explode(' ', $content);
		
	    return $words;
    }
     
	public function wordCount($content)
	{
		$words = explodeIt($content);
		
		return count($words);
	}
	
	public function readTime($content, $timing)
	{
		$words = explodeIt($content);
		
		if ($timing == 'min') {
			$time = ceil(count($words) / 225);
		}
		elseif ($timing == 'sec') {
			$time = ceil(count($words) / 3.75);
		}
		elseif ($timing == 'hr') {
			$time = ceil(count($words) / 13500);
		}
		elseif ($timing == 'day') {
			$time = ceil(count($words) / 324000);
		}
		else {
			return 'timing invalid';
		}
		return $time;
	}
	
	public function toList($content)
	{
		$content = strip_tags($content);
		
		return '<li>'.str_replace( "\n", "</li><li>", $text ).'</li>';
	}
}
