<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Generated\Shared\Transfer\CustomerTransfer;

class CustomerExpander implements CustomerExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface
     */
    protected $customerStatisticReader;

    /**
     * @param \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface $customerStatisticReader
     */
    public function __construct(CustomerStatisticReaderInterface $customerStatisticReader)
    {
        $this->customerStatisticReader = $customerStatisticReader;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function expand(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        if ($customerTransfer->getIdCustomer() === null || $customerTransfer->getCustomerReference() === null) {
            return $customerTransfer;
        }

        $customerStatisticTransfer = $this->customerStatisticReader->getByCustomerReference(
            $customerTransfer->getCustomerReference()
        );

        return $customerTransfer->setCustomerStatistic($customerStatisticTransfer);
    }
}
