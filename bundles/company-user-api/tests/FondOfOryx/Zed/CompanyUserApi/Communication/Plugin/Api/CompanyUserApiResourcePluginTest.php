<?php

namespace FondOfOryx\Zed\CompanyUserApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiFacade;
use FondOfOryx\Zed\CompanyUserApi\CompanyUserApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUserApiResourcePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUserApi\Business\CompanyUserApiFacade
     */
    protected $companyUserApiFacadeMock;

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
     * @var \FondOfOryx\Zed\CompanyUserApi\Communication\Plugin\Api\CompanyUserApiResourcePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserApiFacadeMock = $this->getMockBuilder(CompanyUserApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserApiResourcePlugin();
        $this->plugin->setFacade($this->companyUserApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(CompanyUserApiConfig::RESOURCE_COMPANY_USERS, $this->plugin->getResourceName());
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->companyUserApiFacadeMock->expects(static::atLeastOnce())
            ->method('addCompanyUser')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->plugin->add($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idCompanyUser = 1;

        $this->companyUserApiFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->with($idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->plugin->get($idCompanyUser));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idCompanyUser = 1;

        $this->companyUserApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateCompanyUser')
            ->with($idCompanyUser, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->update($idCompanyUser, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $idCompanyUser = 1;

        $this->companyUserApiFacadeMock->expects(static::atLeastOnce())
            ->method('removeCompanyUser')
            ->with($idCompanyUser)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->plugin->remove($idCompanyUser));
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyUserApiFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyUsers')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals($this->apiCollectionTransferMock, $this->plugin->find($this->apiRequestTransferMock));
    }
}
