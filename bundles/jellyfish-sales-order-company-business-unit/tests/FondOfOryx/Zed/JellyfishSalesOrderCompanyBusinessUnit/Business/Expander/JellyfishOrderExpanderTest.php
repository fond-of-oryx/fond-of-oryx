<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class JellyfishOrderExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Dependency\Facade\JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserReferenceFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderCompanyBusinessUnit\Business\Expander\JellyfishOrderExpander
     */
    protected $jellyfishOrderExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserReferenceFacadeMock = $this->getMockBuilder(
            JellyfishSalesOrderCompanyBusinessUnitToCompanyUserReferenceFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spySalesOrderMock = $this->getMockBuilder(SpySalesOrder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderExpander = new JellyfishOrderExpander(
            $this->companyUserReferenceFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idCompanyBusinessUnit = 1;
        $companyBusinessUnitUuid = 'b7c08ca5-24b7-4d37-98c9-95c8c862948e';
        $companyUserReference = 'FOO--CU-1';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->companyUserReferenceFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitByCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($companyBusinessUnitUuid);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyBusinessUnitUuid')
            ->with($companyBusinessUnitUuid)
            ->willReturn($this->jellyfishOrderTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($idCompanyBusinessUnit);

        $this->jellyfishOrderTransferMock->expects(static::atLeastOnce())
            ->method('setCompanyBusinessUnitId')
            ->with($idCompanyBusinessUnit)
            ->willReturn($this->jellyfishOrderTransferMock);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->jellyfishOrderExpander->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNullableCompanyUserReference(): void
    {
        $companyUserReference = null;

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->companyUserReferenceFacadeMock->expects(static::never())
            ->method('getCompanyBusinessUnitByCompanyUserReference');

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->jellyfishOrderExpander->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNonExistingCompanyBusinessUnit(): void
    {
        $companyUserReference = 'FOO--CU-1';

        $this->spySalesOrderMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn($companyUserReference);

        $this->companyUserReferenceFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitByCompanyUserReference')
            ->with($companyUserReference)
            ->willReturn(null);

        static::assertEquals(
            $this->jellyfishOrderTransferMock,
            $this->jellyfishOrderExpander->expand(
                $this->jellyfishOrderTransferMock,
                $this->spySalesOrderMock,
            ),
        );
    }
}
