<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ErpInvoicePageSearch\ErpInvoicePageSearchConstants;
use FondOfOryx\Zed\ErpInvoice\Dependency\ErpInvoiceEvents;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainer;
use Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery;
use Orm\Zed\ErpInvoice\Persistence\Map\FooErpInvoiceTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;

class ErpInvoiceEventResourceQueryContainerPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Event\ErpInvoiceEventResourceQueryContainerPlugin
     */
    protected $erpInvoiceEventResourceQueryContainerPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchQueryContainer
     */
    protected $erpInvoicePageSearchQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    protected $erpInvoiceQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterTransfer
     */
    protected $filterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Orm\Zed\ErpInvoice\Persistence\FooErpInvoiceQuery
     */
    protected $modelCriteriaMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpInvoicePageSearchQueryContainerMock = $this->getMockBuilder(ErpInvoicePageSearchQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceQueryMock = $this->getMockBuilder(FooErpInvoiceQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->modelCriteriaMock = $this->getMockBuilder(ModelCriteria::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceEventResourceQueryContainerPlugin = new ErpInvoiceEventResourceQueryContainerPlugin();
        $this->erpInvoiceEventResourceQueryContainerPlugin->setQueryContainer($this->erpInvoicePageSearchQueryContainerMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        $this->assertEquals(
            ErpInvoicePageSearchConstants::ERP_INVOICE_RESOURCE_NAME,
            $this->erpInvoiceEventResourceQueryContainerPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testGetEventName()
    {
        $this->assertEquals(
            ErpInvoiceEvents::ERP_INVOICE_PUBLISH,
            $this->erpInvoiceEventResourceQueryContainerPlugin->getEventName(),
        );
    }

    /**
     * @return void
     */
    public function testGetIdColumnName()
    {
        $this->assertEquals(
            FooErpInvoiceTableMap::COL_ID_ERP_INVOICE,
            $this->erpInvoiceEventResourceQueryContainerPlugin->getIdColumnName(),
        );
    }

    /**
     * @return void
     */
    public function testQueryData()
    {
        $erpOderIds = [1];

        $this->erpInvoicePageSearchQueryContainerMock->expects(static::atLeastOnce())
            ->method('queryErpInvoicesByErpInvoiceIds')
            ->with($erpOderIds)
            ->willReturn($this->erpInvoiceQueryMock);

        $modelCriteria = $this->erpInvoiceEventResourceQueryContainerPlugin->queryData($erpOderIds);

        $this->assertInstanceOf(
            ModelCriteria::class,
            $modelCriteria,
        );
    }
}
