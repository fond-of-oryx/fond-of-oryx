<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\CartSearchRestApiExtension;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConstants;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\PermissionExtension\SearchCartPermissionPlugin;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepository;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToCompanyUserTableMap;
use Orm\Zed\CompanyRole\Persistence\Map\SpyCompanyRoleToPermissionTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\ActiveQuery\Criteria;

class CustomerSearchQuoteQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyBusinessUnitCartSearchRestApiRepository $repositoryMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\QueryJoinCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|QueryJoinCollectionTransfer $queryJoinCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Communication\Plugin\CartSearchRestApiExtension\CustomerSearchQuoteQueryExpanderPlugin
     */
    protected CustomerSearchQuoteQueryExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitCartSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

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

        $this->plugin = new CustomerSearchQuoteQueryExpanderPlugin();
        $this->plugin->setRepository($this->repositoryMock);
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
            ->willReturn(CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        static::assertTrue($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testIsApplicableWithInvalidFilterFieldTypes(): void
    {
        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID);

        static::assertFalse($this->plugin->isApplicable($this->filterFieldTransferMocks));
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $self = $this;

        $idPermission = 1;

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER);

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn(1);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdPermissionByKey')
            ->with(SearchCartPermissionPlugin::KEY)
            ->willReturn($idPermission);

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
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 4:
                        $self->assertEquals([SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyTableMap::COL_ID_COMPANY], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 5:
                        $self->assertEquals([SpyCompanyUserTableMap::COL_ID_COMPANY_USER], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_USER], $queryJoinTransfer->getRight());
                        $self->assertSame(Criteria::INNER_JOIN, $queryJoinTransfer->getJoinType());
                        $self->assertCount(0, $queryJoinTransfer->getWhereConditions());

                        return $self->queryJoinCollectionTransferMock;
                    case 6:
                        $self->assertEquals([SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_ROLE], $queryJoinTransfer->getLeft());
                        $self->assertEquals([SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE], $queryJoinTransfer->getRight());
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
