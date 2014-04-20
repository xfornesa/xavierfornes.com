<?php

namespace Prunatic\Controller;

use Silex\Application;
use Silex\ControllerCollection;

class MainController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function buildRouteDefinitions(ControllerCollection $collection)
    {
        $collection->get('/', MainController::class.':'.'indexAction')->bind('homepage');
        $collection->get('/the-bakery.html', MainController::class.':'.'portfolioAction')->bind('bakery');

        return $collection;
    }

    public function indexAction()
    {
        return $this->render('Default/index.html.twig');
    }

    public function portfolioAction()
    {
        return $this->render('Default/portfolio.html.twig');
    }
}
 