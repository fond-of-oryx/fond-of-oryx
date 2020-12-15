<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface;
use Generated\Shared\Transfer\CustomerStatisticTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerStatisticReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerStatisticReader
     */
    protected $customerStatisticReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CustomerStatisticRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticTransferMock = $this->getMockBuilder(CustomerStatisticTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticReader = new CustomerStatisticReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetByCustomerReference(): void
    {
        $customerReference = 'STORE-1';

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCustomerStatisticByCustomerReference')
            ->with($customerReference)
            ->willReturn($this->customerStatisticTransferMock);

        static::assertEquals(
            $this->customerStatisticTransferMock,
            $this->customerStatisticReader->getByCustomerReference($customerReference)
        );
    }

    /**
     * @return void
     */
    public function testFindByCustomerReference(): void
    {
        $customerReference = 'STORE-1';

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('requireCustomerReference')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCustomerStatisticByCustomerReference')
            ->with($customerReference)
            ->willReturn($this->customerStatisticTransferMock);

        $customerStatisticResponseTransfer = $this->customerStatisticReader
            ->findByCustomerReference($this->customerTransferMock);

        static::assertTrue($customerStatisticResponseTransfer->getIsSuccessful());
        static::assertEquals(
            $this->customerStatisticTransferMock,
            $customerStatisticResponseTransfer->getCustomerStatistic()
        );
    }
}
