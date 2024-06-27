<?php

namespace FondOfOryx\Zed\EasyApi\Business;

use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\EasyApi\Business\EasyApiBusinessFactory getFactory()
 */
class EasyApiFacade extends AbstractFacade implements EasyApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocument(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer
    {
        return $this->getFactory()->createApiWrapper()->findDocument($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getFile(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer
    {
        return $this->getFactory()->createApiWrapper()->getFile($requestTransfer);
    }
}
