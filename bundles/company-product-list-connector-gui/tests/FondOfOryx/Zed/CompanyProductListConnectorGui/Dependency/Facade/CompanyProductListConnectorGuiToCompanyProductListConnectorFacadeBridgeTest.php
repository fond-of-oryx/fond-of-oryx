<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnector\Business\CompanyProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Facade\CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeBridge
     */
    protected $facadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new CompanyProductListConnectorGuiToCompanyProductListConnectorFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistCompanyProductListRelation(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistCompanyProductListRelation')
            ->with($this->companyProductListRelationTransferMock);

        $this->facadeBridge->persistCompanyProductListRelation(
            $this->companyProductListRelationTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testGetAssignedProductListIdsByIdCompany(): void
    {
        $idCompany = 1;
        $productListIds = [1, 2, 3, 4];

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getAssignedProductListIdsByIdCompany')
            ->with($idCompany)
            ->willReturn($productListIds);

        static::assertEquals(
            $productListIds,
            $this->facadeBridge->getAssignedProductListIdsByIdCompany(
                $idCompany,
            ),
        );
    }
}
