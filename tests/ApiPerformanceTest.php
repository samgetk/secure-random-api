<?php

use PHPUnit\Framework\TestCase;

class ApiPerformanceTest extends TestCase
{
    public function testApiResponseTimeFor1000Requests()
    {
        $url = "http://localhost/api/random.php?min=1&max=100";
        $totalTime = 0;
        $numRequests = 1000;

        // Perform 1,000 requests
        for ($i = 0; $i < $numRequests; $i++) {
            $start = microtime(true);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
            $end = microtime(true);
            $totalTime += $end - $start;
        }

        // Calculate average response time
        $averageTime = $totalTime / $numRequests;

        // Assert that average response time is under 2 seconds
        $this->assertLessThan(2, $averageTime, "Average response time exceeded threshold: $averageTime seconds");

        echo "Average response time for 1,000 requests: $averageTime seconds\n";
    }
}
