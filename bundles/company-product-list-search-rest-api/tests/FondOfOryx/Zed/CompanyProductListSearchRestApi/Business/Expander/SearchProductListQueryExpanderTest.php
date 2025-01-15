<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Expander;

use Codeception\Test\Unit;
use Exception;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Filter\CompanyUuidFilterInterface
     */
    protected MockObject|CompanyUuidFilterInterface $companyUuidFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected MockObject|CompanyUserReaderInterface $companyUserReaderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyProductListSearchRestApiToPermissionFacadeInterface|MockObject $permissionFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
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
        $self = $this;

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

        $callCount = $this->atLeastOnce();
        $this->queryJoinCollectionTransferMock->expects($callCount)
            ->method('addQueryJoin')
            ->willReturnCallback(static function (QueryJoinTransfer $queryJoinTransfer) use ($self, $callCount, $companyUuid) {
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
                        $self->assertEquals([SpyProductListCompanyTableMap::COL_FK_PRODUCT_LIST], $queryJoinTransfer->getRight());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([SpyProductListCompanyTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyTableMap::COL_ID_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());
                        $self->assertSame(SpyCompanyTableMap::COL_UUID, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn());
                        $self->assertSame(Criteria::EQUAL, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getComparison());
                        $self->assertSame($companyUuid, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getValue());

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
        $self = $this;

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
                        $self->assertEquals([SpyProductListCompanyTableMap::COL_FK_PRODUCT_LIST], $queryJoinTransfer->getRight());

                        return $self->queryJoinCollectionTransferMock;
                    case 2:
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertEquals([SpyProductListCompanyTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyTableMap::COL_ID_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertCount(1, $queryJoinTransfer->getWhereConditions());
                        $self->assertSame(SpyCompanyTableMap::COL_ID_COMPANY, $queryJoinTransfer->getWhereConditions()->offsetGet(0)->getColumn());
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
}
