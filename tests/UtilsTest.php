<?php

use General\Utils;
use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    // Test 1: Test Random Range Validity
    public function testRandomRangeValidity() {
        $min = 1;
        $max = 1000;
        for ($i = 0; $i < 100; $i++) {
            $randomNumber = Utils::getSecureRandom($min, $max);
            $this->assertGreaterThanOrEqual($min, $randomNumber);
            $this->assertLessThanOrEqual($max, $randomNumber);
        }
    }

    // Test 2: Test Randomness
    public function testRandomness() {
        $min = 1;
        $max = 1000;
        $randomNumbers = [];
        for ($i = 0; $i < 100; $i++) {
            $randomNumbers[] = Utils::getSecureRandom($min, $max);
        }
        $uniqueNumbers = array_unique($randomNumbers);
        $this->assertGreaterThan(50, count($uniqueNumbers)); // Assert more than 50 unique numbers
    }

    // Test 3: Test Performance
    public function testRandomPerformance() {
        $min = 1;
        $max = 1000000;
        $startTime = microtime(true);

        // Generate 100,000 random numbers
        for ($i = 0; $i < 100000; $i++) {
            Utils::getSecureRandom($min, $max);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        
        // Assert that it runs within 1 second
        $this->assertLessThan(1, $executionTime, "Performance test failed: Took too long.");
    }

    // Test 4: Test Min Equals Max
    public function testMinEqualsMax() {
        $min = 500;
        $max = 500;
        $randomNumber = Utils::getSecureRandom($min, $max);
        $this->assertEquals($min, $randomNumber);
    }

    // Test 5: Test Negative Range
    public function testNegativeRange() {
        $min = -1000;
        $max = -1;
        for ($i = 0; $i < 100; $i++) {
            $randomNumber = Utils::getSecureRandom($min, $max);
            $this->assertGreaterThanOrEqual($min, $randomNumber);
            $this->assertLessThanOrEqual($max, $randomNumber);
        }
    }

    // Test 6: Test Large Range
    public function testLargeRange() {
        $min = 1;
        $max = 10000000; // 10 million
        $randomNumber = Utils::getSecureRandom($min, $max);
        $this->assertGreaterThanOrEqual($min, $randomNumber);
        $this->assertLessThanOrEqual($max, $randomNumber);
    }

    // Test 7: Test Small Range (Boundary)
    public function testSmallRange() {
        $min = 1;
        $max = 2;
        $randomNumber = Utils::getSecureRandom($min, $max);
        $this->assertTrue(in_array($randomNumber, [1, 2]));
    }

    // Test 8: Test Zero Range
    public function testZeroRange() {
        $min = 100;
        $max = 100;
        $randomNumber = Utils::getSecureRandom($min, $max);
        $this->assertEquals(100, $randomNumber);
    }

    // Test 9: Test Randomness Consistency
    public function testRandomnessConsistency() {
        $min = 1;
        $max = 1000;
        $randomNumbersFirstRun = [];
        $randomNumbersSecondRun = [];

        // First run
        for ($i = 0; $i < 100; $i++) {
            $randomNumbersFirstRun[] = Utils::getSecureRandom($min, $max);
        }

        // Second run
        for ($i = 0; $i < 100; $i++) {
            $randomNumbersSecondRun[] = Utils::getSecureRandom($min, $max);
        }

        // Check that numbers from both runs are not the same
        $this->assertNotEquals($randomNumbersFirstRun, $randomNumbersSecondRun);
    }

    // Test 10: Test Large Input Validation
    public function testLargeInputValidation() {
        $min = PHP_INT_MAX - 1;
        $max = PHP_INT_MAX;
        $randomNumber = Utils::getSecureRandom($min, $max);
        $this->assertTrue(in_array($randomNumber, [$min, $max]));
    }
}

?>
