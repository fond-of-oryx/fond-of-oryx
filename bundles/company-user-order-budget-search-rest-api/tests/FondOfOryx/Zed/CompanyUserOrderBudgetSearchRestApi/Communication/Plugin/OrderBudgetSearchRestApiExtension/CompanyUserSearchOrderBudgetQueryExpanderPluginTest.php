<?php

namespace FondOfOryx\Zed\CompanyUserOrderBudgetSearchRestApi\Communication\Plugin\OrderBudgetSearchRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyUserOrderBudgetSearchRestApi\CompanyUserOrderBudgetSearchRestApiConstants;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\OrderBudget\Persistence\Map\FooOrderBudgetTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class CompanyUserSearchOrderBudgetQueryExpanderPluginTest extends Unit
{
    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserOrderBudgetSearchRestApi\Communication\Plugin\OrderBudgetSearchRestApiExtension\CompanyUserSearchOrderBudgetQueryExpanderPlugin
     */
    protected CompanyUserSearchOrderBudgetQueryExpanderPlugin $plugin;

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
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUserSearchOrderBudgetQueryExpanderPlugin();
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

        $this->filterFieldTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE);

        static::assertTrue($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $companyUserReference = 'foo';
        $idCustomer = 1;

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($idCustomer);

        $this->filterFieldTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE);

        $this->filterFieldTransferMocks[2]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($companyUserReference);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->withConsecutive(
                [
                    static::callback(
                        static function (QueryJoinTransfer $queryJoinTransfer) {
                            return $queryJoinTransfer->getLeft() == [FooOrderBudgetTableMap::COL_ID_ORDER_BUDGET]
                                && $queryJoinTransfer->getRight() == [SpyCompanyBusinessUnitTableMap::COL_FK_ORDER_BUDGET]
                                && $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                                && $queryJoinTransfer->getWhereConditions()->count() === 0;
                        },
                    ),
                ],
                [
                    static::callback(
                        static function (QueryJoinTransfer $queryJoinTransfer) {
                            return $queryJoinTransfer->getLeft() == [SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT]
                                && $queryJoinTransfer->getRight() == [SpyCompanyUserTableMap::COL_FK_COMPANY_BUSINESS_UNIT]
                                && $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                                && $queryJoinTransfer->getWhereConditions()->count() === 1;
                        },
                    ),
                ],
                [
                    static::callback(
                        static function (QueryJoinTransfer $queryJoinTransfer) {
                            return $queryJoinTransfer->getLeft() == [SpyCompanyUserTableMap::COL_FK_CUSTOMER]
                                && $queryJoinTransfer->getRight() == [SpyCustomerTableMap::COL_ID_CUSTOMER]
                                && $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                                && $queryJoinTransfer->getWhereConditions()->count() === 1;
                        },
                    ),
                ],
            )->willReturn($this->queryJoinCollectionTransferMock);

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->plugin->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
