<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\Propel\Mapper\ErpDeliveryNotePageSearchMapperInterface;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearchQuery;
use Spryker\Zed\Kernel\Container;

class ErpDeliveryNotePageSearchPersistenceFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchPersistenceFactory;
     */
    protected $erpDeliveryNotePageSearchPersistenceFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNotePageSearch\Persistence\FooErpDeliveryNotePageSearchQuery
     */
    protected $erpDeliveryNoteQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    protected $fooErpDeliveryNotePageSearchQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooErpDeliveryNotePageSearchQueryMock = $this->getMockBuilder(FooErpDeliveryNotePageSearchQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteQueryMock = $this->getMockBuilder(FooErpDeliveryNoteQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchPersistenceFactory = new ErpDeliveryNotePageSearchPersistenceFactory();
        $this->erpDeliveryNotePageSearchPersistenceFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateErpDeliveryNotePageSearchMapper()
    {
        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchMapperInterface::class,
            $this->erpDeliveryNotePageSearchPersistenceFactory->createErpDeliveryNotePageSearchMapper(),
        );
    }

    /**
     * @return void
     */
    public function testGetErpDeliveryNotePageSearchQuery()
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE_PAGE_SEARCH)
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE_PAGE_SEARCH:
                        return $self->fooErpDeliveryNotePageSearchQueryMock;
                }

                throw new Exception('Unexpected call');
            });

        $this->assertInstanceOf(
            FooErpDeliveryNotePageSearchQuery::class,
            $this->erpDeliveryNotePageSearchPersistenceFactory->getErpDeliveryNotePageSearchQuery(),
        );
    }

    /**
     * @return void
     */
    public function testGetErpDeliveryNoteQuery()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::QUERY_ERP_DELIVERY_NOTE)
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $this->assertInstanceOf(
            FooErpDeliveryNoteQuery::class,
            $this->erpDeliveryNotePageSearchPersistenceFactory->getErpDeliveryNoteQuery(),
        );
    }
}
