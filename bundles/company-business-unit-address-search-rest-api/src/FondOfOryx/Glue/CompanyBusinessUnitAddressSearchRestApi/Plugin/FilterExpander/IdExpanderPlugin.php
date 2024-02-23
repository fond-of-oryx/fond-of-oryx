<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Plugin\FilterExpander;

use ArrayObject;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class IdExpanderPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @var string
     */
    public const FILTER_NAME = 'id';

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject $filterFieldTransfers
     *
     * @return \ArrayObject
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $companyBusinessUnitAddressUuids = null;
        $query = $restRequest->getHttpRequest()->query;
        if ($query->getIterator()->offsetExists(static::FILTER_NAME)) {
            $companyBusinessUnitAddressUuids = $query->getIterator()->offsetGet(static::FILTER_NAME);
        }

        if (!is_array($companyBusinessUnitAddressUuids) || count($companyBusinessUnitAddressUuids) === 0) {
            return $filterFieldTransfers;
        }

        foreach ($companyBusinessUnitAddressUuids as $companyUuid) {
            $filterFieldTransfer = (new FilterFieldTransfer())
                ->setType(CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_ADDRESS_UUID)
                ->setValue($companyUuid);

            $filterFieldTransfers->append($filterFieldTransfer);
        }

        return $filterFieldTransfers;
    }
}
