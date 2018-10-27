<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class SiteMapAction
{
    private $view;
    private $logger;
    private $routes;

    /**
     * @param Twig $view
     * @param LoggerInterface $logger
     */
    public function __construct(Twig $view, LoggerInterface $logger, $routes)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->routes = $routes;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        $this->logger->info("SiteMap page action dispatched");

        $this->view->render($response, 'sitemap.twig');

        return $response;
    }

    public function get(Request $request, Response $response)
    {
        $baseUrl = 'http://www.tkkma.co.uk/';

        $headers = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $headers .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

        $html = '';
        
        foreach ($this->routes as $route) {
            $html .= '<url>' . PHP_EOL;
            $html .= '<loc>' . $baseUrl . $route->getPattern() . '/</loc>' . PHP_EOL;
            $html .= '<changefreq>daily</changefreq>' . PHP_EOL;
            $html .= '</url>' . PHP_EOL;
        }
        
        $response = $response->withHeader('Content-Type', 'application/xml; charset=utf-8');

        $this->view->render(
            $response,
            'sitemap.twig',
            [
                'header' => $headers,
                'routes' => $html,           
            ]
        );
    }
}
