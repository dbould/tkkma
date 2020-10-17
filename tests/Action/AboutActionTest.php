<?php
use Tests\SlimTestCase;

class AboutActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/about-us');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
