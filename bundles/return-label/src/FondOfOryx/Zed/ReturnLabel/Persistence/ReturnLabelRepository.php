<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

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
            ->useSpyCompanyBusinessUnitQuery()
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByIdCustomer($returnLabelRequestTransfer->getIdCustomer())
                    ->endUse()
                ->endUse()
            ->endUse();

        $spyCompanyUnitAddressEntity = $spyCompanyUnitAddressQuery->findOne();

        if ($spyCompanyUnitAddressEntity === null) {
            return null;
        }

        return $this->getFactory()->createCompanyUnitAddressMapper()
            ->mapEntityToTransfer($spyCompanyUnitAddressEntity, new CompanyUnitAddressTransfer());
    }
}
