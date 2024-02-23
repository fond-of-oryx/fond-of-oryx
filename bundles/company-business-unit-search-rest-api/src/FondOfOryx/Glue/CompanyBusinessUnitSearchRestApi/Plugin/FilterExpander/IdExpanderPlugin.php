<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Plugin\FilterExpander;

use ArrayObject;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConstants;
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
        $companyUuids = null;
        $query = $restRequest->getHttpRequest()->query;
        if ($query->getIterator()->offsetExists(static::FILTER_NAME)) {
            $companyUuids = $query->getIterator()->offsetGet(static::FILTER_NAME);
        }

        if (!is_array($companyUuids) || count($companyUuids) === 0) {
            return $filterFieldTransfers;
        }

        foreach ($companyUuids as $companyUuid) {
            $filterFieldTransfer = (new FilterFieldTransfer())
                ->setType(CompanyBusinessUnitSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID)
                ->setValue($companyUuid);

            $filterFieldTransfers->append($filterFieldTransfer);
        }

        return $filterFieldTransfers;
    }
}
