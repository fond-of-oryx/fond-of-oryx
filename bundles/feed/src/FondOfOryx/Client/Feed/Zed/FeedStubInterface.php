<?php

namespace FondOfOryx\Client\Feed\Zed;

use Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;

interface FeedStubInterface
{
    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(): FeedDataAvailabilityResponseTransfer;

    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer
     */
    public function getAvailabilityAlertFeedData(): FeedDataAvailabilityAlertResponseTransfer;
}
