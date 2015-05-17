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
	$url = str_replace('_KEYWORD_', urlencode($kwd), $URL_GSADV);
	$advstr = file_get_contents($url);
	// echo "$advstr\n";
	//$advxm = new SimpleXMLElement($advstr);
	//print_r($advxm);
	$xml = new SimpleXMLIterator($advstr);
	// <toplevel>
	// <CompleteSuggestion>
	// <suggestion data="14th amendment"/>
	// </CompleteSuggestion>
	$xmi = $xml->xpath('/toplevel/CompleteSuggestion/suggestion');
	// print_r($xmi);
	// echo "###\n";
	foreach ($xmi as $node) {
		// print_r($node);
		// echo "---\n";
		$natts = $node->attributes();
		echo "{$natts['data']}\n";
		/*
		foreach ($xmn->attributes() as $key=>$val) {
			echo "$key: $val\n";
		}
		*/
	}
		

}
