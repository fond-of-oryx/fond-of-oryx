<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReader;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelRequestExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReader|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyReaderMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestCustomerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander\ReturnLabelRequestExpander
     */
    protected $returnLabelRequestExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyReaderMock = $this->getMockBuilder(CompanyReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestCustomerTransferMock = $this->getMockBuilder(ReturnLabelRequestCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestExpander = new ReturnLabelRequestExpander($this->companyReaderMock);
    }

    /**
     * @return void
     */
    public function testExpandSuccess(): void
    {
        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->returnLabelRequestCustomerTransferMock);

        $this->companyReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getDebtorNumber')
            ->willReturn('debtor-number');

        $this->returnLabelRequestCustomerTransferMock->expects(static::atLeastOnce())
            ->method('setReference')
            ->with('debtor-number')
            ->willReturnSelf();

        static::assertEquals($this->returnLabelRequestTransferMock, $this->returnLabelRequestExpander->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testExpandFailedNoCustomer(): void
    {
        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->companyReaderMock->expects(static::never())
            ->method('getByRestReturnLabelRequest');

        static::assertEquals($this->returnLabelRequestTransferMock, $this->returnLabelRequestExpander->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testExpandFailedNoCompany(): void
    {
        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->returnLabelRequestCustomerTransferMock);

        $this->companyReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn(null);

        $this->companyTransferMock->expects(static::never())
            ->method('getDebtorNumber');

        static::assertEquals($this->returnLabelRequestTransferMock, $this->returnLabelRequestExpander->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        ));
    }
}
