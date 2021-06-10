<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestAddressTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class CompanyUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressMapperMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Dependency\Facade\SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

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
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReader
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

        $this->repositoryMock = $this->getMockBuilder(SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
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
    public function testGetBillingAddressByRestSplittableCheckoutRequestTransfer(): void
    {
        $customerReference = 'FOO-1';
        $idCompanyUnitAddress = 'd73ec41e-2fc6-4b90-9632-823de9ba18c5';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($customerReference, $idCompanyUnitAddress)
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
            $this->companyUnitAddressReader->getBillingAddressByRestSplittableCheckoutRequestTransfer(
                $this->restSplittableCheckoutRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetBillingAddressByRestSplittableCheckoutRequestTransferWithoutCustomerId(): void
    {
        $customerReference = null;

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
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
            $this->companyUnitAddressReader->getBillingAddressByRestSplittableCheckoutRequestTransfer(
                $this->restSplittableCheckoutRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetBillingAddressByRestSplittableCheckoutRequestTransferWithNonExistingCompanyUnitAddress(): void
    {
        $customerReference = 1;
        $idCompanyUnitAddress = 'd73ec41e-2fc6-4b90-9632-823de9ba18c5';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($customerReference, $idCompanyUnitAddress)
            ->willReturn(false);

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('findCompanyBusinessUnitAddressByUuid');

        $this->addressMapperMock->expects(static::never())
            ->method('fromCompanyUnitAddressTransfer');

        static::assertEquals(
            null,
            $this->companyUnitAddressReader->getBillingAddressByRestSplittableCheckoutRequestTransfer(
                $this->restSplittableCheckoutRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetShippingAddressByRestSplittableCheckoutRequestTransfer(): void
    {
        $customerReference = 'FOO-1';
        $idCompanyUnitAddress = 'd73ec41e-2fc6-4b90-9632-823de9ba18c5';

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->restAddressTransferMock);

        $this->restAddressTransferMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($idCompanyUnitAddress);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('existsCompanyUnitAddress')
            ->with($customerReference, $idCompanyUnitAddress)
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
            $this->companyUnitAddressReader->getShippingAddressByRestSplittableCheckoutRequestTransfer(
                $this->restSplittableCheckoutRequestTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetShippingAddressByRestSplittableCheckoutRequestTransferWithoutCustomerId(): void
    {
        $customerReference = null;

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
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
            $this->companyUnitAddressReader->getShippingAddressByRestSplittableCheckoutRequestTransfer(
                $this->restSplittableCheckoutRequestTransferMock
            )
        );
    }
}
