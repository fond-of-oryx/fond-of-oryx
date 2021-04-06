<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiRepository extends AbstractRepository implements ReturnLabelsRestApiRepositoryInterface
{
    /**
     * @param string $externalReference
     * @param array $companyIds
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddressByExternalReferenceAndCompanyIds(
        string $externalReference,
        array $companyIds
    ): ?CompanyUnitAddressTransfer {
        $companyUnitAddressEntity = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->filterByExternalReference($externalReference)
            ->filterByFkCompany_In($companyIds)
            ->findOne();

        if (!$companyUnitAddressEntity) {
            return null;
        }

        return (new CompanyUnitAddressTransfer())->fromArray(
            $companyUnitAddressEntity->toArray(),
            true
        );
    }
}
