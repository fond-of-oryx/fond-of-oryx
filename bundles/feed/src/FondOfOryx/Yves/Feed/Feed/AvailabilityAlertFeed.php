<?php

namespace FondOfOryx\Yves\Feed\Feed;

use FondOfOryx\Client\Feed\FeedClientInterface;
use FondOfOryx\Yves\Feed\CSV\CsvContent;
use FondOfOryx\Yves\Feed\CSV\CsvContentInterface;

class AvailabilityAlertFeed implements FeedInterface
{
    /**
     * @var \FondOfOryx\Client\Feed\FeedClientInterface
     */
    private $client;

    /**
     * @param \FondOfOryx\Client\Feed\FeedClientInterface $client
     */
    public function __construct(FeedClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @return \FondOfOryx\Yves\Feed\CSV\CsvContentInterface
     */
    public function create(): CsvContentInterface
    {
        $content = new CsvContent(['SKU', 'Subscriber']);
        foreach ($this->client->getAvailabilityAlertFeedData()->getFeedDataArray() as $feedData) {
            $sku = str_replace('Abstract-', '', $feedData->getSku());

            if ($sku !== '') {
                continue;
            }

            $content->addRow([$sku, (string)$feedData->getSubscriberCount()]);
        }

        return $content;
    }
}
