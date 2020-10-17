<?php
use Tests\SlimTestCase;

class KickboxingActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/kickboxing');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
