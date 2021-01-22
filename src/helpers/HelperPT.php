<?php


namespace Book\helpers;

/**
 * Class HelperPT
 * @package Book\helpers
 */
class HelperPT
{
	/**
	 * Parse time from ISO 8601 to seconds
	 * @param $pt_time
	 * @return false|int
	 */
	public static function parse($pt_time)
	{
		$hours = static::parseHours($pt_time);
		$minutes = static::parseMinutes($pt_time);
		$seconds = static::parseSeconds($pt_time);

		return (int)(($hours * 60 * 60 + $minutes * 60 + $seconds) * 1000);
	}

	/**
	 * Get hours from ISO 8601
	 * @param $string
	 * @return int|mixed
	 */
	public static function parseHours($string) {
		preg_match('#([\d]+)H#m', $string, $matches);
		return isset ($matches[1]) ? $matches[1] : 0;
	}

	/**
	 * Get minutes from ISO 8601
	 * @param $string
	 * @return int|mixed
	 */
	public static function parseMinutes($string) {
		preg_match('#([\d]+)M#m', $string, $matches);
		return isset ($matches[1]) ? $matches[1] : 0;
	}

	/**
	 * Get seconds from ISO 8601
	 * @param $string
	 * @return int|mixed
	 */
	public static function parseSeconds($string) {
		preg_match('#([\d\.]+)S#m', $string, $matches);
		return isset ($matches[1]) ? $matches[1] : 0;
	}
}

