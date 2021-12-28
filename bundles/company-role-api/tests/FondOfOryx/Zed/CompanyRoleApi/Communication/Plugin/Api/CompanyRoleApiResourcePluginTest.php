<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyRoleApi\Business\CompanyRoleApiFacade;
use FondOfOryx\Zed\CompanyRoleApi\CompanyRoleApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyRoleApiResourcePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\Business\CompanyRoleApiFacade
     */
    protected $companyRoleApiFacadeMock;

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
     * @var \FondOfOryx\Zed\CompanyRoleApi\Communication\Plugin\Api\CompanyRoleApiResourcePlugin
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

        $this->companyRoleApiFacadeMock = $this->getMockBuilder(CompanyRoleApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyRoleApiResourcePlugin();

        $this->plugin->setFacade($this->companyRoleApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            CompanyRoleApiConfig::RESOURCE_COMPANY_ROLES,
            $this->plugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        try {
            $this->plugin->add($this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idCompanyRole = 1;

        $this->companyRoleApiFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyRole')
            ->with($idCompanyRole)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->get($idCompanyRole),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idCompanyRole = 1;

        try {
            $this->plugin->update($idCompanyRole, $this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $idCompanyRole = 1;

        try {
            $this->plugin->remove($idCompanyRole);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyRoleApiFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyRoles')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->plugin->find($this->apiRequestTransferMock),
        );
    }
}
