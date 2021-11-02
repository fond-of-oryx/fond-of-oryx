<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerExpanderInterface;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\LoginCountIncrementerInterface;
use Generated\Shared\Transfer\CustomerStatisticResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class CustomerStatisticFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerStatisticResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerStatisticResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerExpanderMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\Model\LoginCountIncrementerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loginCountIncrementerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticFacade
     */
    protected $customerStatisticFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CustomerStatisticBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticResponseTransferMock = $this->getMockBuilder(CustomerStatisticResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerExpanderMock = $this->getMockBuilder(CustomerExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loginCountIncrementerMock = $this->getMockBuilder(LoginCountIncrementerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticFacade = new CustomerStatisticFacade();
        $this->customerStatisticFacade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testIncrementLoginCount(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createLoginCountIncrementer')
            ->willReturn($this->loginCountIncrementerMock);

        $this->loginCountIncrementerMock->expects(static::atLeastOnce())
            ->method('increment')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerStatisticResponseTransferMock);

        static::assertEquals(
            $this->customerStatisticResponseTransferMock,
            $this->customerStatisticFacade->incrementLoginCount($this->customerTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandCustomer(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerExpander')
            ->willReturn($this->customerExpanderMock);

        $this->customerExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->customerStatisticFacade->expandCustomer($this->customerTransferMock),
        );
    }
}
