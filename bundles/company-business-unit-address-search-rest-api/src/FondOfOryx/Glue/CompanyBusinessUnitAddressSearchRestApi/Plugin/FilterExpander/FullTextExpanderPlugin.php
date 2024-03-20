<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Plugin\FilterExpander;

use ArrayObject;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FullTextExpanderPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @var string
     */
    public const FILTER_NAME = 'q';

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject $filterFieldTransfers
     *
     * @return \ArrayObject
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $q = $restRequest->getHttpRequest()->query->get(static::FILTER_NAME);

        if ($q === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_FULL_TEXT)
            ->setValue($q);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
