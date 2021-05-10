<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReader;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CustomerExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestCustomerMapperMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestCustomerTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface
     */
    protected $expander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerReaderMock = $this->getMockBuilder(CustomerReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestCustomerMapperMock = $this->getMockBuilder(ReturnLabelRequestCustomerMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransfer = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestCustomerTransferMock = $this->getMockBuilder(ReturnLabelRequestCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new CustomerExpander(
            $this->customerReaderMock,
            $this->returnLabelRequestCustomerMapperMock
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn($this->customerTransferMock);

        $this->returnLabelRequestCustomerMapperMock->expects(static::atLeastOnce())
            ->method('fromCustomerTransfer')
            ->with($this->customerTransferMock)
            ->with($this->returnLabelRequestCustomerTransferMock);

        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('setCustomer')
            ->with($this->returnLabelRequestCustomerMapperMock)
            ->willReturn($this->returnLabelRequestTransferMock);

        $returnLabelRequestTransfer = $this->expander->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock
        );

        static::assertInstanceOf(
            $returnLabelRequestTransfer->getCustomer(),
            $this->returnLabelRequestCustomerTransferMock
        );
    }

    /**
     * @return void
     */
    public function testExpandCustomerNotFound(): void
    {
        $this->customerReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn(null);

        $returnLabelRequestTransfer = $this->expander->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock
        );

        static::assertNull($returnLabelRequestTransfer->getCustomer());
    }
}
