<?php

namespace FondOfOryx\Yves\Feed\Feed;

use FondOfOryx\Client\Feed\FeedClientInterface;
use FondOfOryx\Yves\Feed\CSV\CsvContent;
use FondOfOryx\Yves\Feed\CSV\CsvContentInterface;

class AvailabilityFeed implements FeedInterface
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
        $content = new CsvContent(['SKU', 'Quantity']);
        foreach ($this->client->getAvailabilityFeedData()->getFeedDataArray() as $feedData) {
            $content->addRow([$feedData->getSku(), (string)$feedData->getQuantity()]);
        }

        return $content;
    }
}
