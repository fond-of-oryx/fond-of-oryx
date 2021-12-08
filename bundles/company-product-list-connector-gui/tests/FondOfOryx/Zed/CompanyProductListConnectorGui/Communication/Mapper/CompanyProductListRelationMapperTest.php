<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer;

class CompanyProductListRelationMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyProductListConnectorFormTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListConnectorFormTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Mapper\CompanyProductListRelationMapper
     */
    protected $mapper;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyProductListConnectorFormTransferMock = $this->getMockBuilder(CompanyProductListConnectorFormTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new CompanyProductListRelationMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyProductListConnectorGui(): void
    {
        $productListIdsToAssigned = [1];
        $productListIdsToDeAssigned = [3];
        $assignedProductListIds = [2, 3, 4];
        $idCompany = 1;

        $this->companyProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIdsToAssign')
            ->willReturn($productListIdsToAssigned);

        $this->companyProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getProductListIdsToDeAssign')
            ->willReturn($productListIdsToDeAssigned);

        $this->companyProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getAssignedProductListIds')
            ->willReturn($assignedProductListIds);

        $this->companyProductListConnectorFormTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $companyProductListRelationTransfer = $this->mapper->fromCompanyProductListConnectorGui(
            $this->companyProductListConnectorFormTransferMock,
        );

        static::assertEquals($idCompany, $companyProductListRelationTransfer->getIdCompany());
        static::assertEquals([1, 2, 4], $companyProductListRelationTransfer->getProductListIds());
    }
}
