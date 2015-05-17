<?php
class AnsiColor {
	var $n;
	
	function __construct() {
		$this->n = $this->norm();
	}

	function c($ccode) {
		$fg = 0;
		$bg = 0;
		$mode = 0;
		if ($ccode >= 10000) {
			$mode = intval($ccode / 10000);
			$ccode %= 10000;
		}
		if ($ccode >= 100) {
			$fg = intval($ccode / 100);
			$bg = $ccode % 100;
		}
		else {
			$fg = $ccode;
		}
		return $this->raw($fg, $bg, $mode);
	}

	function norm() {
		return $this->raw(0);
	}

	function raw($fg, $bg = 0, $mode = 0) {
		$aar = [$mode];
		if ($fg > 0) $aar[] = $fg;
		if ($bg > 0) $aar[] = $bg;
		$astr = implode(';', $aar);
		return "\033[{$astr}m";
		// return "[{$astr}m";
		
	}
}
