<?php
function pageBrowser($totalrows,$numLimit,$amm,$queryStr,$numBegin,$begin,$num) {

	$larrow = "&nbsp;<< Prev ".$numLimit."&nbsp;";
	$rarrow = "&nbsp;Next ".$numLimit." >>&nbsp;";
	$wholePiece = "<B>Page:</B> ";

		if ($totalrows > 0) {

			$numSoFar = 1;
			$cycle = ceil($totalrows/$amm);

			if (!isset($numBegin) || $numBegin < 1) {
				$numBegin = 1;
				$num = 1;
			}

			$minus = $numBegin-1;
			$start = $minus*$amm;

			if (!isset($begin)) {
				$begin = $start;
			}

			$preBegin = $numBegin-$numLimit;
			$preStart = $amm*$numLimit;
			$preStart = $start-$preStart;
			$preVBegin = $start-$amm;
			$preRedBegin = $numBegin-1;

			if ($start > 0 || $numBegin > 1) {

				$wholePiece .= "<a href='?num=".$preRedBegin
				."&numBegin=".$preBegin
				."&begin=".$preVBegin
				.$queryStr."'>"
				.$larrow."</a>\n";
			}

			for ($i=$numBegin;$i<=$cycle;$i++) {

				if ($numSoFar == $numLimit+1) {

					$piece = "<a href='?numBegin=".$i
					."&num=".$i
					."&begin=".$start
					.$queryStr."'>"
					.$rarrow."</a>\n";
					$wholePiece .= $piece;
					break;
				}

				$piece = "<a href='?begin=".$start
					."&num=".$i
					."&numBegin=".$numBegin
					.$queryStr
					."'>";

				if ($num == $i) {
					$piece .= "</a><b>$i</b><a>";
				} else {
					$piece .= "$i";
				}

				$piece .= "</a>\n";
				$start = $start+$amm;
				$numSoFar++;
				$wholePiece .= $piece;
			}

			$wholePiece .= "\n";
			$wheBeg = $begin+1;
			$wheEnd = $begin+$amm;
			$wheToWhe = "<b>".$wheBeg."</b> - <b>";
			if ($totalrows <= $wheEnd) {
				$wheToWhe .= $totalrows."</b>";
			} else {
				$wheToWhe .= $wheEnd."</b>";
			}

			$sqlprod = " LIMIT ".$begin.", ".$amm;
		} else {
			$wholePiece = "Sorry, no records to display.";
			$wheToWhe = "<b>0</b> - <b>0</b>";
		}

		return array($sqlprod,$wheToWhe,$wholePiece);

}
?>