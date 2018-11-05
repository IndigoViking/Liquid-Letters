<?php
/**
 * Liquid Letters plugin for Craft CMS 3.x
 *
 * Liquid Letters counts words and gives reading times.
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
        ];
    }
    /**
     * php pathinfo() wrapper -- http://php.net/manual/en/function.pathinfo.php
     *
     * @param $path
     * @param bool $options
     * @return mixed
     */
	public function wordCount($content)
	{
		$content = strip_tags($content);
		$content = str_replace("\n", ' ', $content);
		$content = preg_replace("/\s+/", ' ', $content);
		$content = trim($content);
		$words = explode(' ', $content);
		return count($words);
	}
	
	public function readTime($content, $timing)
	{
		$content = strip_tags($content);
		$content = str_replace("\n", ' ', $content);
		$content = preg_replace("/\s+/", ' ', $content);
		$content = trim($content);
		$words = explode(' ', $content);
		
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
}
