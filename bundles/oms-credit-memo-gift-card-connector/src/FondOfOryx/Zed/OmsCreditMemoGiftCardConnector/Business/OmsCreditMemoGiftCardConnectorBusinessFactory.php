<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business;

use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Check\HasGiftCardRefundCheck;
use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Check\HasGiftCardRefundCheckInterface;
use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Refund\PartialGiftCardRefund;
use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Refund\PartialGiftCardRefundInterface;
use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface;
use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\OmsCreditMemoGiftCardConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

/**
 * @method \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\OmsCreditMemoGiftCardConnectorConfig getConfig()
 */
class OmsCreditMemoGiftCardConnectorBusinessFactory extends AbstractBusinessFactory
{
    use TransactionTrait;

    /**
     * @return \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Check\HasGiftCardRefundCheckInterface
     */
    public function createHasGiftCardRefundCheck(): HasGiftCardRefundCheckInterface
    {
        return new HasGiftCardRefundCheck(
            $this->getCreditMemoGiftCardConnectorFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Refund\PartialGiftCardRefundInterface
     */
    public function createPartialGiftCardRefund(): PartialGiftCardRefundInterface
    {
        return new PartialGiftCardRefund($this->getTransactionHandler());
    }

    /**
     * @return \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface
     */
    protected function getCreditMemoGiftCardConnectorFacade(): OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface
    {
        return $this->getProvidedDependency(OmsCreditMemoGiftCardConnectorDependencyProvider::FACADE_CREDIT_MEMO_GIFT_CARD_CONNECTOR);
    }
}
