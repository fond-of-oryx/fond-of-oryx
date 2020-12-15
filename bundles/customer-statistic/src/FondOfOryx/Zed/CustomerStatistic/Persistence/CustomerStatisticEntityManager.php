<?php

namespace FondOfOryx\Zed\CustomerStatistic\Persistence;

use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticPersistenceFactory getFactory()
 */
class CustomerStatisticEntityManager extends AbstractEntityManager implements CustomerStatisticEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerStatisticTransfer $customerStatisticTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer
     */
    public function persistCustomerStatistic(
        CustomerStatisticTransfer $customerStatisticTransfer
    ): CustomerStatisticTransfer {
        $fooCustomerStatistic = $this->getFactory()
            ->createFooCustomerStatisticQuery()
            ->filterByIdCustomerStatistic($customerStatisticTransfer->getIdCustomerStatistic())
            ->findOneOrCreate();

        $this->getFactory()
            ->createCustomerStatisticMapper()
            ->mapTransferToEntity($customerStatisticTransfer, $fooCustomerStatistic);

        $fooCustomerStatistic->save();

        return $this->getFactory()
            ->createCustomerStatisticMapper()
            ->mapEntityToTransfer($fooCustomerStatistic, new CustomerStatisticTransfer());
    }
}
