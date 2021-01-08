<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerStatisticReader implements CustomerStatisticReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface $repository
     */
    public function __construct(CustomerStatisticRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getByIdCustomer(int $idCustomer): ?CustomerStatisticTransfer
    {
        return $this->repository->getCustomerStatisticByIdCustomer($idCustomer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function findByIdCustomer(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer
    {
        $customerTransfer->requireIdCustomer();

        $customerStatisticTransfer = $this->getByIdCustomer($customerTransfer->getIdCustomer());

        return (new CustomerStatisticResponseTransfer())
            ->setIsSuccessful($customerStatisticTransfer !== null)
            ->setCustomerStatistic($customerStatisticTransfer);
    }
}
