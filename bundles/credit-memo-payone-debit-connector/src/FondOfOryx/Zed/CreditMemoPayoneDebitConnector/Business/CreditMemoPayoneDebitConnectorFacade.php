<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\CreditMemoPayoneDebitConnectorBusinessFactory getFactory()
 */
class CreditMemoPayoneDebitConnectorFacade extends AbstractFacade implements CreditMemoPayoneDebitConnectorFacadeInterface
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
    public function expandIsDebit(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFactory()->createCreditMemoIsDebitExpander()->expandCreditMemo($creditMemoTransfer);
    }
}
