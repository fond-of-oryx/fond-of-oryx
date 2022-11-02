<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReader;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CompanyBusinessUnitBusinessUnitExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReader|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitReaderMock;

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
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpander
     */
    protected $companyBusinessUnitBusinessUnitExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitReaderMock = $this->getMockBuilder(CompanyBusinessUnitReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitBusinessUnitExpander = new CompanyBusinessUnitExpander(
            $this->companyBusinessUnitReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testExpandSuccess(): void
    {
        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('foobar@mailinator.con');

        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('setEmail')
            ->willReturnSelf();

        static::assertEquals($this->returnLabelRequestTransferMock, $this->companyBusinessUnitBusinessUnitExpander->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testExpandCompanyBusinessUnitNotFound(): void
    {
        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn(null);

        $this->returnLabelRequestTransferMock->expects(static::never())
            ->method('getCustomer');

        static::assertEquals($this->returnLabelRequestTransferMock, $this->companyBusinessUnitBusinessUnitExpander->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        ));
    }
}
