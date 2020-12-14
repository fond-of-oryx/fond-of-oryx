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
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticTransfer|null
     */
    public function getByCustomerReference(string $customerReference): ?CustomerStatisticTransfer
    {
        return $this->repository->getCustomerStatisticByCustomerReference($customerReference);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function findByCustomerReference(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer
    {
        $customerTransfer->requireCustomerReference();

        $customerStatisticTransfer = $this->getByCustomerReference($customerTransfer->getCustomerReference());

        return (new CustomerStatisticResponseTransfer())
            ->setIsSuccessful($customerStatisticTransfer !== null)
            ->setCustomerStatistic($customerStatisticTransfer);
    }
}
