<?php
use Tests\SlimTestCase;

class SiteMapActionTest extends SlimTestCase
{
    public function testItReturnsOk()
    {
        $response = $this->runApp('GET', '/sitemap');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
