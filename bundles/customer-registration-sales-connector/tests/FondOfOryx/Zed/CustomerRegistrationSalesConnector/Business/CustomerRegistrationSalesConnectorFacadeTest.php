<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor\RegistrationProcessorInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class CustomerRegistrationSalesConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\CustomerRegistrationSalesConnectorFacade
     */
    protected $facade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\CustomerRegistrationSalesConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\Processor\RegistrationProcessorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $registrationProcessorMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(CustomerRegistrationSalesConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->registrationProcessorMock = $this->getMockBuilder(RegistrationProcessorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerRegistrationSalesConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerAccount(): void
    {
        $this->factoryMock->expects($this->atLeastOnce())
            ->method('createRegistrationProcessor')
            ->willReturn($this->registrationProcessorMock);

        $this->registrationProcessorMock->expects($this->atLeastOnce())
            ->method('processRegistration')
            ->with($this->saveOrderTransferMock);

        $this->facade->createCustomerAccount($this->saveOrderTransferMock, $this->quoteTransferMock);
    }
}
