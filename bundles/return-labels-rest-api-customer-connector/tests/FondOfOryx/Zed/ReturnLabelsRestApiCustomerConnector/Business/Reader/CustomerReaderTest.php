<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CustomerReaderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerFacadeMock = $this->getMockBuilder(ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCustomerTransferMock = $this->getMockBuilder(RestCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new CustomerReader($this->customerFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequest(): void
    {
        $idCustomer = 99;

        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCustomerTransferMock);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->reader->getByRestReturnLabelRequest($this->restReturnLabelRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestCustomerNull(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        static::assertNull($this->reader->getByRestReturnLabelRequest($this->restReturnLabelRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestCustomerIdNull(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCustomerTransferMock);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        static::assertNull($this->reader->getByRestReturnLabelRequest($this->restReturnLabelRequestTransferMock));
    }
}
