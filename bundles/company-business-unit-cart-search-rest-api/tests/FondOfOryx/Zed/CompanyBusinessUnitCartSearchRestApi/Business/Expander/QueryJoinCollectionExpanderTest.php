<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReaderInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class QueryJoinCollectionExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitReaderMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\QueryJoinCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander\QueryJoinCollectionExpander
     */
    protected $queryJoinCollectionExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitReaderMock = $this->getMockBuilder(CompanyBusinessUnitReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionExpander = new QueryJoinCollectionExpander(
            $this->companyBusinessUnitReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $self = $this;

        $idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getIdByFilterFields')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCompanyBusinessUnit);

        $callCount = $this->atLeastOnce();
        $this->queryJoinCollectionTransferMock->expects($callCount)
            ->method('addQueryJoin')
            ->willReturnCallback(static function (QueryJoinTransfer $queryJoinTransfer) use ($self, $callCount, $idCompanyBusinessUnit) {
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
                        $self->assertEquals([SpyQuoteTableMap::COL_COMPANY_USER_REFERENCE], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyUserTableMap::COL_COMPANY_USER_REFERENCE], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertEquals([SpyCompanyUserTableMap::COL_FK_CUSTOMER], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCustomerTableMap::COL_ID_CUSTOMER], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 3:
                        $self->assertEquals([SpyCompanyUserTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());
                        $self->assertSame((string)$idCompanyBusinessUnit, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue());

                        return $self->queryJoinCollectionTransferMock;
                    case 4:
                        $self->assertEquals([SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyTableMap::COL_ID_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->queryJoinCollectionExpander->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNullableIdCompanyBusinessUnit(): void
    {
        $self = $this;

        $this->companyBusinessUnitReaderMock->expects(static::atLeastOnce())
            ->method('getIdByFilterFields')
            ->with($this->filterFieldTransferMocks)
            ->willReturn(null);

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
                        $self->assertEquals([SpyQuoteTableMap::COL_COMPANY_USER_REFERENCE], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyUserTableMap::COL_COMPANY_USER_REFERENCE], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertEquals([SpyCompanyUserTableMap::COL_FK_CUSTOMER], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCustomerTableMap::COL_ID_CUSTOMER], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 3:
                        $self->assertEquals([SpyCompanyUserTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());
                        $self->assertSame('-1', $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue());

                        return $self->queryJoinCollectionTransferMock;
                    case 4:
                        $self->assertEquals([SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyTableMap::COL_ID_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->queryJoinCollectionExpander->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
