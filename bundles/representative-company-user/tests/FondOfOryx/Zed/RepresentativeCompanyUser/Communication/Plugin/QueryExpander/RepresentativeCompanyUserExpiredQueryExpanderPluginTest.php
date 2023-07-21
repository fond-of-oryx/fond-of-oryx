<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\QueryExpander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery;
use Orm\Zed\RepresentativeCompanyUser\Persistence\Map\FooRepresentativeCompanyUserTableMap;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;

class RepresentativeCompanyUserExpiredQueryExpanderPluginTest extends Unit
{
    /**
     * @var \Orm\Zed\RepresentativeCompanyUser\Persistence\FooRepresentativeCompanyUserQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected FooRepresentativeCompanyUserQuery|MockObject $fooRepresentativeCompanyUserQuery;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserFilterTransfer|MockObject $representativeCompanyUserFilterTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Plugin\QueryExpander\RepresentativeCompanyUserExpiredQueryExpanderPlugin
     */
    protected RepresentativeCompanyUserExpiredQueryExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->fooRepresentativeCompanyUserQuery = $this->getMockBuilder(FooRepresentativeCompanyUserQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserFilterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new RepresentativeCompanyUserExpiredQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $self = $this;
        $this->representativeCompanyUserFilterTransferMock
            ->expects(static::atLeastOnce())
            ->method('getExpired')->willReturn(true);

        $this->fooRepresentativeCompanyUserQuery
            ->expects(static::atLeastOnce())
            ->method('filterByState')
            ->willReturnCallback(static function (string $state, string $criteria) use ($self) {
                $self->assertSame(Criteria::EQUAL, $criteria);
                $self->assertSame(FooRepresentativeCompanyUserTableMap::COL_STATE_EXPIRED, $state);

                return $self->fooRepresentativeCompanyUserQuery;
            });

        $this->plugin->expand($this->fooRepresentativeCompanyUserQuery, $this->representativeCompanyUserFilterTransferMock);
    }
}
