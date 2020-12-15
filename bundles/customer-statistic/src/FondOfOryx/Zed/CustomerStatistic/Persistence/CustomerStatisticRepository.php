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
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getCustomerStatisticByCustomerReference(string $customerReference): ?CustomerStatisticTransfer
    {
        $idCustomer = $this->getIdCustomerByCustomerReference($customerReference);

        if ($idCustomer === null) {
            return null;
        }

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
    protected function getIdCustomerByCustomerReference(string $customerReference): ?int
    {
        /** @var int|null $idCustomer */
        $idCustomer = $this->getFactory()
            ->getCustomerQueryContainer()
            ->queryCustomerByReference($customerReference)
            ->select([SpyCustomerTableMap::COL_ID_CUSTOMER])
            ->find();

        return $idCustomer;
    }
}
