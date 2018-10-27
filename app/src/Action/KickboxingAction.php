<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Kickboxing;
use App\Models\Information;

final class KickboxingAction
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
        $this->logger->info("Kickboxing page action dispatched");

        $this->view->render($response, 'kickboxing.twig');

        return $response;
    }

    public function getData(Request $request, Response $response)
    {
        $getData = Kickboxing::getData();
        $information = Information::getAllInformation(4);

        $this->view->render(
            $response,
            'kickboxing.twig',
            [
                'kickboxingDetails' => $getData,
                'information' => $information
            ]
        );
    }
}
