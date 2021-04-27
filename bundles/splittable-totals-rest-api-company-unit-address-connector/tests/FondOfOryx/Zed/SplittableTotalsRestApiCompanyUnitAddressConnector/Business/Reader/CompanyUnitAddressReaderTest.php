<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestAddressTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class CompanyUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressMapperMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReader
     */
    protected $companyUnitAddressReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->addressMapperMock = $this->getMockBuilder(AddressMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restAddressTransferMock = $this->getMockBuilder(RestAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressReader = new CompanyUnitAddressReader(
            $this->addressMapperMock,
            $this->repositoryMock,
            $this->companyUnitAddressFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetBillingAddressByRestSplittableTotalsRequestTransfer(): void
    {
        $idCustomer = 1;
        $idCompanyUnitAddress = 'd73ec41e-2fc6-4b90-9632-823de9ba18c5';

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($idCustomer, $idCompanyUnitAddress)
            ->willReturn(true);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyBusinessUnitAddressByUuid')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getUuid() === $idCompanyUnitAddress;
                    }
                )
            )->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->addressMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUnitAddressTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->addressTransferMock);

        static::assertEquals(
            $this->addressTransferMock,
            $this->companyUnitAddressReader->getBillingAddressByRestSplittableTotalsRequestTransfer(
                $this->restSplittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetBillingAddressByRestSplittableTotalsRequestTransferWithoutCustomerId(): void
    {
        $idCustomer = null;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::never())
            ->method('getId');

        $this->repositoryMock->expects(static::never())
            ->method('existsCompanyUnitAddress');

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('findCompanyBusinessUnitAddressByUuid');

        $this->addressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer');

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getBillingAddressByRestSplittableTotalsRequestTransfer(
                $this->restSplittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetBillingAddressByRestSplittableTotalsRequestTransferWithNonExistingCompanyUnitAddress(): void
    {
        $idCustomer = 1;
        $idCompanyUnitAddress = 'd73ec41e-2fc6-4b90-9632-823de9ba18c5';

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($idCustomer, $idCompanyUnitAddress)
            ->willReturn(false);

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('findCompanyBusinessUnitAddressByUuid');

        $this->addressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer');

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getBillingAddressByRestSplittableTotalsRequestTransfer(
                $this->restSplittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetShippingAddressByRestSplittableTotalsRequestTransfer(): void
    {
        $idCustomer = 1;
        $idCompanyUnitAddress = 'd73ec41e-2fc6-4b90-9632-823de9ba18c5';

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($idCustomer, $idCompanyUnitAddress)
            ->willReturn(true);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyBusinessUnitAddressByUuid')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getUuid() === $idCompanyUnitAddress;
                    }
                )
            )->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->addressMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUnitAddressTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->addressTransferMock);

        static::assertEquals(
            $this->addressTransferMock,
            $this->companyUnitAddressReader->getShippingAddressByRestSplittableTotalsRequestTransfer(
                $this->restSplittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetShippingAddressByRestSplittableTotalsRequestTransferWithoutCustomerId(): void
    {
        $idCustomer = null;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::never())
            ->method('getId');

        $this->repositoryMock->expects(static::never())
            ->method('existsCompanyUnitAddress');

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('findCompanyBusinessUnitAddressByUuid');

        $this->addressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer');

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getShippingAddressByRestSplittableTotalsRequestTransfer(
                $this->restSplittableTotalsRequestTransferMock
            )
        );
    }
}
