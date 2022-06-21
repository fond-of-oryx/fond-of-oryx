<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Check;

use FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface;

class HasGiftCardRefundCheck implements HasGiftCardRefundCheckInterface
{
    /**
     * @var \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface
     */
    protected $omsCreditMemoGiftCardConnectorFacade;

    /**
     * @param \FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Dependency\Facade\OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface $omsCreditMemoGiftCardConnectorFacade
     */
    public function __construct(OmsCreditMemoGiftCardConnectorToCreditMemoGiftCardConnectorInterface $omsCreditMemoGiftCardConnectorFacade)
    {
        $this->omsCreditMemoGiftCardConnectorFacade = $omsCreditMemoGiftCardConnectorFacade;
    }

    /**
     * @param int $idSalesOrderItem
     *
     * @return bool
     */
    public function check(int $idSalesOrderItem): bool
    {
        return count($this->omsCreditMemoGiftCardConnectorFacade->findCreditMemoGiftCardsByIdSalesOrderItem($idSalesOrderItem)) > 0;
    }
}
