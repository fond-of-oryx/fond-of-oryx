<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeBridge;
use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class CompanyBrandProductListConnectorToBrandCompanyFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandCompanyFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBrandRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBrandRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade\CompanyBrandProductListConnectorToBrandCompanyFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandCompanyFacadeMock = $this->getMockBuilder(BrandCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandRelationTransferMock = $this->getMockBuilder(CompanyBrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompanyBrandProductListConnectorToBrandCompanyFacadeBridge($this->brandCompanyFacadeMock);
    }

    /**
     * @return void
     */
    public function testSaveCompanyBrandRelation(): void
    {
        $this->brandCompanyFacadeMock->expects(static::atLeastOnce())
            ->method('saveCompanyBrandRelation')
            ->with($this->companyBrandRelationTransferMock)
            ->willReturn($this->companyBrandRelationTransferMock);

        static::assertEquals(
            $this->companyBrandRelationTransferMock,
            $this->bridge->saveCompanyBrandRelation($this->companyBrandRelationTransferMock),
        );
    }
}
