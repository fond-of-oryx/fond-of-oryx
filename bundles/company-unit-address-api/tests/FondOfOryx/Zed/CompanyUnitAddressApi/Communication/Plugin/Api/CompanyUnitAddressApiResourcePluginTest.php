<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade;
use FondOfOryx\Zed\CompanyUnitAddressApi\CompanyUnitAddressApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyUnitAddressApiResourcePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Business\CompanyUnitAddressApiFacade
     */
    protected $companyUnitAddressApiFacadeMock;

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
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Communication\Plugin\Api\CompanyUnitAddressApiResourcePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApiFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiFacade::class)
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

        $this->plugin = new CompanyUnitAddressApiResourcePlugin();
        $this->plugin->setFacade($this->companyUnitAddressApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(
            CompanyUnitAddressApiConfig::RESOURCE_COMPANY_UNIT_ADDRESSES,
            $this->plugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects(static::atLeastOnce())
            ->method('addCompanyUnitAddress')
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
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressApiFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddress')
            ->with($idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->get($idCompanyUnitAddress),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateCompanyUnitAddress')
            ->with($idCompanyUnitAddress, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->update($idCompanyUnitAddress, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressApiFacadeMock->expects(static::atLeastOnce())
            ->method('removeCompanyUnitAddress')
            ->with($idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->plugin->remove($idCompanyUnitAddress),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyUnitAddressApiFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyUnitAddresses')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->plugin->find($this->apiRequestTransferMock),
        );
    }
}
