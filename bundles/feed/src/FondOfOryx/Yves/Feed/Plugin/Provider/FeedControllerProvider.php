<?php

namespace FondOfOryx\Yves\Feed\Plugin\Provider;

use Silex\Application;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

/**
 * Class FeedControllerProvider
 *
 * @package FondOfOryx\Yves\Feed\Plugin\Provider
 * @deprecated use FondOfOryx\Yves\Feed\Plugin\Router\FeedRouteProviderPlugin instead
 */
class FeedControllerProvider extends AbstractYvesControllerProvider
{
    public const ROUTE_AVAILABILITY = 'feed-availability';
    public const ROUTE_AVAILABILITY_ALERT = 'feed-availability-alert';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app): void
    {
        $this->addAvailabilityFeedRoute()
            ->addAvailabilityAlertRoute();
    }

    /**
     * @return $this
     */
    protected function addAvailabilityFeedRoute()
    {
        $this->createController('/{feed}/availability', static::ROUTE_AVAILABILITY, 'Feed', 'Feed', 'availabilityFeed')
            ->assert('feed', $this->getAllowedLocalesPattern() . 'feed|feed')
            ->value('feed', 'feed')
            ->method('GET');

        return $this;
    }

    /**
     * @return $this
     */
    protected function addAvailabilityAlertRoute()
    {
        $this->createController('/{feed}/availability-alert', static::ROUTE_AVAILABILITY_ALERT, 'Feed', 'Feed', 'availabilityAlertFeed')
            ->assert('feed', $this->getAllowedLocalesPattern() . 'feed|feed')
            ->value('feed', 'feed')
            ->method('GET');

        return $this;
    }
}
