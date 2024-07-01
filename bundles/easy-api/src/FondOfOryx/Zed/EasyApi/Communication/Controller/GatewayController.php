<?php

namespace FondOfOryx\Zed\EasyApi\Communication\Controller;

use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\EasyApi\Business\EasyApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\EasyApiFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function findDocumentAction(EasyApiFilterTransfer $filterTransfer): EasyApiResponseTransfer
    {
        return $this->getFacade()->findDocument($filterTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\EasyApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\EasyApiResponseTransfer
     */
    public function getDocumentAction(EasyApiRequestTransfer $requestTransfer): EasyApiResponseTransfer
    {
        return $this->getFacade()->getFile($requestTransfer);
    }
}
