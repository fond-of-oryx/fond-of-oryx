<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerStatisticTransfer;

class CustomerStatisticWriter implements CustomerStatisticWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManagerInterface $entityManager
     */
    public function __construct(CustomerStatisticEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerStatisticTransfer $customerStatisticTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function persist(CustomerStatisticTransfer $customerStatisticTransfer): CustomerStatisticResponseTransfer
    {
        $customerStatisticTransfer = $this->entityManager->persistCustomerStatistic($customerStatisticTransfer);

        return (new CustomerStatisticResponseTransfer())
            ->setIsSuccessful(true)
            ->setCustomerStatistic($customerStatisticTransfer);
    }
}
