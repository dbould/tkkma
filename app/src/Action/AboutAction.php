<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Information;

final class AboutAction
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
        $this->logger->info("About page action dispatched");

        $this->view->render($response, 'about-us.twig');

        return $response;
    }

    public function getData(Request $request, Response $response)
    {
        $whatWeDo = Information::getInformation(2);
        $whyTrain = Information::getInformation(1);
        $instructor = Information::getInformation(3);

        $this->view->render(
            $response,
            'about-us.twig',
            [
                'whatWeDoTitle' => $whatWeDo['information_title'],
                'whatWeDoDesc' => $whatWeDo['information_desc'],
                'whyTitle' => $whyTrain['information_title'],
                'whyDesc' => $whyTrain['information_desc'],
                'instructorText' => $instructor['information_title'],
                'instructorDesc' => $instructor['information_desc'],
            ]
        );
    }
}
