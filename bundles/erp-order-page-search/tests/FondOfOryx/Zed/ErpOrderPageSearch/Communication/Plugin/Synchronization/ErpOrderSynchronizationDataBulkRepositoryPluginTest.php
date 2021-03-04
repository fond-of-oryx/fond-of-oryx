<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Synchronization;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig;
use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepository;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\FooErpOrderPageSearchEntityTransfer;

class ErpOrderSynchronizationDataBulkRepositoryPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Communication\Plugin\Synchronization\ErpOrderSynchronizationDataBulkRepositoryPlugin
     */
    protected $erpOrderSynchronizationDataBulkRepositoryPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterTransfer
     */
    protected $filterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FooErpOrderPageSearchEntityTransfer
     */
    protected $fooErpOrderPageSearchEntityTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchRepository
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpOrderPageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpOrderPageSearchRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(FilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooErpOrderPageSearchEntityTransferMock = $this->getMockBuilder(FooErpOrderPageSearchEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderSynchronizationDataBulkRepositoryPlugin = new ErpOrderSynchronizationDataBulkRepositoryPlugin();
        $this->erpOrderSynchronizationDataBulkRepositoryPlugin->setRepository($this->repositoryMock);
        $this->erpOrderSynchronizationDataBulkRepositoryPlugin->setConfig($this->configMock);
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testGetData(): void
    {
        $offset = 1;
        $limit = 1;
        $ids = [1];

        $fooErpOrderPageSearchEntityTransfers = [
            '0' => $this->fooErpOrderPageSearchEntityTransferMock,
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findFilteredErpOrderPageSearchEntities')
            ->willReturn($fooErpOrderPageSearchEntityTransfers);

        $this->fooErpOrderPageSearchEntityTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn('data');

        $this->fooErpOrderPageSearchEntityTransferMock->expects(static::atLeastOnce())
            ->method('getKey')
            ->willReturn('key');

        $data = $this->erpOrderSynchronizationDataBulkRepositoryPlugin->getData($offset, $limit, $ids);

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    /**
     * @return void
     */
    public function testGetResourceName()
    {
        $this->assertEquals(
            ErpOrderPageSearchConstants::ERP_ORDER_RESOURCE_NAME,
            $this->erpOrderSynchronizationDataBulkRepositoryPlugin->getResourceName()
        );
    }

    /**
     * @return void
     */
    public function testHasStore()
    {
        $this->assertFalse($this->erpOrderSynchronizationDataBulkRepositoryPlugin->hasStore());
    }

    /**
     * @return void
     */
    public function testGetParams()
    {
        $this->assertIsArray($this->erpOrderSynchronizationDataBulkRepositoryPlugin->getParams());
        $this->assertNotEmpty($this->erpOrderSynchronizationDataBulkRepositoryPlugin->getParams());
    }

    /**
     * @return void
     */
    public function testGetQueueName()
    {
        $this->assertEquals(
            ErpOrderPageSearchConstants::ERP_ORDER_SYNC_SEARCH_QUEUE,
            $this->erpOrderSynchronizationDataBulkRepositoryPlugin->getQueueName()
        );
    }

    /**
     * @return void
     */
    public function testGetSynchronizationQueuePoolName()
    {
        $synchronizationPoolName = 'synchronizationPoolName';
        $this->configMock->expects(static::atLeastOnce())
            ->method('getErpOrderPageSynchronizationPoolName')
            ->willReturn($synchronizationPoolName);

        $this->assertIsString($this->erpOrderSynchronizationDataBulkRepositoryPlugin->getSynchronizationQueuePoolName());
        $this->assertEquals(
            $synchronizationPoolName,
            $this->erpOrderSynchronizationDataBulkRepositoryPlugin->getSynchronizationQueuePoolName()
        );
    }
}
