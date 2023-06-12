<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Communication\Plugin\PermissionExtension\SeeCompanyProductListsPermissionPlugin;
use FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCompanyTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class SearchProductListQueryExpanderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyUuidFilterInterface $companyUuidFilterMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyUserReaderInterface $companyUserReaderMock;

    /**
     * @var (\FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyProductListSearchRestApiToPermissionFacadeInterface|MockObject $permissionFacadeMock;

    /**
     * @var (\Generated\Shared\Transfer\QueryJoinCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander\SearchProductListQueryExpander
     */
    protected SearchProductListQueryExpander $searchProductListQueryExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUuidFilterMock = $this->getMockBuilder(CompanyUuidFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReaderMock = $this->getMockBuilder(CompanyUserReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeMock = $this->getMockBuilder(CompanyProductListSearchRestApiToPermissionFacadeInterface::class)
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
            $this->companyUuidFilterMock,
            $this->companyUserReaderMock,
            $this->permissionFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $companyUuid = 'a0fa77e5-ee27-4f70-84ee-d4b1dc51f758';
        $idCompanyUser = 3;

        $this->companyUuidFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($companyUuid);

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getIdByFilterFields')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(SeeCompanyProductListsPermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(true);

        $this->queryJoinCollectionTransferMock->expects(static::atLeastOnce())
            ->method('addQueryJoin')
            ->withConsecutive([
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                        && $queryJoinTransfer->getLeft() == [SpyProductListTableMap::COL_ID_PRODUCT_LIST]
                        && $queryJoinTransfer->getRight() == [SpyProductListCompanyTableMap::COL_FK_PRODUCT_LIST]
                ),
            ], [
                static::callback(
                    fn (
                        QueryJoinTransfer $queryJoinTransfer
                    ) => $queryJoinTransfer->getJoinType() === Criteria::INNER_JOIN
                        && $queryJoinTransfer->getLeft() == [SpyProductListCompanyTableMap::COL_FK_COMPANY]
                        && $queryJoinTransfer->getRight() == [SpyCompanyTableMap::COL_ID_COMPANY]
                        && $queryJoinTransfer->getWhereConditions()->count() === 1
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn() === SpyCompanyTableMap::COL_UUID
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison() === Criteria::EQUAL
                        && $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue() === $companyUuid
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
    public function testExpandWithoutCompanyUuid(): void
    {
        $this->companyUuidFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn(null);

        $this->companyUserReaderMock->expects(static::never())
            ->method('getIdByFilterFields');

        $this->permissionFacadeMock->expects(static::never())
            ->method('can');

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

    /**
     * @return void
     */
    public function testExpandWithoutPermission(): void
    {
        $companyUuid = 'a0fa77e5-ee27-4f70-84ee-d4b1dc51f758';
        $idCompanyUser = 3;

        $this->companyUuidFilterMock->expects(static::atLeastOnce())
            ->method('filter')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($companyUuid);

        $this->companyUserReaderMock->expects(static::atLeastOnce())
            ->method('getIdByFilterFields')
            ->with($this->filterFieldTransferMocks)
            ->willReturn($idCompanyUser);

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with(SeeCompanyProductListsPermissionPlugin::KEY, $idCompanyUser)
            ->willReturn(false);

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
