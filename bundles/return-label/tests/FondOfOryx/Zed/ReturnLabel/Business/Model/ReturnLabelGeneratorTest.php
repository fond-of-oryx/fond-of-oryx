<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapter;
use FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapper;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Psr\Http\Message\StreamInterface;

class ReturnLabelGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressReaderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAdapterMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAddressMapperMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelResponseTransfer
     */
    protected $returnLabelResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelServiceRequestTransfer
     */
    protected $returnLabelServiceRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer
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
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressReaderMock = $this->getMockBuilder(CompanyUnitAddressReader::class)
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

        $this->generator = new ReturnLabelGenerator(
            $this->companyUnitAddressReaderMock,
            $this->returnLabelAdapterMock,
            $this->returnLabelAddressMapperMock
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
