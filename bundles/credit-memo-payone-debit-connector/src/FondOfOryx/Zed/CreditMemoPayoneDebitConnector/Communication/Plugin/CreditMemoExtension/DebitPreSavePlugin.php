<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Communication\Plugin\CreditMemoExtension;

use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPreSavePluginInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\CreditMemoPayoneDebitConnectorFacade getFacade()
 */
class DebitPreSavePlugin extends AbstractPlugin implements CreditMemoPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function preSave(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFacade()->expandIsDebit($creditMemoTransfer);
    }
}
