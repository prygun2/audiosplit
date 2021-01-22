<?php


namespace Book\book;

/**
 * Class Part
 * @package Book\book
 * @property string $title
 * @property string $start
 */
class Part
{
	public $title;
	public $start;

	/**
	 * Part constructor.
	 * @param string $title
	 * @param string $start
	 */
	public function __construct($title, $start)
	{
		$this->title = $title;
		$this->start = $start;
	}
}
