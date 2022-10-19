<?php

namespace FondOfOryx\Glue\CustomerProductListSearchRestApi\Communication\Plugin\ProductListSearchRestApi;

use ArrayObject;
use FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CustomerProductListSearchRestApi\CustomerProductListSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CustomerFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        $getUserMethod = method_exists($restRequest, 'getRestUser') ? 'getRestUser' : 'getUser';

        /** @var \Generated\Shared\Transfer\RestUserTransfer|\Spryker\Glue\GlueApplication\Rest\Request\Data\UserInterface|null $restUser */
        $restUser = $restRequest->$getUserMethod();

        if ($restUser === null) {
            return $filterFieldTransfers;
        }

        if ($restUser->getSurrogateIdentifier() !== null) {
            $filterFieldTransfer = (new FilterFieldTransfer())
                ->setType(CustomerProductListSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER)
                ->setValue($restUser->getSurrogateIdentifier());

            $filterFieldTransfers->append($filterFieldTransfer);
        }

        if ($restUser->getNaturalIdentifier() !== null) {
            $filterFieldTransfer = (new FilterFieldTransfer())
                ->setType(CustomerProductListSearchRestApiConstants::FILTER_FIELD_TYPE_CUSTOMER_REFERENCE)
                ->setValue($restUser->getNaturalIdentifier());

            $filterFieldTransfers->append($filterFieldTransfer);
        }

        return $filterFieldTransfers;
    }
}
