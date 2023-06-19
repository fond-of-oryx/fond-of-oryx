<?php

namespace FondOfOryx\Glue\CompanyUsersBulkRestApi\Processor\Builder;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildEmptyRestResponse(): RestResponseInterface;
}
