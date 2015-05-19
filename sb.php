#!/usr/bin/php
<?php
require_once('include/AnsiColor.php');
require_once('include/globals.php');


$kwds = [];
if ($argc < 2) {
	die ($usage);
}
else {
	for ($i = 1; $i < $argc; ++$i) {
		$kwds[] = $argv[$i];
	}
}

foreach ($kwds as $kwd) {
	scexplore($kwd);
}

function scexplore($kwd) {
	global $URL_GSADV_XML;
	$an = new AnsiColor();
	foreach ($URL_GSADV_XML as $gaurl) {
		$url = str_replace('_KEYWORD_', urlencode($kwd), $gaurl);
		$url = str_replace('_LANG_', 'en', $url);
		$advstr = file_get_contents($url);
		$xml = new SimpleXMLIterator($advstr);
		// <toplevel>
		// <CompleteSuggestion>
		// <suggestion data="14th amendment"/>
		// </CompleteSuggestion>

		$xmi = $xml->xpath('/toplevel/CompleteSuggestion/suggestion');
		echo "{$an->c(13240)}$url{$an->n}\n";
		foreach ($xmi as $node) {
			$natts = $node->attributes();
			echo "{$natts['data']}\n";
		}
	}
}
