<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUnitAddressApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiBusinessFactory
     */
    protected $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApiInterface
     */
    protected $companyUnitAddressApiMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\Validator\CompanyUnitAddressApiValidatorInterface
     */
    protected $companyUnitAddressApiValidatorMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(CompanyUnitAddressApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiMock = $this->getMockBuilder(CompanyUnitAddressApiInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiValidatorMock = $this->getMockBuilder(CompanyUnitAddressApiValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyUnitAddressApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddCompanyUnitAddress(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiMock);

        $this->companyUnitAddressApiMock->expects(static::atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->addCompanyUnitAddress(
                $this->apiDataTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddress(): void
    {
        $idCompanyUnitAddress = 1;

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiMock);

        $this->companyUnitAddressApiMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->getCompanyUnitAddress($idCompanyUnitAddress),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUnitAddress(): void
    {
        $idCompanyUnitAddress = 1;

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiMock);

        $this->companyUnitAddressApiMock->expects(static::atLeastOnce())
            ->method('update')
            ->with(
                $idCompanyUnitAddress,
                $this->apiDataTransferMock,
            )->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->updateCompanyUnitAddress(
                $idCompanyUnitAddress,
                $this->apiDataTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testRemoveCompanyUnitAddress(): void
    {
        $idCompanyUnitAddress = 1;

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiMock);

        $this->companyUnitAddressApiMock->expects(static::atLeastOnce())
            ->method('remove')
            ->with($idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->removeCompanyUnitAddress($idCompanyUnitAddress),
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyUnitAddress(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressApi')
            ->willReturn($this->companyUnitAddressApiMock);

        $this->companyUnitAddressApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->facade->findCompanyUnitAddresses($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = [];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUnitAddressApiValidator')
            ->willReturn($this->companyUnitAddressApiValidatorMock);

        $this->companyUnitAddressApiValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn($errors);

        static::assertEquals(
            $errors,
            $this->facade->validate(
                $this->apiDataTransferMock,
            ),
        );
    }
}
