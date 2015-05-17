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
	echo "$advstr\n";
	//$advxm = new SimpleXMLElement($advstr);
	//print_r($advxm);
	$xmi = new SimpleXMLIterator($advstr);
	for ($xmi->rewind(); $xmi->valid(); $xmi->next()) {
		foreach ($xmi->getChildren() as $key=>$val) {
			echo "$key: $val\n";
			echo "{$val->attributes('data')}\n";
		}
	}

}
