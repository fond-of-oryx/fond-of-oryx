<?php

namespace FondOfOryx\Zed\OrderBudget\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\OrderBudget\Business\OrderBudgetBusinessFactory getFactory()
 */
class OrderBudgetFacade extends AbstractFacade implements OrderBudgetFacadeInterface
{
    /**
     * @return void
     */
    public function resetOrderBudgets(): void
    {
        $this->getFactory()->createOrderBudgetResetter()->resetAll();
    }
}
