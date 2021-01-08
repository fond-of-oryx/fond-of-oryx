<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class LoginCountIncrementer implements LoginCountIncrementerInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface
     */
    protected $customerStatisticReader;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticWriterInterface
     */
    protected $customerStatisticWriter;

    /**
     * @param \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReaderInterface $customerStatisticReader
     * @param \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticWriterInterface $customerStatisticWriter
     */
    public function __construct(
        CustomerStatisticReaderInterface $customerStatisticReader,
        CustomerStatisticWriterInterface $customerStatisticWriter
    ) {
        $this->customerStatisticReader = $customerStatisticReader;
        $this->customerStatisticWriter = $customerStatisticWriter;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerStatisticResponseTransfer
     */
    public function increment(CustomerTransfer $customerTransfer): CustomerStatisticResponseTransfer
    {
        $idCustomer = $customerTransfer->getIdCustomer();

        if ($idCustomer === null) {
            return (new CustomerStatisticResponseTransfer())
                ->setIsSuccessful(false);
        }

        $customerStatisticTransfer = $this->customerStatisticReader->getByIdCustomer($idCustomer);

        if ($customerStatisticTransfer === null) {
            $customerStatisticTransfer = (new CustomerStatisticTransfer())
                ->setFkCustomer($idCustomer);
        }

        $loginCount = $customerStatisticTransfer->getLoginCount() ?? 0;

        $customerStatisticTransfer->setLoginCount($loginCount + 1);

        return $this->customerStatisticWriter->persist($customerStatisticTransfer);
    }
}
