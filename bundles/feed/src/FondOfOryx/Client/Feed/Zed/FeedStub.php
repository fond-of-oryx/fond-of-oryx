<?php

namespace FondOfOryx\Client\Feed\Zed;

use Exception;
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
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityResponseTransfer
     */
    public function getAvailabilityFeedData(): FeedDataAvailabilityResponseTransfer
    {
        $response = $this->zedRequestClient->call('/feed/gateway/get-availability-feed-data', new FeedDataRequestTransfer());

        if ($response instanceof FeedDataAvailabilityResponseTransfer) {
            return $response;
        }

        throw new Exception(sprintf('Wrong instance of response!'));
    }

    /**
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\FeedDataAvailabilityAlertResponseTransfer
     */
    public function getAvailabilityAlertFeedData(): FeedDataAvailabilityAlertResponseTransfer
    {
        $response = $this->zedRequestClient->call('/feed/gateway/get-availability-alert-feed-data', new FeedDataRequestTransfer());

        if ($response instanceof FeedDataAvailabilityAlertResponseTransfer) {
            return $response;
        }

        throw new Exception(sprintf('Wrong instance of response!'));
    }
}
