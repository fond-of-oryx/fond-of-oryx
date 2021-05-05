<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapper;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelCustomerTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use GuzzleHttp\Psr7\Stream;

class ReturnLabelGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitResourceReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressResourceReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAdapterMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelCustomerMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelCustomerMapper;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelCustomerTransferMock;

    /**
     * @var \Psr\Http\Message\StreamInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $streamMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressReaderMock = $this->getMockBuilder(CompanyUnitAddressResourceReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitReaderMock = $this->getMockBuilder(CompanyBusinessUnitResourceResourceReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelAdapterMock = $this->getMockBuilder(ReturnLabelAdapter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelCustomerMapper = $this->getMockBuilder(ReturnLabelCustomerMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelCustomerTransferMock = $this->getMockBuilder(ReturnLabelCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamMock = $this->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new ReturnLabelGenerator(
            $this->companyUnitAddressReaderMock,
            $this->companyBusinessUnitReaderMock,
            $this->returnLabelAdapterMock,
            $this->returnLabelCustomerMapper,
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testGenerateSuccess(): void
    {
        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getByReturnLabelRequest')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getByReturnLabelRequest')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->returnLabelCustomerMapper->expects(static::atLeastOnce())
            ->method('mapCompanyBusinessUnitToReturnLabelCustomer')
            ->willReturn($this->returnLabelCustomerTransferMock);

        $this->returnLabelCustomerMapper->expects(static::atLeastOnce())
            ->method('mapCompanyUnitAddressToReturnLabelCustomer')
            ->willReturn($this->returnLabelCustomerTransferMock);

        $this->returnLabelAdapterMock->expects(static::atLeastOnce())
            ->method('sendRequest')
            ->willReturn($this->streamMock);

        static::assertInstanceOf(
            ReturnLabelResponseTransfer::class,
            $this->generator->generate($this->returnLabelRequestTransferMock)
        );
    }
}
