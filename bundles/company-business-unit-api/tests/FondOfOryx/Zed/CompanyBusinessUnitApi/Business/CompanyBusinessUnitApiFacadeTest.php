<?php

namespace FondOfOryx\Zed\CompanyApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyBusinessUnitApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi
     */
    protected $companyBusinessUnitApiMock;

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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\Validator\CompanyBusinessUnitApiValidator
     */
    protected $companyBusinessUnitApiValidatorMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyBusinessUnitApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApiMock = $this->getMockBuilder(CompanyBusinessUnitApi::class)
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

        $this->companyBusinessUnitApiValidatorMock = $this->getMockBuilder(CompanyBusinessUnitApiValidator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyBusinessUnitApiFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testAddCompany(): void
    {
        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('add')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->addCompanyBusinessUnit($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGetCompany(): void
    {
        $idCompany = 1;

        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('get')
            ->with($idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->getCompanyBusinessUnit($idCompany),
        );
    }

    /**
     * @return void
     */
    public function testUpdateCompany(): void
    {
        $idCompany = 1;

        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('update')
            ->with($idCompany, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->updateCompanyBusinessUnit($idCompany, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemoveUpdate(): void
    {
        $idCompany = 1;
        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('remove')
            ->with($idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->facade->removeCompanyBusinessUnit($idCompany),
        );
    }

    /**
     * @return void
     */
    public function testFindCompanies(): void
    {
        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApi')
            ->willReturn($this->companyBusinessUnitApiMock);

        $this->companyBusinessUnitApiMock->expects($this->atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->facade->findCompanyBusinessUnits($this->apiRequestTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $errors = [];

        $this->businessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBusinessUnitApiValidator')
            ->willReturn($this->companyBusinessUnitApiValidatorMock);

        $this->companyBusinessUnitApiValidatorMock->expects($this->atLeastOnce())
            ->method('validate')
            ->with($this->apiRequestTransferMock)
            ->willReturn($errors);

        static::assertEquals($errors, $this->facade->validate($this->apiRequestTransferMock));
    }
}
