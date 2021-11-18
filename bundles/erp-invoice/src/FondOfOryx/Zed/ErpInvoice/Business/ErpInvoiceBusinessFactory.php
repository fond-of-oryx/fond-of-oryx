<?php

namespace FondOfOryx\Zed\ErpInvoice\Business;

use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAddressHandler;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAddressHandlerInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAmountHandler;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAmountHandlerInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemAmountHandler;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemAmountHandlerInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemHandler;
use FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemHandlerInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReader;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAmountReader;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAmountReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReader;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReader;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriter;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriterInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriter;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriter;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceWriter;
use FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceWriterInterface;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAddressPluginExecutor;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAmountPluginExecutor;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAmountPluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutor;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutor;
use FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface;
use FondOfOryx\Zed\ErpInvoice\ErpInvoiceDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * Class ErpInvoiceBusinessFactory
 *
 * @package FondOfOryx\Zed\ErpInvoice\Business
 *
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ErpInvoice\Persistence\ErpInvoiceRepositoryInterface getRepository()()
 */
class ErpInvoiceBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceWriterInterface
     */
    public function createErpInvoiceWriter(): ErpInvoiceWriterInterface
    {
        return new ErpInvoiceWriter(
            $this->getEntityManager(),
            $this->getRepository(),
            $this->createErpInvoicePluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAddressWriterInterface
     */
    public function createErpInvoiceAddressWriter(): ErpInvoiceAddressWriterInterface
    {
        return new ErpInvoiceAddressWriter(
            $this->getEntityManager(),
            $this->createErpInvoiceAddressPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceItemWriterInterface
     */
    public function createErpInvoiceItemWriter(): ErpInvoiceItemWriterInterface
    {
        return new ErpInvoiceItemWriter(
            $this->getEntityManager(),
            $this->createErpInvoiceItemPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Writer\ErpInvoiceAmountWriterInterface
     */
    public function createErpInvoiceAmountWriter(): ErpInvoiceAmountWriterInterface
    {
        return new ErpInvoiceAmountWriter(
            $this->getEntityManager(),
            $this->createErpInvoiceAmountPluginExecutor(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAmountReaderInterface
     */
    public function createErpInvoiceAmountReader(): ErpInvoiceAmountReaderInterface
    {
        return new ErpInvoiceAmountReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAddressHandlerInterface
     */
    public function createErpInvoiceAddressHandler(): ErpInvoiceAddressHandlerInterface
    {
        return new ErpInvoiceAddressHandler(
            $this->createErpInvoiceAddressWriter(),
            $this->createErpInvoiceAddressReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemHandlerInterface
     */
    public function createErpInvoiceItemHandler(): ErpInvoiceItemHandlerInterface
    {
        return new ErpInvoiceItemHandler(
            $this->createErpInvoiceItemWriter(),
            $this->createErpInvoiceItemReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceAmountHandlerInterface
     */
    public function createErpInvoiceAmountHandler(): ErpInvoiceAmountHandlerInterface
    {
        return new ErpInvoiceAmountHandler(
            $this->createErpInvoiceAmountWriter(),
            $this->createErpInvoiceReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Handler\ErpInvoiceItemAmountHandlerInterface
     */
    public function createErpInvoiceItemAmountHandler(): ErpInvoiceItemAmountHandlerInterface
    {
        return new ErpInvoiceItemAmountHandler(
            $this->createErpInvoiceAmountWriter(),
            $this->createErpInvoiceReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceReaderInterface
     */
    public function createErpInvoiceReader(): ErpInvoiceReaderInterface
    {
        return new ErpInvoiceReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceItemReaderInterface
     */
    public function createErpInvoiceItemReader(): ErpInvoiceItemReaderInterface
    {
        return new ErpInvoiceItemReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\Model\Reader\ErpInvoiceAddressReaderInterface
     */
    public function createErpInvoiceAddressReader(): ErpInvoiceAddressReaderInterface
    {
        return new ErpInvoiceAddressReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoicePluginExecutorInterface
     */
    protected function createErpInvoicePluginExecutor(): ErpInvoicePluginExecutorInterface
    {
        return new ErpInvoicePluginExecutor(
            $this->getErpInvoicePreSavePlugin(),
            $this->getErpInvoicePostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceItemPluginExecutorInterface
     */
    protected function createErpInvoiceItemPluginExecutor(): ErpInvoiceItemPluginExecutorInterface
    {
        return new ErpInvoiceItemPluginExecutor(
            $this->getErpInvoiceItemPreSavePlugin(),
            $this->getErpInvoiceItemPostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAmountPluginExecutorInterface
     */
    protected function createErpInvoiceAmountPluginExecutor(): ErpInvoiceAmountPluginExecutorInterface
    {
        return new ErpInvoiceAmountPluginExecutor(
            $this->getErpInvoiceAmountPreSavePlugin(),
            $this->getErpInvoiceAmountPostSavePlugin(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ErpInvoice\Business\PluginExecutor\ErpInvoiceAddressPluginExecutorInterface
     */
    protected function createErpInvoiceAddressPluginExecutor(): ErpInvoiceAddressPluginExecutorInterface
    {
        return new ErpInvoiceAddressPluginExecutor(
            $this->getErpInvoiceAddressPreSavePlugin(),
            $this->getErpInvoiceAddressPostSavePlugin(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePreSavePluginInterface>
     */
    public function getErpInvoicePreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoicePostSavePluginInterface>
     */
    public function getErpInvoicePostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPreSavePluginInterface>
     */
    public function getErpInvoiceItemPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_ITEM_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceItemPostSavePluginInterface>
     */
    public function getErpInvoiceItemPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_ITEM_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPreSavePluginInterface>
     */
    public function getErpInvoiceAddressPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_ADDRESS_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAddressPostSavePluginInterface>
     */
    public function getErpInvoiceAddressPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_ADDRESS_POST_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPreSavePluginInterface>
     */
    public function getErpInvoiceAmountPreSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_AMOUNT_PRE_SAVE)->getArrayCopy();
    }

    /**
     * @return array<\FondOfOryx\Zed\ErpInvoiceExtension\Dependency\Plugin\ErpInvoiceAmountPostSavePluginInterface>
     */
    public function getErpInvoiceAmountPostSavePlugin(): array
    {
        return $this->getProvidedDependency(ErpInvoiceDependencyProvider::PLUGIN_ERP_INVOICE_AMOUNT_POST_SAVE)->getArrayCopy();
    }
}
