<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Association;
use App\Models\AssociationLogo;

final class AssociationAction
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
        $this->logger->info("Association page action dispatched");

        $this->view->render($response, 'associations.twig');

        return $response;
    }

    public function getData(Request $request, Response $response)
    {
        $associations = Association::getAssociations();
        $associationLogos = AssociationLogo::getAssociations();

        $this->view->render(
            $response,
            'associations.twig',
            [
                'associations' => $associations,
                'associationlogos' => $associationLogos,
            ]
        );
    }
}
