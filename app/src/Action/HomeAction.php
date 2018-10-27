<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Information;

final class HomeAction
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
        $this->logger->info("Home page action dispatched");

        $this->view->render($response, 'home.twig');

        return $response;
    }

    public function getData(Request $request, Response $response)
    {
        $whatWeDo = Information::getInformation(2);
        $whyTrain = Information::getInformation(1);
        $aboutUs = Information::getInformation(6);

        $pos = strpos($whatWeDo['information_desc'], ' ', 325);
        $pos2 = strpos($whyTrain['information_desc'], ' ', 325);

        $this->view->render(
            $response,
            'home.twig',
            [
                'whatWeDoTitle' => $whatWeDo['information_title'],
                'whatWeDoDesc' => substr($whatWeDo['information_desc'], 0, $pos ) . '...',
                'whyTitle' => $whyTrain['information_title'],
                'whyDesc' => substr($whyTrain['information_desc'], 0, $pos ) . '...',
                'mainText' => $aboutUs['information_title'],
                'mainDesc' => $aboutUs['information_desc'],
            ]
        );
    }
}
