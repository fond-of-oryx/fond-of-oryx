<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class AvailabilityAlertControllerProviderPlugin extends AbstractRouteProviderPlugin
{
    public const ROUTE_AVAILABILITY_ALERT_SUBMIT = 'availability-alert/submit';
    public const ROUTE_AVAILABILITY_ALERT_WIDGET_SUBMIT = 'availability-alert/widget/submit';
    public const ID_ABSTRACT_PRODUCT_REGEX = '[1-9][0-9]*';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addSubmitRoute($routeCollection);
        $routeCollection = $this->addWidgetSubmitRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addSubmitRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('availability-alert/submit/{idProductAbstract}', 'AvailabilityAlert', 'Submit', 'index');
        $route->setRequirement('idProductAbstract', static::ID_ABSTRACT_PRODUCT_REGEX);
        $routeCollection->add(static::ROUTE_AVAILABILITY_ALERT_SUBMIT, $route);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addWidgetSubmitRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('availability-alert/widget/submit', 'AvailabilityAlert', 'Submit', 'submitWidget');
        $routeCollection->add(static::ROUTE_AVAILABILITY_ALERT_WIDGET_SUBMIT, $route);

        return $routeCollection;
    }
}
