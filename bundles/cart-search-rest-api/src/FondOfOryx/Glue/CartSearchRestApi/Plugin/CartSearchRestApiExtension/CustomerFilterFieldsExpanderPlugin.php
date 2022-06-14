<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Plugin\CartSearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;

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

        if ($restUser === null || $restUser->getSurrogateIdentifier() === null) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CartSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER)
            ->setValue($restUser->getSurrogateIdentifier());

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
