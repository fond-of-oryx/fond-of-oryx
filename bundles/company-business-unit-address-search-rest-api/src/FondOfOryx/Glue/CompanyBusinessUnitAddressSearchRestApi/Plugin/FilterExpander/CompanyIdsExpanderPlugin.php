<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Plugin\FilterExpander;

use ArrayObject;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyIdsExpanderPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @var string
     */
    public const FILTER_NAME = 'company-id';

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
            ->setType(CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID)
            ->setValue((string)$companyUuid);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
