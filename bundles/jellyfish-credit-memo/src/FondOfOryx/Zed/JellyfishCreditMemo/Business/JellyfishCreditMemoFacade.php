<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface getRepository()
 */
class JellyfishCreditMemoFacade extends AbstractFacade implements JellyfishCreditMemoFacadeInterface
{
    /**
     * @inheritDoc
     *
     * @api
     *
     * @retrun void
     */
    public function exportCreditMemos(): void
    {
        $this->getFactory()->createCreditMemoExporter()->export();
    }

    /**
     * @param int $salesOderId
     * @param array $salesOrderItemIds
     *
     * @return void
     */
    public function exportCreditMemo(int $salesOderId, array $salesOrderItemIds): void
    {
        $this->getFactory()->createCreditMemoExporter()->exportBySalesOrderIdAndSalesOrderItemIds($salesOderId, $salesOrderItemIds);
    }
}
