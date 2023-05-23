<?php

namespace FondOfOryx\Glue\NotionProxyRestApi;

use FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilder;
use FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator\NotionProxyRequestCreator;
use FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator\NotionProxyRequestCreatorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClientInterface getClient()
 */
class NotionProxyRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator\NotionProxyRequestCreatorInterface
     */
    public function createNotionProxyRequestCreator(): NotionProxyRequestCreatorInterface
    {
        return new NotionProxyRequestCreator(
            $this->createRestResponseBuilder(),
            $this->getClient(),
        );
    }

    /**
     * @return \FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected function createRestResponseBuilder(): RestResponseBuilderInterface
    {
        return new RestResponseBuilder($this->getResourceBuilder());
    }
}
