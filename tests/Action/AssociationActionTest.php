<?php
use Tests\SlimTestCase;

class AssociationActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/associations');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
