<?php


namespace Book\book;

use Book\helpers\HelperPT;
use Exception;

/**
 * Class Book
 * @property Chapter[] $chapters
 * @property Options $options
 * @property array[] $silences
 * @property int $currentChapter
 */
class Book
{
	private $options;
	private $silences;
	private $currentChapter = 0;

	public $chapters = [];

	/**
	 * Book constructor.
	 * @param Options $options
	 * @throws Exception
	 */
	public function __construct(Options $options)
	{
		$this->options = $options;
		$this->loadFile();
	}

	/**
	 * Load file XML
	 * @throws Exception
	 */
	private function loadFile()
	{
		$get = file_get_contents($this->options->xml);

		if ($get === false) {
			throw new Exception('File read error.');
		}

		$arr = simplexml_load_string($get);
		if ($arr === false) {
			throw new Exception('SimpleXML error.');
		}

		$json = json_encode($arr);
		if ($json === false) {
			throw new Exception('Get JSON error.');
		}

		$array = json_decode($json, TRUE);
		if ($array === false) {
			throw new Exception('Get JSON error.');
		}

		if (empty($array['silence'])) {
			throw new Exception('Silences not found.');
		}

		$this->silences = $array['silence'];
	}

	/**
	 * Get segments
	 * @return Segment[]
	 */
	public function getSegments()
	{
		$this->add('PT0S', 'PT0S');
		foreach ($this->silences as $silence) {
			$from = $silence['@attributes']['from'];
			$until = $silence['@attributes']['until'];
			$this->add($from, $until);
		}

		$result = [];
		foreach ($this->chapters as $chapter) {
			if (!empty($chapter->parts)) {
				foreach ($chapter->parts as $part) {
					$result[] = new Segment($part->title, $part->start);
				}
			} else {
				$result[] = new Segment($chapter->title, $chapter->start);
			}
		}

		return $result;
	}

	/**
	 * Add segment
	 * @param string $from
	 * @param string $until
	 */
	private function add($from, $until)
	{
		$duration = HelperPT::parse($until) - HelperPT::parse($from);

		if ($duration > $this->options->chapter || $this->currentChapter === 0) {
			$this->addChapter($from, $until);
		} elseif ($duration > $this->options->part) {
			$this->chapters[$this->currentChapter]->addPart($from, $until);
		} else {
			$this->chapters[$this->currentChapter]->setEnd($from);
		}
	}

	/**
	 * Add chapter
	 * @param string $from
	 * @param string $until
	 */
	private function addChapter($from, $until)
	{
		$this->currentChapter++;
		$title = "Chapter {$this->currentChapter}";
		$chapter = new Chapter($title, $until);
		$chapter->addPart($from, $until);
		$this->chapters[$this->currentChapter] = $chapter;
		if ($this->currentChapter > 1) {
			$this->chapters[$this->currentChapter - 1]->setEnd($from);
			$this->chapters[$this->currentChapter - 1]->clearParts($this->options->long);
		}
	}

	/**
	 * Get segments to JSON
	 * @return false|string
	 */
	public function getJsonSegments()
	{
		return json_encode($this->getSegments());
	}
}
