<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Plugin\CartSearchRestApiExtension;

use ArrayObject;
use FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use FondOfOryx\Shared\CartSearchRestApi\CartSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\AbstractPlugin;
use Symfony\Component\HttpFoundation\InputBag;

/**
 * @method \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiFactory getFactory()
 */
class IdFilterFieldsExpanderPlugin extends AbstractPlugin implements FilterFieldsExpanderPluginInterface
{
 /**
  * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
  * @param \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
  *
  * @return \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
  */
    public function expand(RestRequestInterface $restRequest, ArrayObject $filterFieldTransfers): ArrayObject
    {
        if ($restRequest->getResource()->getId() !== null) {
            return $filterFieldTransfers;
        }

        $bag = $restRequest->getHttpRequest()->query;

        /** @phpstan-ignore-next-line */
        $uuids = $bag instanceof InputBag ? $bag->all(
            CartSearchRestApiConstants::PARAMETER_NAME_ID,
        ) : $bag->get(/** @phpstan-ignore-line */
            CartSearchRestApiConstants::PARAMETER_NAME_ID,
        );

        /** @phpstan-ignore-next-line */
        if (!is_array($uuids) || count($uuids) === 0) {
            return $filterFieldTransfers;
        }

        $filterFieldTransfer = (new FilterFieldTransfer())
            ->setType(CartSearchRestApiConstants::FILTER_FIELD_TYPE_UUIDS)
            ->setValue($this->getFactory()->getUtilEncodingService()->encodeJson($uuids));

        $filterFieldTransfers->append($filterFieldTransfer);

        return $filterFieldTransfers;
    }
}
