<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;

    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        'swagger' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'App\\Controller\\DefaultController::index',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'italy_outlet_statistics' => array (  0 =>   array (    0 => 'outletId',    1 => 'minutes',  ),  1 =>   array (    '_controller' => 'App\\Controller\\Rqms\\Statistics\\ItalyOutlets\\IndexController::index',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'minutes',    ),    1 =>     array (      0 => 'text',      1 => '/period',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'outletId',    ),    3 =>     array (      0 => 'text',      1 => '/api/rqms/statistics/italy-outlets/v1',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'outlet_statistics' => array (  0 =>   array (    0 => 'outletId',    1 => 'minutes',  ),  1 =>   array (    '_controller' => 'App\\Controller\\Rqms\\Statistics\\Outlets\\IndexController::index',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'minutes',    ),    1 =>     array (      0 => 'text',      1 => '/period',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'outletId',    ),    3 =>     array (      0 => 'text',      1 => '/api/rqms/statistics/outlets/v1',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
        'tp_online_statistics' => array (  0 =>   array (    0 => 'email',    1 => 'minutes',  ),  1 =>   array (    '_controller' => 'App\\Controller\\Rqms\\Statistics\\TPOnline\\IndexController::index',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'minutes',    ),    1 =>     array (      0 => 'text',      1 => '/period',    ),    2 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'email',    ),    3 =>     array (      0 => 'text',      1 => '/api/rqms/statistics/tp-online/customers/v1',    ),  ),  4 =>   array (  ),  5 =>   array (  ),),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
