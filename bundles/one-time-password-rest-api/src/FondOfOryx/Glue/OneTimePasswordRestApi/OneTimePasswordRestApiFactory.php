<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi;

use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordLoginLinkProcessor;
use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordLoginLinkProcessorInterface;
use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessor;
use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface getClient()
 */
class OneTimePasswordRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessorInterface
     */
    public function createOneTimePasswordProcessor(): OneTimePasswordProcessorInterface
    {
        return new OneTimePasswordProcessor(
            $this->getResourceBuilder(),
            $this->getClient()
        );
    }

    /**
     * @return \FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordLoginLinkProcessorInterface
     */
    public function createOneTimePasswordLoginLinkProcessor(): OneTimePasswordLoginLinkProcessorInterface
    {
        return new OneTimePasswordLoginLinkProcessor(
            $this->getResourceBuilder(),
            $this->getClient()
        );
    }
}
