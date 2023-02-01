<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business;

use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * Class ThirtyFiveUpApiFacade
 *
 * @package FondOfOryx\Zed\ThirtyFiveUpApi\Business
 *
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Business\ThirtyFiveUpApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface getRepository()
 */
class ThirtyFiveUpApiFacade extends AbstractFacade implements ThirtyFiveUpApiFacadeInterface
{
    /**
     * @param int $idThirtyFiveUpOrder
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function updateThirtyFiveUpOrder(int $idThirtyFiveUpOrder, ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        return $this->getFactory()->createThirtyFiveUpApi()->update($idThirtyFiveUpOrder, $apiDataTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findThirtyFiveUpOrder(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        return $this->getFactory()->createThirtyFiveUpApi()->find($apiRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFactory()->createThirtyFiveUpApiValidator()->validate($apiRequestTransfer);
    }
}
