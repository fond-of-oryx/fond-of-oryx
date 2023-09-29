<?php

namespace FondOfOryx\Glue\BusinessOnBehalfCompanyUserSearchRestApi\Plugin\CompanyUserSearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\CompanyUserSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\BusinessOnBehalfCompanyUserSearchRestApi\BusinessOnBehalfCompanyUserSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

class BusinessOnBehalfFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
 /**
  * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
  * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
  *
  * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
  */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $isDefault = $restRequest->getHttpRequest()->query->get(
            BusinessOnBehalfCompanyUserSearchRestApiConstants::PARAMETER_NAME_IS_DEFAULT,
        );

        if ($isDefault === null || preg_match('/^(true|false)/i', $isDefault) !== 1) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(BusinessOnBehalfCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_IS_DEFAULT)
            ->setValue(strtolower($isDefault));

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
