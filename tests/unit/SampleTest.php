<?php

use PHPUnit\Framework\TestCase;
use src;

class SampleTest extends TestCase {

    public function testKeysContainSKU(){

        $adapter = new src\csvAdapter();

        $this->assertContains("sku",array_keys($adapter->read('/Users/niklasfalge/www/myfirstproject/Hund_Pflege.csv')[0]));
    }

    public function testAssertsNoUndefinedKeys(){

        $adapter = new src\csvAdapter();

        $this->assertNotContains("",array_keys($adapter->read('/Users/niklasfalge/www/myfirstproject/Hund_Pflege.csv')[0]));
    }

    public function testAssertsSameArrays(){

        $adapter = new src\csvAdapter();
        $compare = new src\comparedArray();

        $this->assertSame($compare->comparedArray, $adapter->read('/Users/niklasfalge/www/myfirstproject/Hund_Pflege_gekuerzt.csv'));
    }
}