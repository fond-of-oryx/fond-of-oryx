<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Synchronization;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConstants;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepository;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\FooErpDeliveryNotePageSearchEntityTransfer;

class ErpDeliveryNoteSynchronizationDataBulkRepositoryPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\Synchronization\ErpDeliveryNoteSynchronizationDataBulkRepositoryPlugin
     */
    protected $erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterTransfer
     */
    protected $filterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FooErpDeliveryNotePageSearchEntityTransfer
     */
    protected $fooErpDeliveryNotePageSearchEntityTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchRepository
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpDeliveryNotePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpDeliveryNotePageSearchRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(FilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fooErpDeliveryNotePageSearchEntityTransferMock = $this->getMockBuilder(FooErpDeliveryNotePageSearchEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin = new ErpDeliveryNoteSynchronizationDataBulkRepositoryPlugin();
        $this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->setRepository($this->repositoryMock);
        $this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $offset = 1;
        $limit = 1;
        $ids = [1];

        $fooErpDeliveryNotePageSearchEntityTransfers = [
            '0' => $this->fooErpDeliveryNotePageSearchEntityTransferMock,
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findFilteredErpDeliveryNotePageSearchEntities')
            ->willReturn($fooErpDeliveryNotePageSearchEntityTransfers);

        $this->fooErpDeliveryNotePageSearchEntityTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn('data');

        $this->fooErpDeliveryNotePageSearchEntityTransferMock->expects(static::atLeastOnce())
            ->method('getKey')
            ->willReturn('key');

        $data = $this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->getData($offset, $limit, $ids);

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);
    }

    /**
     * @return void
     */
    public function testGetResourceName()
    {
        $this->assertEquals(
            ErpDeliveryNotePageSearchConstants::ERP_DELIVERY_NOTE_RESOURCE_NAME,
            $this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testHasStore()
    {
        $this->assertFalse($this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->hasStore());
    }

    /**
     * @return void
     */
    public function testGetParams()
    {
        $this->assertIsArray($this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->getParams());
        $this->assertNotEmpty($this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->getParams());
    }

    /**
     * @return void
     */
    public function testGetQueueName()
    {
        $this->assertEquals(
            ErpDeliveryNotePageSearchConstants::ERP_DELIVERY_NOTE_SYNC_SEARCH_QUEUE,
            $this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->getQueueName(),
        );
    }

    /**
     * @return void
     */
    public function testGetSynchronizationQueuePoolName()
    {
        $synchronizationPoolName = 'synchronizationPoolName';
        $this->configMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNotePageSynchronizationPoolName')
            ->willReturn($synchronizationPoolName);

        $this->assertIsString($this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->getSynchronizationQueuePoolName());
        $this->assertEquals(
            $synchronizationPoolName,
            $this->erpDeliveryNoteSynchronizationDataBulkRepositoryPlugin->getSynchronizationQueuePoolName(),
        );
    }
}
