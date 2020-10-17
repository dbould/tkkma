<?php
use Tests\SlimTestCase;

class PostActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/post1');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
