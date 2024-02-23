<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Plugin\FilterExpander;

use ArrayObject;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class SortExpanderPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @var string
     */
    public const FILTER_NAME = 'sort';

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject $filterFieldTransfers
     *
     * @return \ArrayObject
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $companyUuid = $restRequest->getHttpRequest()->query->get(static::FILTER_NAME);

        if ($companyUuid === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyBusinessUnitSearchRestApiConstants::FILTER_FIELD_TYPE_SORT)
            ->setValue((string)$companyUuid);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
