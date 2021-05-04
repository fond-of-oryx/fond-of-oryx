<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelPersistenceFactory getFactory()
 */
class ReturnLabelRepository extends AbstractRepository implements ReturnLabelRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyUnitAddressTransfer {
        /** @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $spyCompanyUnitAddressQuery */
        $spyCompanyUnitAddressQuery = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear()
            ->filterByIdCompanyUnitAddress($returnLabelRequestTransfer->getIdCompanyUnitAddress())
            ->useCompanyQuery()
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByIdCustomer($returnLabelRequestTransfer->getIdCustomer())
                    ->endUse()
                ->endUse()
            ->endUse();

        $spyCompanyUnitAddressQuery->leftJoinCountry();
        $spyCompanyUnitAddressEntity = $spyCompanyUnitAddressQuery->findOne();

        if ($spyCompanyUnitAddressEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyUnitAddressMapper()
            ->mapEntityToTransfer($spyCompanyUnitAddressEntity, new CompanyUnitAddressTransfer());
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|null
     */
    public function getCompanyBusinessUnitByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyBusinessUnitTransfer {
        $spyCompanyBusinessUnitQuery = $this->getFactory()
            ->getCompanyBusinessUnitQuery()
            ->clear()
            ->useCompanyQuery()
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByIdCustomer($returnLabelRequestTransfer->getIdCustomer())
                    ->endUse()
                ->endUse()
            ->endUse();

        $spyCompanyBusinessUnitEntity = $spyCompanyBusinessUnitQuery->findOne();

        if ($spyCompanyBusinessUnitEntity === null) {
            return null;
        }

        $companyBusinessUnitTransfer = new CompanyBusinessUnitTransfer();
        $companyTransfer = $this->getCompanyByReturnLabelRequest($returnLabelRequestTransfer);

        if ($companyTransfer !== null) {
            $companyBusinessUnitTransfer->setCompany($companyTransfer);
        }

        return $this->getFactory()
            ->createCompanyBusinessUnitMapper()
            ->mapEntityToTransfer($spyCompanyBusinessUnitEntity, $companyBusinessUnitTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ?CompanyTransfer {
        $spyCompanyEntityQuery = $this->getFactory()
            ->getCompanyQuery()
            ->clear()
            ->useCompanyUserQuery()
                ->useCustomerQuery()
                    ->filterByIdCustomer($returnLabelRequestTransfer->getIdCustomer())
                ->endUse()
            ->endUse();

        $spyCompanyEntity = $spyCompanyEntityQuery->findOne();

        if ($spyCompanyEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityToTransfer($spyCompanyEntity, new CompanyTransfer());
    }
}
