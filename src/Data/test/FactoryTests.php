<?php
/* Copyright (c) 2017 Stefan Hecken <stefan.hecken@concepts-and-training.de> Extended GPL, see docs/LICENSE */

use namespace ILIAS\Data;

/**
 * Testing the faytory of result objects
 *
 * @author Stefan Hecken <stefan.hecken@concepts-and-training.de>
 */
class FactoryTests extends PHPUnit_Framework_TestCase {
	protected function setUp() {
		$this->f = new Data\Factory();
	}

	protected function tearDown() {
		$this->f = null;
	}

	public function testOk() {
		$result = $this->f->ok(3.154);
		$this->assertInstanceOf(Data\ilResult::class, $result);
	}

	public function testError() {
		$result = $this->f->error("This is not a number");
		$this->assertInstanceOf(Data\ilResult::class, $result);
	}
}