<?php

namespace FondOfOryx\Client\Feed;

use FondOfOryx\Client\Feed\Zed\FeedStub;
use FondOfOryx\Client\Feed\Zed\FeedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClient;

class FeedFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Client\Feed\Zed\FeedStubInterface
     */
    public function createFeedStub(): FeedStubInterface
    {
        return new FeedStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected function getZedRequestClient(): ZedRequestClient
    {
        return $this->getProvidedDependency(FeedDependencyProvider::ZED_CLIENT);
    }
}
