<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Communication\Plugin\CreditMemoExtension;

use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorFacade getFacade()
 * @method \FondOfOryx\Zed\CreditMemoGiftCardConnector\CreditMemoGiftCardConnectorConfig getConfig()
 */
class GiftCardsCreditMemoPostSavePlugin extends AbstractPlugin implements CreditMemoPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function postSave(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        return $this->getFacade()->createCreditMemoGiftCards($creditMemoTransfer);
    }
}
