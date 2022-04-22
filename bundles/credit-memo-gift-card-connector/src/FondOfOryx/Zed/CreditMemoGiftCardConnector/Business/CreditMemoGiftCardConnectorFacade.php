<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Persistence\CreditMemoGiftCardConnectorRepositoryInterface getRepository()
 */
class CreditMemoGiftCardConnectorFacade extends AbstractFacade implements CreditMemoGiftCardConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function createCreditMemoGiftCards(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFactory()->createCreditMemoGiftCardsWriter()->create($creditMemoTransfer);
    }
}
