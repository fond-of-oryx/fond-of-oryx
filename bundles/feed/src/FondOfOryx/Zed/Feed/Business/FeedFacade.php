<?php

namespace FondOfOryx\Zed\Feed\Business;

use Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Generated\Shared\Transfer\FeedDataRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\Feed\Business\FeedBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\Feed\Persistence\FeedRepositoryInterface getRepository()
 */
class FeedFacade extends AbstractFacade implements FeedFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\FeedDataRequestTransfer $feedDataRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(FeedDataRequestTransfer $feedDataRequestTransfer): FeedDataAvailabilityResponseTransfer
    {
        return $this->getFactory()->createAvailabilityFeed()->getAvailabilityFeedData($feedDataRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FeedDataRequestTransfer $feedDataRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer
     */
    public function getAvailabilityAlertFeedData(FeedDataRequestTransfer $feedDataRequestTransfer): FeedDataAvailabilityAlertResponseTransfer
    {
        return $this->getFactory()->createAvailabilityAlertFeed()->getAvailabilityAlertFeedData($feedDataRequestTransfer);
    }
}
