<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Communication\Plugin;

use FondOfOryx\Zed\PayoneCreditMemoExtension\Dependency\Plugin\PayoneCreditMemoPreRefundPluginInterface;
use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\PayoneCreditMemoGiftCardConnectorFacadeInterface getFacade()
 */
class PayoneCreditMemoGiftCardPreRefundPlugin extends AbstractPlugin implements PayoneCreditMemoPreRefundPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    public function execute(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        if ($creditMemoEntity->getHasGiftCards() !== true) {
            return $partialOperationRequestTransfer;
        }

        return $this->getFacade()->recalculateRefundAmounts($partialOperationRequestTransfer, $creditMemoEntity);
    }
}
