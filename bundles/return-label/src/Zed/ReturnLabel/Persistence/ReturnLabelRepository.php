<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelPersistenceFactory getFactory()
 */
class ReturnLabelRepository extends AbstractRepository implements ReturnLabelRepositoryInterface
{
    /**
     * @param string $companyBusinessUnitUuid
     * @param string $companyBusinessUnitAddressUuid
     *
     * @return CompanyUnitAddressTransfer|null
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findCompanyBusinessUnitAddressByUuidAndCompany(
        string $companyBusinessUnitUuid,
        string $companyBusinessUnitAddressUuid
    ): ?CompanyUnitAddressTransfer
    {
        $this->getFactory()
            ->getCompanyUnitAddressQueryContainer()
            ->queryCompanyUnitAddress()
            ->filterByUuid($companyBusinessUnitAddressUuid)
            ->leftJoinWithCountry()
            ->useSpyCompanyUnitAddressToCompanyBusinessUnitQuery(null, Criteria::LEFT_JOIN)
                ->leftJoinCompanyBusinessUnit('company')
            ->where('company.uuid', $companyBusinessUnitUuid)
            ->endUse()
            ->findOne();

        if (!$companyUnitAddressEntity) {
            return null;
        }

        return $this->getFactory()
            ->createReturnLabelCompanyUnitAddressMapper()
            ->mapCompanyUnitAddressEntityToCompanyUnitAddressTransfer(
                $companyUnitAddressEntity,
                new CompanyUnitAddressTransfer()
            );
    }

    public function foo(string $uuid)
    {
        $query = $this->getFactory()->createCompanyUnitAddressQuery()
            ->setModelAlias('companyUnitAddressQuery')
        $query->filterByUuid($uuid)
            ->leftJoinWith('companyUnitAddressQuery.')
        ;

    }
}
