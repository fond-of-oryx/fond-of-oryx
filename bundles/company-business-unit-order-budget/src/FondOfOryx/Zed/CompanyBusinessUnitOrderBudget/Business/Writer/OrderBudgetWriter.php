<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetWriter implements OrderBudgetWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
     */
    protected $orderBudgetFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface $entityManager
     */
    public function __construct(
        CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade,
        CompanyBusinessUnitOrderBudgetEntityManagerInterface $entityManager
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
