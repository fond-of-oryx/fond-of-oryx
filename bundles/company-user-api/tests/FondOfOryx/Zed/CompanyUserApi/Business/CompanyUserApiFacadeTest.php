<?php

namespace FondOfOryx\Zed\CompanyUserApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApi;
use FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUserApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserApi\Business\Model\Validator\CompanyUserApiValidator
     */
    protected $companyUserApiValidatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiBusinessFactory
     */
    protected $companyUserApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserApi\Business\Model\CompanyUserApi
     */
    protected $companyUserApiMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserApiBusinessFactoryMock = $this->getMockBuilder(CompanyUserApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiMock = $this->getMockBuilder(CompanyUserApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
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

        $this->companyUserApiValidatorMock = $this->getMockBuilder(CompanyUserApiValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyUserApiFacade();
        $this->facade->setFactory($this->companyUserApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddCompanyUser(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects(static::atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->addCompanyUser($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetCompanyUser(): void
    {
        $idCompanyUser = 1;

        $this->companyUserApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->getCompanyUser($idCompanyUser),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompanyUser(): void
    {
        $idCompanyUser = 1;

        $this->companyUserApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($idCompanyUser, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->updateCompanyUser($idCompanyUser, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemoveUpdate(): void
    {
        $idCompanyUser = 1;

        $this->companyUserApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects(static::atLeastOnce())
            ->method('remove')
            ->with($idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->facade->removeCompanyUser($idCompanyUser));
    }

    /**
     * @return void
     */
    public function testFindCompanies(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserApi')
            ->willReturn($this->companyUserApiMock);

        $this->companyUserApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->facade->findCompanyUsers($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->companyUserApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserApiValidator')
            ->willReturn($this->companyUserApiValidatorMock);

        $this->companyUserApiValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        $this->assertIsArray($this->facade->validate($this->apiDataTransferMock));
    }
}
