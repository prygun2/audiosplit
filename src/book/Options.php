<?php


namespace Book\book;


use Exception;

/**
 * Class Options
 * @property string[] $args
 * @property string $xml
 * @property int $chapter
 * @property int $long
 * @property int $part
 */
class Options
{
	private $args;

	public $xml;
	public $chapter;
	public $long;
	public $part;

	const DEFAULT_CHAPTER = 3000;
	const DEFAULT_LONG = 300000;
	const DEFAULT_PART = 1000;

	/**
	 * Options constructor.
	 * @param string[] $args
	 * @throws Exception
	 */
	public function __construct($args)
	{
		$this->args = $args;
		$this->validate();
	}

	/**
	 * Validation
	 * @throws Exception
	 */
	private function validate()
	{
		if (empty($this->args['xml'])) {
			throw new Exception('Path is required.');
		}

		$this->xml = $this->args['xml'];
		$this->chapter = $this->format('chapter', static::DEFAULT_CHAPTER);
		$this->long = $this->format('long', static::DEFAULT_LONG);
		$this->part = $this->format('part', static::DEFAULT_PART);
	}


	/**
	 * Format value
	 * @param string $name
	 * @param string $default
	 * @return int
	 * @throws Exception
	 */
	private function format($name, $default) {
		$result = $default;
		if (!empty($this->args[$name])) {
			$result = (int)$this->args[$name];
		}

		if ($result === 0) {
			throw new Exception($name . ' must be more than 0');
		}

		return $result;
	}
}
