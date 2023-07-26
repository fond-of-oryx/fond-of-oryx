<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Business\Expander;

use FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;

class CompanyBusinessUnitToCompanyTransferExpander implements ExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface
     */
    protected CompanyUsersBulkRestApiRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface $repository
     */
    public function __construct(CompanyUsersBulkRestApiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expand(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer {
        $companyIds = $this->resolveCompanyIds($companyUsersBulkPreparationCollectionTransfer);
        $companyBusinessUnitCollection = $this->repository->findCompanyBusinessUnitsByIdCompany($companyIds);

        foreach ($companyUsersBulkPreparationCollectionTransfer->getItems() as $item) {
            $companyTransfer = $item->getCompany();
            $idCompany = $companyTransfer->getIdCompany();
            $companyBusinessSUnits = [];
            foreach ($companyTransfer->getCompanyBusinessUnits() as $companyBusinessUnit){
                $companyBusinessSUnits[$companyBusinessUnit->getIdCompanyBusinessUnit()] = $companyBusinessUnit;
            }

            if (array_key_exists($idCompany, $companyBusinessUnitCollection)){
                foreach ($companyBusinessUnitCollection[$idCompany] as $idCompanyBusinessUnit => $companyBusinessUnit){
                    if (!array_key_exists($idCompanyBusinessUnit, $companyBusinessSUnits)){
                        $companyTransfer->addCompanyBusinessUnit($companyBusinessUnit);
                        $companyBusinessSUnits[$idCompanyBusinessUnit] = $companyBusinessUnit;
                    }
                }
            }

            $item->setCompany($companyTransfer);
        }

        return $companyUsersBulkPreparationCollectionTransfer;
    }


    /**
     * @param array<\Generated\Shared\Transfer\CompanyUsersBulkCompanyTransfer> $companyUsersBulkCompanyTransfers
     *
     * @return array<int>
     */
    protected function resolveCompanyIds(CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer): array
    {
        $prepared = [];
        foreach ($companyUsersBulkPreparationCollectionTransfer->getItems() as $companyUsersBulkPreparationTransfer) {
            $prepared[] = $companyUsersBulkPreparationTransfer->getCompanyOrFail()->getIdCompany();
        }

        return $prepared;
    }
}
