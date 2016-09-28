<?php
class PHPLevenshtein {

	public function compute($fstStr, $secStr) {

		// 计算字符串长度
		$fstStrLen = mb_strlen($fstStr);
		$secStrLen = mb_strlen($secStr);

		// 初始化二维表
		$similaritys[0][0] = 0;

		// X方向
		for ($i = 0; $i <= $fstStrLen; $i++) {
			$similaritys[$i][0] = $i;
		}

		// Y方向
		for ($i = 0; $i <= $secStrLen; $i++) {
			$similaritys[0][$i] = $i;
		}

		for ($i = 1; $i <= $fstStrLen; $i++) {
			$x = $i - 1;
			$fstChar = mb_substr($fstStr, $x, 1);
			for ($j = 1; $j <= $secStrLen; $j++) {
				$y = $j - 1;
				$secChar = mb_substr($secStr, $y, 1);
				$left = $similaritys[$x][$j] + 1;
				$top = $similaritys[$i][$y] + 1;
				$leftTop = $fstChar == $secChar ? $similaritys[$x][$y] : $similaritys[$x][$y] + 1;

				$similaritys[$i][$j] = $left < $top ? ($left < $leftTop ? $left : $leftTop) : ($top < $leftTop ? $top : $leftTop);
			}
		}

		$maxLen = $fstStrLen > $secStrLen ? $fstStrLen : $secStrLen;
		$similarity = ceil((1 - ($similaritys[$fstStrLen][$secStrLen] / $maxLen)) * 100);

		return $similarity;
	}
}