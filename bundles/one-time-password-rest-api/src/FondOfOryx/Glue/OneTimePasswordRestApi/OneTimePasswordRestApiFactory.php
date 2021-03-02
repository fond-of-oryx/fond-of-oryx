<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi;

use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessor;
use FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessorInterface;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\OneTimePassword\OneTimePasswordClientInterface getClient()
 */
class OneTimePasswordRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\OneTimePasswordRestApi\Processor\OneTimePasswordProcessorInterface
     */
    public function createOneTimePasswordProcessor(): OneTimePasswordProcessorInterface
    {
        return new OneTimePasswordProcessor($this->getResourceBuilder());
    }
}
