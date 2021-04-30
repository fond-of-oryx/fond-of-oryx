<?php

namespace FondOfOryx\Yves\Feed\Plugin\Router;

use FondOfOryx\Shared\Feed\FeedConstants;
use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class FeedRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addAvailabilityFeedRoute($routeCollection);
        $routeCollection = $this->addAvailabilityAlertRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addAvailabilityFeedRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/feed/availability', 'Feed', 'Feed', 'availabilityFeed');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(FeedConstants::ROUTE_AVAILABILITY, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addAvailabilityAlertRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/feed/availability-alert', 'Feed', 'Feed', 'availabilityAlertFeed');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(FeedConstants::ROUTE_AVAILABILITY_ALERT, $route);

        return $routeCollection;
    }
}
