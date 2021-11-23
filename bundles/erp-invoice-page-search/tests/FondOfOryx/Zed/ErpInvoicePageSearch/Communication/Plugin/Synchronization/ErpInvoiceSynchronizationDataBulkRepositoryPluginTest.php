<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Synchronization;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ErpInvoicePageSearch\ErpInvoicePageSearchConstants;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;
use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchRepository;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\FooErpInvoicePageSearchEntityTransfer;

class ErpInvoiceSynchronizationDataBulkRepositoryPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\Synchronization\ErpInvoiceSynchronizationDataBulkRepositoryPlugin
     */
    protected $erpInvoiceSynchronizationDataBulkRepositoryPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterTransfer
     */
    protected $filterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FooErpInvoicePageSearchEntityTransfer
     */
    protected $fooErpInvoicePageSearchEntityTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchRepository
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpInvoicePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpInvoicePageSearchRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(FilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooErpInvoicePageSearchEntityTransferMock = $this->getMockBuilder(FooErpInvoicePageSearchEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceSynchronizationDataBulkRepositoryPlugin = new ErpInvoiceSynchronizationDataBulkRepositoryPlugin();
        $this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->setRepository($this->repositoryMock);
        $this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $offset = 1;
        $limit = 1;
        $ids = [1];

        $fooErpInvoicePageSearchEntityTransfers = [
            '0' => $this->fooErpInvoicePageSearchEntityTransferMock,
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findFilteredErpInvoicePageSearchEntities')
            ->willReturn($fooErpInvoicePageSearchEntityTransfers);

        $this->fooErpInvoicePageSearchEntityTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn('data');

        $this->fooErpInvoicePageSearchEntityTransferMock->expects(static::atLeastOnce())
            ->method('getKey')
            ->willReturn('key');

        $data = $this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->getData($offset, $limit, $ids);

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    /**
     * @return void
     */
    public function testGetResourceName()
    {
        $this->assertEquals(
            ErpInvoicePageSearchConstants::ERP_INVOICE_RESOURCE_NAME,
            $this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testHasStore()
    {
        $this->assertFalse($this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->hasStore());
    }

    /**
     * @return void
     */
    public function testGetParams()
    {
        $this->assertIsArray($this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->getParams());
        $this->assertNotEmpty($this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->getParams());
    }

    /**
     * @return void
     */
    public function testGetQueueName()
    {
        $this->assertEquals(
            ErpInvoicePageSearchConstants::ERP_INVOICE_SYNC_SEARCH_QUEUE,
            $this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->getQueueName(),
        );
    }

    /**
     * @return void
     */
    public function testGetSynchronizationQueuePoolName()
    {
        $synchronizationPoolName = 'synchronizationPoolName';
        $this->configMock->expects(static::atLeastOnce())
            ->method('getErpInvoicePageSynchronizationPoolName')
            ->willReturn($synchronizationPoolName);

        $this->assertIsString($this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->getSynchronizationQueuePoolName());
        $this->assertEquals(
            $synchronizationPoolName,
            $this->erpInvoiceSynchronizationDataBulkRepositoryPlugin->getSynchronizationQueuePoolName(),
        );
    }
}
