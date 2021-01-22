<?php


namespace Book\book;

/**
 * Class Segment
 * @package Book\book
 * @property string $title
 * @property int $offset
 */
class Segment
{
	public $title;
	public $offset;

	/**
	 * Segment constructor.
	 * @param string $title
	 * @param int $offset
	 */
	public function __construct($title, $offset)
	{
		$this->title = $title;
		$this->offset = $offset;
	}
}
