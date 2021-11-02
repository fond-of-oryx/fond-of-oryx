<?php

namespace FondOfOryx\Zed\CustomerStatistic\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Orm\Zed\CustomerStatistic\Persistence\FooCustomerStatistic;

/**
 * @codeCoverageIgnore
 */
class CustomerStatisticMapper implements CustomerStatisticMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerStatisticTransfer $customerStatisticTransfer
     * @param \Orm\Zed\CustomerStatistic\Persistence\FooCustomerStatistic $fooCustomerStatistic
     *
     * @return \Orm\Zed\CustomerStatistic\Persistence\FooCustomerStatistic
     */
    public function mapTransferToEntity(
        CustomerStatisticTransfer $customerStatisticTransfer,
        FooCustomerStatistic $fooCustomerStatistic
    ): FooCustomerStatistic {
        $fooCustomerStatistic->fromArray(
            $customerStatisticTransfer->toArray(),
        );

        return $fooCustomerStatistic;
    }

    /**
     * @param \Orm\Zed\CustomerStatistic\Persistence\FooCustomerStatistic $fooCustomerStatistic
     * @param \Generated\Shared\Transfer\CustomerStatisticTransfer $customerStatisticTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer
     */
    public function mapEntityToTransfer(
        FooCustomerStatistic $fooCustomerStatistic,
        CustomerStatisticTransfer $customerStatisticTransfer
    ): CustomerStatisticTransfer {
        return $customerStatisticTransfer->fromArray(
            $fooCustomerStatistic->toArray(),
            true,
        );
    }
}
