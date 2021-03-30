<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi;

use FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessor;
use FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface getClient()
 */
class ReturnLabelsRestApiFactory extends AbstractFactory
{
    /**
     * @return \FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor\ReturnLabelProcessorInterface
     */
    public function createReturnLabelProcessor(): ReturnLabelProcessorInterface
    {
        return new ReturnLabelProcessor(
            $this->getClient(),
            $this->getResourceBuilder()
        );
    }
}
