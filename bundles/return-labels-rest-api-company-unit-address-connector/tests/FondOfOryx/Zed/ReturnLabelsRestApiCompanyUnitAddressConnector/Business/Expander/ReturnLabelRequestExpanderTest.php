<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapper;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReader;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelRequestExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper\ReturnLabelRequestAddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestAddressMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestCustomerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\ReturnLabelsRestApiCompanyUnitAddressConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Expander\ReturnLabelRequestExpanderInterface
     */
    protected $expander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressReaderMock = $this->getMockBuilder(CompanyUnitAddressReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestAddressMapperMock = $this->getMockBuilder(ReturnLabelRequestAddressMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestAddressTransferMock = $this->getMockBuilder(ReturnLabelRequestAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestCustomerTransferMock = $this->getMockBuilder(ReturnLabelRequestCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyUnitAddressConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expander = new ReturnLabelRequestExpander(
            $this->companyUnitAddressReaderMock,
            $this->returnLabelRequestAddressMapperMock,
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testExpandSuccess(): void
    {
        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->returnLabelRequestCustomerTransferMock);

        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->returnLabelRequestAddressMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUnitAddressTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->returnLabelRequestAddressTransferMock);

        $this->returnLabelRequestCustomerTransferMock->expects(static::atLeastOnce())
            ->method('setAddress')
            ->with($this->returnLabelRequestAddressTransferMock)
            ->willReturnSelf();

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIso3Code')
            ->willReturn('deu');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getReceiver')
            ->willReturn(['deu' => 'deu']);

        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('setReceiverId')
            ->with('deu')
            ->willReturnSelf();

        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->returnLabelRequestCustomerTransferMock);

        static::assertEquals(
            $this->returnLabelRequestTransferMock,
            $this->expander->expand(
                $this->restReturnLabelRequestTransferMock,
                $this->returnLabelRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testExpandCustomerIsNull(): void
    {
        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->companyUnitAddressReaderMock->expects(static::never())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn($this->companyUnitAddressTransferMock);

        static::assertEquals(
            $this->returnLabelRequestTransferMock,
            $this->expander->expand(
                $this->restReturnLabelRequestTransferMock,
                $this->returnLabelRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testExpandAddressIsNull(): void
    {
        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->returnLabelRequestCustomerTransferMock);

        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn(null);

        $this->returnLabelRequestAddressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->returnLabelRequestAddressTransferMock);

        static::assertEquals(
            $this->returnLabelRequestTransferMock,
            $this->expander->expand(
                $this->restReturnLabelRequestTransferMock,
                $this->returnLabelRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testExpandNoReceiverForIso3Code(): void
    {
        $this->returnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->returnLabelRequestCustomerTransferMock);

        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getByRestReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock)
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIso3Code')
            ->willReturn('foo');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getReceiver')
            ->willReturn([]);

        $this->returnLabelRequestAddressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->returnLabelRequestAddressTransferMock);

        static::assertEquals(
            $this->returnLabelRequestTransferMock,
            $this->expander->expand(
                $this->restReturnLabelRequestTransferMock,
                $this->returnLabelRequestTransferMock
            )
        );
    }
}
