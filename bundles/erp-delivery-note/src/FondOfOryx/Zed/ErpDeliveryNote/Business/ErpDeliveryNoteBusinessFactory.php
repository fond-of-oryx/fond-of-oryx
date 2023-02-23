<?php

namespace FondOfOryx\Zed\ErpDeliveryNote\Business;

use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteAddressHandler;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteAddressHandlerInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteExpenseHandler;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteExpenseHandlerInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteItemHandler;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteItemHandlerInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteTrackingHandler;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteTrackingHandlerInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReader;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReader;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReader;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteReader;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReader;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriter;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriterInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriter;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriterInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriter;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriter;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteWriter;
use FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteWriterInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteExpensePluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteExpensePluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteTrackingPluginExecutor;
use FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteTrackingPluginExecutorInterface;
use FondOfOryx\Zed\ErpDeliveryNote\ErpDeliveryNoteDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * Class ErpDeliveryNoteBusinessFactory
 *
 * @package FondOfOryx\Zed\ErpDeliveryNote\Business
 *
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpDeliveryNote\Persistence\ErpDeliveryNoteRepositoryInterface getRepository()()
 */
class ErpDeliveryNoteBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteWriterInterface
     */
    public function createErpDeliveryNoteWriter(): ErpDeliveryNoteWriterInterface
    {
        return new ErpDeliveryNoteWriter(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->createErpDeliveryNotePluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteAddressWriterInterface
     */
    public function createErpDeliveryNoteAddressWriter(): ErpDeliveryNoteAddressWriterInterface
    {
        return new ErpDeliveryNoteAddressWriter(
            $this->getEntityManager(),
            $this->createErpDeliveryNoteAddressPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteItemWriterInterface
     */
    public function createErpDeliveryNoteItemWriter(): ErpDeliveryNoteItemWriterInterface
    {
        return new ErpDeliveryNoteItemWriter(
            $this->getEntityManager(),
            $this->createErpDeliveryNoteItemPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteExpenseWriterInterface
     */
    public function createErpDeliveryNoteExpenseWriter(): ErpDeliveryNoteExpenseWriterInterface
    {
        return new ErpDeliveryNoteExpenseWriter(
            $this->getEntityManager(),
            $this->createErpDeliveryNoteExpensePluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Writer\ErpDeliveryNoteTrackingWriterInterface
     */
    public function createErpDeliveryNoteTrackingWriter(): ErpDeliveryNoteTrackingWriterInterface
    {
        return new ErpDeliveryNoteTrackingWriter(
            $this->getEntityManager(),
            $this->createErpDeliveryNoteTrackingPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteTrackingReaderInterface
     */
    public function createErpDeliveryNoteTrackingReader(): ErpDeliveryNoteTrackingReaderInterface
    {
        return new ErpDeliveryNoteTrackingReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteAddressHandlerInterface
     */
    public function createErpDeliveryNoteAddressHandler(): ErpDeliveryNoteAddressHandlerInterface
    {
        return new ErpDeliveryNoteAddressHandler(
            $this->createErpDeliveryNoteAddressWriter(),
            $this->createErpDeliveryNoteAddressReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteItemHandlerInterface
     */
    public function createErpDeliveryNoteItemHandler(): ErpDeliveryNoteItemHandlerInterface
    {
        return new ErpDeliveryNoteItemHandler(
            $this->createErpDeliveryNoteItemWriter(),
            $this->createErpDeliveryNoteItemReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteExpenseHandlerInterface
     */
    public function createErpDeliveryNoteExpenseHandler(): ErpDeliveryNoteExpenseHandlerInterface
    {
        return new ErpDeliveryNoteExpenseHandler(
            $this->createErpDeliveryNoteExpenseWriter(),
            $this->createErpDeliveryNoteExpenseReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Handler\ErpDeliveryNoteTrackingHandlerInterface
     */
    public function createErpDeliveryNoteTrackingHandler(): ErpDeliveryNoteTrackingHandlerInterface
    {
        return new ErpDeliveryNoteTrackingHandler(
            $this->createErpDeliveryNoteTrackingWriter(),
            $this->createErpDeliveryNoteTrackingReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteReaderInterface
     */
    public function createErpDeliveryNoteReader(): ErpDeliveryNoteReaderInterface
    {
        return new ErpDeliveryNoteReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteItemReaderInterface
     */
    public function createErpDeliveryNoteItemReader(): ErpDeliveryNoteItemReaderInterface
    {
        return new ErpDeliveryNoteItemReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteExpenseReaderInterface
     */
    public function createErpDeliveryNoteExpenseReader(): ErpDeliveryNoteExpenseReaderInterface
    {
        return new ErpDeliveryNoteExpenseReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\Model\Reader\ErpDeliveryNoteAddressReaderInterface
     */
    public function createErpDeliveryNoteAddressReader(): ErpDeliveryNoteAddressReaderInterface
    {
        return new ErpDeliveryNoteAddressReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNotePluginExecutorInterface
     */
    protected function createErpDeliveryNotePluginExecutor(): ErpDeliveryNotePluginExecutorInterface
    {
        return new ErpDeliveryNotePluginExecutor(
            $this->getErpDeliveryNotePreSavePlugin(),
            $this->getErpDeliveryNotePostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteItemPluginExecutorInterface
     */
    protected function createErpDeliveryNoteItemPluginExecutor(): ErpDeliveryNoteItemPluginExecutorInterface
    {
        return new ErpDeliveryNoteItemPluginExecutor(
            $this->getErpDeliveryNoteItemPreSavePlugin(),
            $this->getErpDeliveryNoteItemPostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteExpensePluginExecutorInterface
     */
    protected function createErpDeliveryNoteExpensePluginExecutor(): ErpDeliveryNoteExpensePluginExecutorInterface
    {
        return new ErpDeliveryNoteExpensePluginExecutor(
            $this->getErpDeliveryNoteExpensePreSavePlugin(),
            $this->getErpDeliveryNoteExpensePostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteTrackingPluginExecutorInterface
     */
    protected function createErpDeliveryNoteTrackingPluginExecutor(): ErpDeliveryNoteTrackingPluginExecutorInterface
    {
        return new ErpDeliveryNoteTrackingPluginExecutor(
            $this->getErpDeliveryNoteTrackingPreSavePlugin(),
            $this->getErpDeliveryNoteTrackingPostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpDeliveryNote\Business\PluginExecutor\ErpDeliveryNoteAddressPluginExecutorInterface
     */
    protected function createErpDeliveryNoteAddressPluginExecutor(): ErpDeliveryNoteAddressPluginExecutorInterface
    {
        return new ErpDeliveryNoteAddressPluginExecutor(
            $this->getErpDeliveryNoteAddressPreSavePlugin(),
            $this->getErpDeliveryNoteAddressPostSavePlugin(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePreSavePluginInterface>
     */
    public function getErpDeliveryNotePreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNotePostSavePluginInterface>
     */
    public function getErpDeliveryNotePostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPreSavePluginInterface>
     */
    public function getErpDeliveryNoteItemPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_ITEM_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteItemPostSavePluginInterface>
     */
    public function getErpDeliveryNoteItemPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_ITEM_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePreSavePluginInterface>
     */
    public function getErpDeliveryNoteExpensePreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteExpensePostSavePluginInterface>
     */
    public function getErpDeliveryNoteExpensePostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_EXPENSE_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPreSavePluginInterface>
     */
    public function getErpDeliveryNoteTrackingPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_TRACKING_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteTrackingPostSavePluginInterface>
     */
    public function getErpDeliveryNoteTrackingPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_TRACKING_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPreSavePluginInterface>
     */
    public function getErpDeliveryNoteAddressPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpDeliveryNoteExtension\Dependency\Plugin\ErpDeliveryNoteAddressPostSavePluginInterface>
     */
    public function getErpDeliveryNoteAddressPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpDeliveryNoteDependencyProvider::PLUGIN_ERP_DELIVERY_NOTE_ADDRESS_POST_SAVE)->getArrayCopy();
    }
}
