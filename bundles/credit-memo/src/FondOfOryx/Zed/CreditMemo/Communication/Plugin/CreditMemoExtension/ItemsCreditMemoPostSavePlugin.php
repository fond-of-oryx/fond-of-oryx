<?php

namespace FondOfOryx\Zed\CreditMemo\Communication\Plugin\CreditMemoExtension;

use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacade getFacade()
 * @method \FondOfOryx\Zed\CreditMemo\CreditMemoConfig getConfig()
 */
class ItemsCreditMemoPostSavePlugin extends AbstractPlugin implements CreditMemoPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function postSave(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFacade()->createCreditMemoItems($creditMemoTransfer);
    }
}
