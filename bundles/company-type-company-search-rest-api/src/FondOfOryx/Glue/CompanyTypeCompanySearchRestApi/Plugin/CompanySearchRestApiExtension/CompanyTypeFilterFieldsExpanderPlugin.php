<?php

namespace FondOfOryx\Glue\CompanyTypeCompanySearchRestApi\Plugin\CompanySearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CompanyTypeCompanySearchRestApi\CompanyTypeCompanySearchRestApiConstants;
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
            CompanyTypeCompanySearchRestApiConstants::PARAMETER_NAME_TYPE,
        );

        if ($companyType === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CompanyTypeCompanySearchRestApiConstants::FILTER_FIELD_TYPE_TYPE)
            ->setValue($companyType);

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
