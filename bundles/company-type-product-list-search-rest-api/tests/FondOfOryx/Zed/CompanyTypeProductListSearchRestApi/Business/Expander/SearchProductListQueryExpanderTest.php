<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCustomerTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class SearchProductListQueryExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ForeignCustomerReferenceFilterInterface|MockObject $foreignCustomerReferenceFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected MockObject|IdCustomerFilterInterface $idCustomerFilterMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyTypeProductListSearchRestApiRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander
     */
    protected SearchProductListQueryExpander $searchProductListQueryExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->foreignCustomerReferenceFilterMock = $this->getMockBuilder(ForeignCustomerReferenceFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCustomerFilterMock = $this->getMockBuilder(IdCustomerFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyTypeProductListSearchRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryJoinCollectionTransferMock = $this->getMockBuilder(QueryJoinCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->searchProductListQueryExpander = new SearchProductListQueryExpander(
            $this->foreignCustomerReferenceFilterMock,
            $this->idCustomerFilterMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $self = $this;

        $idCustomer = 1;
        $customerReference = 'FOO--1';

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->foreignCustomerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('canSeeProductListsOfCustomer')
            ->with($idCustomer, $customerReference)
            ->willReturn(true);

        $callCount = $this->atLeastOnce();
        $this->queryJoinCollectionTransferMock->expects($callCount)
            ->method('addQueryJoin')
            ->willReturnCallback(static function (QueryJoinTransfer $queryJoinTransfer) use ($self, $callCount, $customerReference) {
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
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([SpyProductListTableMap::COL_ID_PRODUCT_LIST], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyProductListCustomerTableMap::COL_FK_PRODUCT_LIST], $queryJoinTransfer->getRight());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([SpyProductListCustomerTableMap::COL_FK_CUSTOMER], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCustomerTableMap::COL_ID_CUSTOMER], $queryJoinTransfer->getRight());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());
                        $self->assertSame(SpyCustomerTableMap::COL_CUSTOMER_REFERENCE, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn());
                        $self->assertSame(Criteria::EQUAL, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison());
                        $self->assertSame($customerReference, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue());

                        return $self->queryJoinCollectionTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->searchProductListQueryExpander->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutAccess(): void
    {
        $self = $this;

        $idCustomer = 1;
        $customerReference = 'FOO--1';

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->foreignCustomerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('canSeeProductListsOfCustomer')
            ->with($idCustomer, $customerReference)
            ->willReturn(false);

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
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([SpyProductListTableMap::COL_ID_PRODUCT_LIST], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyProductListCustomerTableMap::COL_FK_PRODUCT_LIST], $queryJoinTransfer->getRight());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([SpyProductListCustomerTableMap::COL_FK_CUSTOMER], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCustomerTableMap::COL_ID_CUSTOMER], $queryJoinTransfer->getRight());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());
                        $self->assertSame(SpyCustomerTableMap::COL_ID_CUSTOMER, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn());
                        $self->assertSame(Criteria::EQUAL, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison());
                        $self->assertSame('-1', $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue());

                        return $self->queryJoinCollectionTransferMock;
                }

                throw new Exception('Unexpected call count');
            });

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->searchProductListQueryExpander->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutForeignCustomerReference(): void
    {
        $idCustomer = 1;
        $customerReference = null;

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCustomer);

        $this->foreignCustomerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($customerReference);

        $this->repositoryMock->expects(static::never())
            ->method('canSeeProductListsOfCustomer');

        $this->queryJoinCollectionTransferMock->expects(static::never())
            ->method('addQueryJoin');

        static::assertEquals(
            $this->queryJoinCollectionTransferMock,
            $this->searchProductListQueryExpander->expand(
                $this->filterFieldTransferMocks,
                $this->queryJoinCollectionTransferMock,
            ),
        );
    }
}
