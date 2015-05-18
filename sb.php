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
	$url = str_replace('_KEYWORD_', urlencode($kwd), $URL_GSADV_XML);
	$url = str_replace('_LANG_', 'zh', $url);
	$advstr = file_get_contents($url);
	$xml = new SimpleXMLIterator($advstr);
	// <toplevel>
	// <CompleteSuggestion>
	// <suggestion data="14th amendment"/>
	// </CompleteSuggestion>
	$xmi = $xml->xpath('/toplevel/CompleteSuggestion/suggestion');
	foreach ($xmi as $node) {
		$natts = $node->attributes();
		echo "{$natts['data']}\n";
	}
		

}
