<?php

namespace FondOfOryx\Zed\CreditMemoApi\Business;

use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CreditMemoApi\Business\CreditMemoApiBusinessFactory getFactory()
 */
class CreditMemoApiFacade extends AbstractFacade implements CreditMemoApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function addCreditMemo(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
         return $this->getFactory()
            ->createCreditMemoApi()
            ->add($apiDataTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return array<\Generated\Shared\Transfer\ApiValidationErrorTransfer>
     */
    public function validate(ApiRequestTransfer $apiRequestTransfer): array
    {
        return $this->getFactory()
            ->createCreditMemoApiValidator()
            ->validate($apiRequestTransfer);
    }
}
