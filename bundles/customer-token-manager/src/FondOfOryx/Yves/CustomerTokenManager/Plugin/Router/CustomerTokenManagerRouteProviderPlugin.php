<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class CustomerTokenManagerRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @var string
     */
    public const ROUTE_TOKEN_MANAGER = 'token-manager';

    /**
     * @var string
     */
    protected const TOKEN_PATTERN = '[a-zA-Z0-9-_\.]+';

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addTokenManagerRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addTokenManagerRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/token-manager/{token}', 'CustomerTokenManager', 'AccessToken', 'tokenManagerAction');
        $route = $route->setRequirement('token', static::TOKEN_PATTERN);
        $routeCollection->add(static::ROUTE_TOKEN_MANAGER, $route);

        return $routeCollection;
    }
}
