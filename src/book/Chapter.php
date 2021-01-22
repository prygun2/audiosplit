<?php


namespace Book\book;


use Book\helpers\HelperPT;

/**
 * Class Chapter
 * @property Part[] $parts
 * @property string $title
 * @property string $start
 * @property string $end
 * @property int $currentPart
 */
class Chapter
{
	private $currentPart = 0;

	public $title;
	public $start;
	public $end;
	public $parts = [];

	/**
	 * Chapter constructor.
	 * @param string $title
	 * @param string $start
	 */
	public function __construct($title, $start)
	{
		$this->title = $title;
		$this->start = $start;
		$this->end = $start;
	}

	/**
	 * Set end
	 * @param string $end
	 */
	public function setEnd($end)
	{
		$this->end = $end;
	}

	/**
	 * Add part
	 * @param string $from
	 * @param string $until
	 */
	public function addPart($from, $until)
	{
		$this->currentPart++;
		$title = $this->title . ', Part ' . $this->currentPart;
		$this->parts[$this->currentPart] = new Part($title, $until);
		$this->setEnd($from);
	}

	/**
	 * Clear parts
	 * @param int $minDuration
	 */
	public function clearParts($minDuration)
	{
		$duration = HelperPT::parse($this->end) - HelperPT::parse($this->start);

		if ($duration < $minDuration) {
			$this->parts = [];
		}
	}
}
