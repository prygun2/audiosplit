<?php

use Book\book\Book;
use Book\book\Options;

require_once __DIR__ . '/vendor/autoload.php';

function main() {

	$args = getopt('', ['xml:', 'chapter:', 'long:', 'part:']);

	try {
		$options = new Options($args);
		$file = new Book($options);
		echo $file->getJsonSegments();
	} catch (Exception $e) {
		exit($e->getMessage() . "\n");
	}
}

main();
