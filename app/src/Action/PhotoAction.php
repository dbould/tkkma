<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class PhotoAction
{
    private $view;
    private $logger;

    /**
     * @param Twig $view
     * @param LoggerInterface $logger
     */
    public function __construct(Twig $view, LoggerInterface $logger)
    {
        $this->view = $view;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        $this->logger->info("Photo page action dispatched");

        $this->view->render($response, 'photos.twig');

        return $response;
    }

    public function getData(Request $request, Response $response)
    {
        $this->view->render(
            $response,
            'photos.twig',
            [
                'photos' => glob(
                    'uploads/*.*'
                )
            ]
        );
    }
}
