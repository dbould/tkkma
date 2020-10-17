<?php
use Tests\SlimTestCase;

class PhotoActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/photos');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
