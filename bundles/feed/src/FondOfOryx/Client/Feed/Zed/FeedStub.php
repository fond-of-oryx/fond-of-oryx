<?php

namespace FondOfOryx\Client\Feed\Zed;

use Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer;
use Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer;
use Generated\Shared\Transfer\FeedDataRequestTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class FeedStub implements FeedStubInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClient
     */
    private $zedRequestClient;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedRequestClient
     */
    public function __construct(ZedRequestClient $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(): FeedDataAvailabilityResponseTransfer
    {
        return $this->zedRequestClient->call('/feed/gateway/get-availability-feed-data', new FeedDataRequestTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer
     */
    public function getAvailabilityAlertFeedData(): FeedDataAvailabilityAlertResponseTransfer
    {
        return $this->zedRequestClient->call('/feed/gateway/get-availability-alert-feed-data', new FeedDataRequestTransfer());
    }
}
