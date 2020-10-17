<?php
use Tests\SlimTestCase;

class AboutActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/about-us');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testItReturnsPageSpecificText()
    {
        $response = $this->runApp('GET', '/about-us');

        $this->assertStringContainsString(
            'TKKMA can help you increase your functional and natural fitness',
            $response->getBody()
        );
    }

    public function testItReturnsAndy()
    {
        $response = $this->runApp('GET', '/about-us');

        $this->assertStringContainsString(
            'Mr Elsbury',
            $response->getBody()
        );
    }
}
