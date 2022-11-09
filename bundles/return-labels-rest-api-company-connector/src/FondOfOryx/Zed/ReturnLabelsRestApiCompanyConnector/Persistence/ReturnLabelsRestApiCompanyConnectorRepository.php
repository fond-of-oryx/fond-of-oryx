<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiCompanyConnectorRepository extends AbstractRepository implements ReturnLabelsRestApiCompanyConnectorRepositoryInterface
{
    /**
     * @param string $companyUserReference
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyByCompanyUserReferenceAndIdCustomer(
        string $companyUserReference,
        int $idCustomer
    ): ?CompanyTransfer {
        $spyCompanyQuery = $this->getFactory()
            ->getCompanyQuery()
            ->clear();

        $spyCompanyEntity = $spyCompanyQuery
            ->useCompanyUserQuery()
                ->filterByCompanyUserReference($companyUserReference)
                ->useCustomerQuery()
                    ->filterByIdCustomer($idCustomer)
                ->endUse()
            ->endUse()
            ->findOne();

        if ($spyCompanyEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyMapper()
            ->mapEntityToTransfer($spyCompanyEntity, new CompanyTransfer());
    }
}
