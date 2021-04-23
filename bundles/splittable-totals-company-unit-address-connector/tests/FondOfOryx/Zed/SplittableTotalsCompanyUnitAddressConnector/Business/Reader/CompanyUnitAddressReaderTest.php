<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence\SplittableTotalsCompanyUnitAddressConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

class CompanyUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressMapperMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence\SplittableTotalsCompanyUnitAddressConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade\SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReader
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

        $this->repositoryMock = $this->getMockBuilder(SplittableTotalsCompanyUnitAddressConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsRequestTransferMock = $this->getMockBuilder(SplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
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
    public function testGetBillingAddressBySplittableTotalsRequestTransfer(): void
    {
        $idCustomer = 1;
        $idCompanyUnitAddress = 1;

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdBillingAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($idCustomer, $idCompanyUnitAddress)
            ->willReturn(true);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    }
                )
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->addressMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUnitAddressTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->addressTransferMock);

        static::assertEquals(
            $this->addressTransferMock,
            $this->companyUnitAddressReader->getBillingAddressBySplittableTotalsRequestTransfer(
                $this->splittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetBillingAddressBySplittableTotalsRequestTransferWithoutCustomerId(): void
    {
        $idCustomer = null;
        $idCompanyUnitAddress = 1;

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdBillingAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::never())
            ->method('existsCompanyUnitAddress');

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('getCompanyUnitAddressById');

        $this->addressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer');

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getBillingAddressBySplittableTotalsRequestTransfer(
                $this->splittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetBillingAddressBySplittableTotalsRequestTransferWithNonExistingCompanyUnitAddress(): void
    {
        $idCustomer = 1;
        $idCompanyUnitAddress = 1;

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdBillingAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($idCustomer, $idCompanyUnitAddress)
            ->willReturn(false);

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('getCompanyUnitAddressById');

        $this->addressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer');

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getBillingAddressBySplittableTotalsRequestTransfer(
                $this->splittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetShippingAddressBySplittableTotalsRequestTransfer(): void
    {
        $idCustomer = 1;
        $idCompanyUnitAddress = 1;

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdShippingAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($idCustomer, $idCompanyUnitAddress)
            ->willReturn(true);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    }
                )
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->addressMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUnitAddressTransfer')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->addressTransferMock);

        static::assertEquals(
            $this->addressTransferMock,
            $this->companyUnitAddressReader->getShippingAddressBySplittableTotalsRequestTransfer(
                $this->splittableTotalsRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetShippingAddressBySplittableTotalsRequestTransferWithoutCustomerId(): void
    {
        $idCustomer = null;
        $idCompanyUnitAddress = 1;

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->splittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getIdShippingAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::never())
            ->method('existsCompanyUnitAddress');

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('getCompanyUnitAddressById');

        $this->addressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer');

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getShippingAddressBySplittableTotalsRequestTransfer(
                $this->splittableTotalsRequestTransferMock
            )
        );
    }
}
