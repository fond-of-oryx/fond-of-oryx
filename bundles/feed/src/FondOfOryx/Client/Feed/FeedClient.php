<?php

namespace FondOfOryx\Client\Feed;

use Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\Feed\FeedFactory getFactory()
 */
class FeedClient extends AbstractClient implements FeedClientInterface
{
    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(): FeedDataAvailabilityResponseTransfer
    {
        return $this->getFactory()->createFeedStub()->getAvailabilityFeedData();
    }

    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer
     */
    public function getAvailabilityAlertFeedData(): FeedDataAvailabilityAlertResponseTransfer
    {
        return $this->getFactory()->createFeedStub()->getAvailabilityAlertFeedData();
    }
}
