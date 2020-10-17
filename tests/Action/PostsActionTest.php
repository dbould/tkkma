<?php
use Tests\SlimTestCase;

class PostsActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/blog');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
