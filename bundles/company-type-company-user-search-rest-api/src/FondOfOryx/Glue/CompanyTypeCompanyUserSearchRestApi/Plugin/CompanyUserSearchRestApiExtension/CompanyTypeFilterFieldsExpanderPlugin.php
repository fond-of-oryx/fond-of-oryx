<?php

namespace FondOfOryx\Glue\CompanyTypeCompanyUserSearchRestApi\Plugin\CompanyUserSearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\CompanyUserSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyTypeCompanyUserSearchRestApi\CompanyTypeCompanyUserSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class CompanyTypeFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $companyType = $restRequest->getHttpRequest()->query->get(
            CompanyTypeCompanyUserSearchRestApiConstants::PARAMETER_NAME_COMPANY_TYPE,
        );

        if ($companyType === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyTypeCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_TYPE)
            ->setValue($companyType);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
