<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\Writer;

use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetWriter implements OrderBudgetWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface
     */
    protected $orderBudgetFacade;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface $orderBudgetFacade
     * @param \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface $entityManager
     */
    public function __construct(
        OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface $orderBudgetFacade,
        OrderBudgetCompanyBusinessUnitConnectorEntityManagerInterface $entityManager
    ) {
        $this->orderBudgetFacade = $orderBudgetFacade;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function createForCompanyBusinessUnit(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): void
    {
        if ($companyBusinessUnitTransfer->getFkOrderBudget() !== null) {
            return;
        }

        $orderBudgetTransfer = $this->orderBudgetFacade->createOrderBudget();

        $companyBusinessUnitTransfer->setFkOrderBudget($orderBudgetTransfer->getIdOrderBudget())
            ->setOrderBudget($orderBudgetTransfer);

        $this->entityManager->assignOrderBudgetToCompanyBusinessUnit($companyBusinessUnitTransfer);
    }
}
