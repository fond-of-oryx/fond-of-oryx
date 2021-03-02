<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use FondOfOryx\Zed\ErpOrder\Dependency\ErpOrderEvents;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainer;
use Orm\Zed\ErpOrder\Persistence\ErpOrderQuery;
use Orm\Zed\ErpOrder\Persistence\Map\ErpOrderTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;

class ErpOrderEventResourceQueryContainerPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Event\ErpOrderEventResourceQueryContainerPlugin
     */
    protected $erpOrderEventResourceQueryContainerPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchQueryContainer
     */
    protected $erpOrderPageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    protected $erpOrderQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterTransfer
     */
    protected $filterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpOrder\Persistence\ErpOrderQuery
     */
    protected $modelCriteriaMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpOrderPageSearchQueryContainerMock = $this->getMockBuilder(ErpOrderPageSearchQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderQueryMock = $this->getMockBuilder(ErpOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderEventResourceQueryContainerPlugin = new ErpOrderEventResourceQueryContainerPlugin();
        $this->erpOrderEventResourceQueryContainerPlugin->setQueryContainer($this->erpOrderPageSearchQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertEquals(
            ErpOrderPageSearchConstants::ERP_ORDER_RESOURCE_NAME,
            $this->erpOrderEventResourceQueryContainerPlugin->getResourceName()
        );
    }

    /**
     * @return void
     */
    public function testGetEventName()
    {
        $this->assertEquals(
            ErpOrderEvents::ERP_ORDER_PUBLISH,
            $this->erpOrderEventResourceQueryContainerPlugin->getEventName()
        );
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testGetIdColumnName()
    {
        $this->assertEquals(
            ErpOrderTableMap::COL_ID_ERP_ORDER,
            $this->erpOrderEventResourceQueryContainerPlugin->getIdColumnName()
        );
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testQueryData()
    {
        $erpOderIds = [1];

        $this->erpOrderPageSearchQueryContainerMock->expects(static::atLeastOnce())
            ->method('queryErpOrdersByErpOrderIds')
            ->with($erpOderIds)
            ->willReturn($this->erpOrderQueryMock);

        $modelCriteria = $this->erpOrderEventResourceQueryContainerPlugin->queryData($erpOderIds);

        $this->assertEquals($this->modelCriteriaMock, $modelCriteria);

        $this->assertInstanceOf(
            ModelCriteria::class,
            $modelCriteria
        );
    }
}
