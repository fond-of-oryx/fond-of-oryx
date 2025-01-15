<?php

namespace FondOfOryx\Zed\CompanyUserOrderBudgetSearchRestApi\Communication\Plugin\OrderBudgetSearchRestApiExtension;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\CompanyUserOrderBudgetSearchRestApi\CompanyUserOrderBudgetSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\OrderBudget\Persistence\Map\FooOrderBudgetTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class CustomerSearchOrderBudgetQueryExpanderPluginTest extends Unit
{
    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserOrderBudgetSearchRestApi\Communication\Plugin\OrderBudgetSearchRestApiExtension\CustomerSearchOrderBudgetQueryExpanderPlugin
     */
    protected CustomerSearchOrderBudgetQueryExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerSearchOrderBudgetQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testIsApplicable(): void
    {
        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        static::assertTrue($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithInvalidFilterFieldTypes(): void
    {
        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE);

        static::assertFalse($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $self = $this;

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('idCustomer');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn(1);

        $callCount = $this->atLeastOnce();
        $this->queryJoinCollectionTransferMock->expects($callCount)
            ->method('addQueryJoin')
            ->willReturnCallback(static function (QueryJoinTransfer $queryJoinTransfer) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertEquals([FooOrderBudgetTableMap::COL_ID_ORDER_BUDGET], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyBusinessUnitTableMap::COL_FK_ORDER_BUDGET], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertEquals([SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
