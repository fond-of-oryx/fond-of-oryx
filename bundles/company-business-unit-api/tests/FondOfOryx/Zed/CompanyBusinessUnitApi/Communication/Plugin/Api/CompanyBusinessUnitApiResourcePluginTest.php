<?php

namespace FondOfOryx\Zed\CompanyApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api\CompanyBusinessUnitApiResourcePlugin;
use FondOfOryx\Zed\CompanyBusinessUnitApi\CompanyBusinessUnitApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyBusinessUnitApiResourcePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\Business\CompanyBusinessUnitApiFacade
     */
    protected $companyBusinessUnitApiFacadeMock;

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
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Communication\Plugin\Api\CompanyBusinessUnitApiResourcePlugin
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

        $this->companyBusinessUnitApiFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyBusinessUnitApiResourcePlugin();
        $this->plugin->setFacade($this->companyBusinessUnitApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            CompanyBusinessUnitApiConfig::RESOURCE_COMPANY_BUSINESS_UNITS,
            $this->plugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects(static::atLeastOnce())
            ->method('addCompanyBusinessUnit')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->add($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitApiFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->with($idCompanyBusinessUnit)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->get($idCompanyBusinessUnit),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateCompanyBusinessUnit')
            ->with($idCompanyBusinessUnit, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->update($idCompanyBusinessUnit, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitApiFacadeMock->expects(static::atLeastOnce())
            ->method('removeCompanyBusinessUnit')
            ->with($idCompanyBusinessUnit)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->remove($idCompanyBusinessUnit),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyBusinessUnitApiFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyBusinessUnits')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->plugin->find($this->apiRequestTransferMock),
        );
    }
}
