<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepository;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestAddressTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CompanyUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface
     */
    protected $reader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyUnitAddressConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCustomerTransferMock = $this->getMockBuilder(RestCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restAddressTransferMock = $this->getMockBuilder(RestAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->reader = new CompanyUnitAddressReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequest(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCustomerTransferMock);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(99);

        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn(5);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressByUuidAndIdCustomer')
            ->with($this->restAddressTransferMock->getId(), $this->restCustomerTransferMock->getIdCustomer())
            ->willReturn($this->companyUnitAddressTransferMock);

        static::assertEquals(
            $this->companyUnitAddressTransferMock,
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
    public function testGetByRestReturnLabelRequestRestAddressNull(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCustomerTransferMock);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(99);

        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAddress')
            ->willReturn(null);

        static::assertNull($this->reader->getByRestReturnLabelRequest($this->restReturnLabelRequestTransferMock));
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestIdCustomerNull(): void
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
