<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader;

use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class OrderBudgetReader implements OrderBudgetReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface $repository
     */
    public function __construct(CompanyBusinessUnitOrderBudgetRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return int|null
     */
    public function getIdOrderBudgetByCompanyBusinessUnit(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): ?int {
        $idCompanyBusinessUnit = $companyBusinessUnitTransfer->getIdCompanyBusinessUnit();

        if ($idCompanyBusinessUnit === null) {
            return null;
        }

        return $this->repository->getIdOrderBudgetByIdCompanyBusinessUnit($idCompanyBusinessUnit);
    }
}
