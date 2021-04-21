<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapper;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Psr\Http\Message\StreamInterface;

class ReturnLabelGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyBusinessUnitReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAdapterMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAddressMapperMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelServiceRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelServiceRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\ReturnLabelGeneratorInterface
     */
    protected $generator;

    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $streamInterfaceMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressReaderMock = $this->getMockBuilder(CompanyUnitAddressReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitReader = $this->getMockBuilder(CompanyBusinessUnitReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelAdapterMock = $this->getMockBuilder(ReturnLabelAdapter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelAddressMapperMock = $this->getMockBuilder(ReturnLabelAddressMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelResponseTransferMock = $this->getMockBuilder(ReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelServiceRequestTransferMock = $this->getMockBuilder(ReturnLabelResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->streamInterfaceMock = $this->getMockBuilder(StreamInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ReturnLabelConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitReaderMock = $this->getMockBuilder(CompanyBusinessUnitReader::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new ReturnLabelGenerator(
            $this->companyUnitAddressReaderMock,
            $this->companyBusinessUnitReader,
            $this->returnLabelAdapterMock,
            $this->returnLabelAddressMapperMock,
            $this->configMock
        );
    }

    /**
     * @return void
     */
    public function testGenerateSuccess(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getByReturnLabelRequest')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getByReturnLabelRequest')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        static::assertInstanceOf(
            ReturnLabelResponseTransfer::class,
            $this->generator->generate($this->returnLabelRequestTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testGenerateNull(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getByReturnLabelRequest')
            ->willReturn(null);

        static::assertInstanceOf(
            ReturnLabelResponseTransfer::class,
            $this->generator->generate($this->returnLabelRequestTransferMock)
        );
    }
}
