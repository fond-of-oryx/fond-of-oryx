<?php

namespace FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business;

use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemoGiftCardConnector\Business\PayoneCreditMemoGiftCardConnectorBusinessFactory getFactory()
 */
class PayoneCreditMemoGiftCardConnectorFacade extends AbstractFacade implements PayoneCreditMemoGiftCardConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    public function recalculateRefundAmounts(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        return $this->getFactory()->createGiftCardRefundReCalculator()->recalculate($partialOperationRequestTransfer, $creditMemoEntity);
    }
}
