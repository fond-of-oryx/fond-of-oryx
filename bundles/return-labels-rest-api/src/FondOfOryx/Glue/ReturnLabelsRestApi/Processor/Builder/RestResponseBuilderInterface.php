<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Builder;

use Generated\Shared\Transfer\ReturnLabelTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotGeneratedRestResponse(): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelTransfer $returnLabelTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestResponse(
        ReturnLabelTransfer $returnLabelTransfer
    ): RestResponseInterface;
}
