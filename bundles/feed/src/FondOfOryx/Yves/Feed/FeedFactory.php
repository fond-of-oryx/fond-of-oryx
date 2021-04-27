<?php

namespace FondOfOryx\Yves\Feed;

use FondOfOryx\Yves\Feed\Feed\AvailabilityAlertFeed;
use FondOfOryx\Yves\Feed\Feed\AvailabilityFeed;
use FondOfOryx\Yves\Feed\Feed\FeedInterface;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\Feed\FeedClientInterface getClient()
 */
class FeedFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Yves\Feed\Feed\FeedInterface
     */
    public function createAvailabilityAlertFeed(): FeedInterface
    {
        return new AvailabilityAlertFeed($this->getClient());
    }

    /**
     * @return \FondOfOryx\Yves\Feed\Feed\FeedInterface
     */
    public function createAvailabilityFeed(): FeedInterface
    {
        return new AvailabilityFeed($this->getClient());
    }
}
