<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Expander;

use Codeception\Test\Unit;
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
     * @var (\FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\ForeignCustomerReferenceFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ForeignCustomerReferenceFilterInterface|MockObject $foreignCustomerReferenceFilterMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\Filter\IdCustomerFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|IdCustomerFilterInterface $idCustomerFilterMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Persistence\CompanyTypeProductListSearchRestApiRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyTypeProductListSearchRestApiRepositoryInterface|MockObject $repositoryMock;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
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

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->withConsecutive([
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                        && $queryJoinTransfer->getLeft() == [SpyProductListTableMap::COL_ID_PRODUCT_LIST]
                        && $queryJoinTransfer->getRight() == [SpyProductListCustomerTableMap::COL_FK_PRODUCT_LIST]
                ),
            ], [
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                        && $queryJoinTransfer->getLeft() == [SpyProductListCustomerTableMap::COL_FK_CUSTOMER]
                        && $queryJoinTransfer->getRight() == [SpyCustomerTableMap::COL_ID_CUSTOMER]
                        && $queryJoinTransfer->getWhereConditions()->count() === 1
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyCustomerTableMap::COL_CUSTOMER_REFERENCE
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::EQUAL
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $customerReference
                ),
            ])->willReturn($this->queryJoinCollectionTransferMock);

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

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->withConsecutive([
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                        && $queryJoinTransfer->getLeft() == [SpyProductListTableMap::COL_ID_PRODUCT_LIST]
                        && $queryJoinTransfer->getRight() == [SpyProductListCustomerTableMap::COL_FK_PRODUCT_LIST]
                ),
            ], [
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                        && $queryJoinTransfer->getLeft() == [SpyProductListCustomerTableMap::COL_FK_CUSTOMER]
                        && $queryJoinTransfer->getRight() == [SpyCustomerTableMap::COL_ID_CUSTOMER]
                        && $queryJoinTransfer->getWhereConditions()->count() === 1
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyCustomerTableMap::COL_ID_CUSTOMER
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::EQUAL
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === '-1'
                ),
            ])->willReturn($this->queryJoinCollectionTransferMock);

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
