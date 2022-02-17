<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConstants;
use FondOfOryx\Zed\ErpDeliveryNote\Dependency\ErpDeliveryNoteEvents;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainer;
use Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery;
use Orm\Zed\ErpDeliveryNote\Persistence\Map\FooErpDeliveryNoteTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;

class ErpDeliveryNoteEventResourceQueryContainerPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Event\ErpDeliveryNoteEventResourceQueryContainerPlugin
     */
    protected $erpDeliveryNoteEventResourceQueryContainerPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchQueryContainer
     */
    protected $erpDeliveryNotePageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    protected $erpDeliveryNoteQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterTransfer
     */
    protected $filterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpDeliveryNote\Persistence\FooErpDeliveryNoteQuery
     */
    protected $modelCriteriaMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpDeliveryNotePageSearchQueryContainerMock = $this->getMockBuilder(ErpDeliveryNotePageSearchQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteQueryMock = $this->getMockBuilder(FooErpDeliveryNoteQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteEventResourceQueryContainerPlugin = new ErpDeliveryNoteEventResourceQueryContainerPlugin();
        $this->erpDeliveryNoteEventResourceQueryContainerPlugin->setQueryContainer($this->erpDeliveryNotePageSearchQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertEquals(
            ErpDeliveryNotePageSearchConstants::ERP_DELIVERY_NOTE_RESOURCE_NAME,
            $this->erpDeliveryNoteEventResourceQueryContainerPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testGetEventName()
    {
        $this->assertEquals(
            ErpDeliveryNoteEvents::ERP_DELIVERY_NOTE_PUBLISH,
            $this->erpDeliveryNoteEventResourceQueryContainerPlugin->getEventName(),
        );
    }

    /**
     * @return void
     */
    public function testGetIdColumnName()
    {
        $this->assertEquals(
            FooErpDeliveryNoteTableMap::COL_ID_ERP_DELIVERY_NOTE,
            $this->erpDeliveryNoteEventResourceQueryContainerPlugin->getIdColumnName(),
        );
    }

    /**
     * @return void
     */
    public function testQueryData()
    {
        $erpOderIds = [1];

        $this->erpDeliveryNotePageSearchQueryContainerMock->expects(static::atLeastOnce())
            ->method('queryErpDeliveryNotesByErpDeliveryNoteIds')
            ->with($erpOderIds)
            ->willReturn($this->erpDeliveryNoteQueryMock);

        $modelCriteria = $this->erpDeliveryNoteEventResourceQueryContainerPlugin->queryData($erpOderIds);

        $this->assertInstanceOf(
            ModelCriteria::class,
            $modelCriteria,
        );
    }
}
