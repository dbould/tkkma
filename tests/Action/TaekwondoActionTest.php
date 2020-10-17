<?php
use Tests\SlimTestCase;

class TaekwondoActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/taekwondo');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
