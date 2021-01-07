<?php

namespace FondOfOryx\Zed\CustomerStatistic\Persistence;

use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticPersistenceFactory getFactory()
 */
class CustomerStatisticRepository extends AbstractRepository implements CustomerStatisticRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getCustomerStatisticByIdCustomer(int $idCustomer): ?CustomerStatisticTransfer
    {
        $fooCustomerStatistic = $this->getFactory()
            ->createFooCustomerStatisticQuery()
            ->filterByFkCustomer($idCustomer)
            ->findOne();

        if ($fooCustomerStatistic === null) {
            return null;
        }

        return $this->getFactory()
            ->createCustomerStatisticMapper()
            ->mapEntityToTransfer($fooCustomerStatistic, new CustomerStatisticTransfer());
    }

    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getIdCustomerByCustomerReference(string $customerReference): ?int
    {
        /** @var int|null $idCustomer */
        $idCustomer = $this->getFactory()
            ->getCustomerQueryContainer()
            ->queryCustomerByReference($customerReference)
            ->select([SpyCustomerTableMap::COL_ID_CUSTOMER])
            ->findOne();

        return $idCustomer;
    }
}
