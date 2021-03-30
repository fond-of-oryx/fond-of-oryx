<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiCompanyUnitAddressRepository extends AbstractRepository implements ReturnLabelsRestApiCompanyUnitAddressRepositoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $externalReference
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddressByExternalReference(string $externalReference): ?CompanyUnitAddressTransfer
    {
        $companyUnitAddressEntity = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->filterByExternalReference($externalReference)
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
