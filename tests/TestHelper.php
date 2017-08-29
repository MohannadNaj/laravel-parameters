<?php

namespace Parameter\Tests;

trait TestHelper
{
	public function assertArrayContains($needles, $haystack) {
		$intersect = array_intersect($haystack, $needles);
		$needles = (array) $needles;

		asort($intersect);
		asort($needles);

		$this->assertEquals(array_values($intersect), array_values($needles));
	}
}
