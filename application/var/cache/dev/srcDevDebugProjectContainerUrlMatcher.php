<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request;
        $requestMethod = $canonicalMethod = $context->getMethod();
        $scheme = $context->getScheme();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }


        // swagger
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'App\\Controller\\DefaultController::index',  '_route' => 'swagger',);
            if (substr($pathinfo, -1) !== '/') {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'swagger'));
            }

            return $ret;
        }

        if (0 === strpos($pathinfo, '/api/rqms/statistics')) {
            // italy_outlet_statistics
            if (0 === strpos($pathinfo, '/api/rqms/statistics/italy-outlets/v1') && preg_match('#^/api/rqms/statistics/italy\\-outlets/v1/(?P<outletId>[^/]++)/period/(?P<minutes>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'italy_outlet_statistics')), array (  '_controller' => 'App\\Controller\\Rqms\\Statistics\\ItalyOutlets\\IndexController::index',));
            }

            // outlet_statistics
            if (0 === strpos($pathinfo, '/api/rqms/statistics/outlets/v1') && preg_match('#^/api/rqms/statistics/outlets/v1/(?P<outletId>[^/]++)/period/(?P<minutes>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'outlet_statistics')), array (  '_controller' => 'App\\Controller\\Rqms\\Statistics\\Outlets\\IndexController::index',));
            }

            // search_filter
            if ('/api/rqms/statistics/search/v1/query' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'App\\Controller\\Rqms\\Statistics\\Search\\IndexController::index',  '_route' => 'search_filter',);
                if (substr($pathinfo, -1) !== '/') {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'search_filter'));
                }

                return $ret;
            }

            // search_subset
            if ('/api/rqms/statistics/search/v1/subset' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'App\\Controller\\Rqms\\Statistics\\Search\\IndexController::subset',  '_route' => 'search_subset',);
                if (substr($pathinfo, -1) !== '/') {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'search_subset'));
                }

                return $ret;
            }

            // tp_online_statistics
            if (0 === strpos($pathinfo, '/api/rqms/statistics/tp-online/customers/v1') && preg_match('#^/api/rqms/statistics/tp\\-online/customers/v1/(?P<email>[^/]++)/period/(?P<minutes>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'tp_online_statistics')), array (  '_controller' => 'App\\Controller\\Rqms\\Statistics\\TPOnline\\IndexController::index',));
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
