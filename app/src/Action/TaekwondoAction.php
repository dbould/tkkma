<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Taekwondo;
use App\Models\Information;

final class TaekwondoAction
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
        $this->logger->info("Taekwondo page action dispatched");

        $this->view->render($response, 'taekwondo.twig');

        return $response;
    }

    public function getData(Request $request, Response $response)
    {
        $getData = Taekwondo::getData();
        $information = Information::getAllInformation(5);

        $this->view->render(
            $response,
            'taekwondo.twig',
            [
                'taekwondoDetails' => $getData,
                'information' => $information
            ]
        );
    }
}
