<?php

namespace FondOfOryx\Zed\GiftCardApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\GiftCardApi\Persistence\GiftCardApiRepositoryInterface getRepository()
 */
class GiftCardApiFacade extends AbstractFacade implements GiftCardApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findGiftCard(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
         return $this->getFactory()
            ->createGiftCardApi()
            ->find($apiRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return array
     */
    public function validate(ApiDataTransfer $apiDataTransfer): array
    {
        return $this->getFactory()
            ->createGiftCardApiValidator()
            ->validate($apiDataTransfer);
    }
}
