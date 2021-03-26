<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi;

use FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface;
use Spryker\Glue\Kernel\AbstractFactory;
use FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessor;

/**
 * @method \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface getClient()
 */
class ReturnLabelsRestApiFactory extends AbstractFactory
{
    public function createReturnLabelProcessor(): ReturnLabelProcessorInterface
    {
        return new ReturnLabelProcessor(
            $this->getClient(),
            $this->getResourceBuilder()
        );
    }
}
