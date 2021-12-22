<?php

namespace FondOfOryx\Zed\Invoice\Business;

use FondOfOryx\Zed\Invoice\Business\Model\InvoiceAddressWriter;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceAddressWriterInterface;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceItemsWriter;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceItemsWriterInterface;
use FondOfOryx\Zed\Invoice\Business\Model\InvoicePluginExecutor;
use FondOfOryx\Zed\Invoice\Business\Model\InvoicePluginExecutorInterface;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceReferenceGenerator;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceReferenceGeneratorInterface;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceWriter;
use FondOfOryx\Zed\Invoice\Business\Model\InvoiceWriterInterface;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeInterface;
use FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeInterface;
use FondOfOryx\Zed\Invoice\InvoiceDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\Invoice\InvoiceConfig getConfig()
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoiceEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\Invoice\Persistence\InvoiceRepositoryInterface getRepository()
 */
class InvoiceBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\Invoice\Business\Model\InvoiceWriterInterface
     */
    public function createInvoiceWriter(): InvoiceWriterInterface
    {
        return new InvoiceWriter($this->getEntityManager(), $this->createInvoicePluginExecutor());
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Business\Model\InvoicePluginExecutorInterface
     */
    protected function createInvoicePluginExecutor(): InvoicePluginExecutorInterface
    {
        return new InvoicePluginExecutor($this->getInvoicePreSavePlugins(), $this->getInvoicePostSavePlugins());
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Business\Model\InvoiceAddressWriterInterface
     */
    public function createInvoiceAddressWriter(): InvoiceAddressWriterInterface
    {
        return new InvoiceAddressWriter($this->getEntityManager());
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Business\Model\InvoiceItemsWriterInterface
     */
    public function createInvoiceItemsWriter(): InvoiceItemsWriterInterface
    {
        return new InvoiceItemsWriter($this->getEntityManager());
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Business\Model\InvoiceReferenceGeneratorInterface
     */
    public function createInvoiceReferenceGenerator(): InvoiceReferenceGeneratorInterface
    {
        return new InvoiceReferenceGenerator($this->getSequenceNumberFacade(), $this->getStoreFacade(), $this->getConfig());
    }

    /**
     * @return array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePreSavePluginInterface>
     */
    protected function getInvoicePreSavePlugins(): array
    {
        return $this->getProvidedDependency(InvoiceDependencyProvider::PLUGINS_PRE_SAVE);
    }

    /**
     * @return array<\FondOfOryx\Zed\InvoiceExtension\Dependency\Plugin\InvoicePostSavePluginInterface>
     */
    protected function getInvoicePostSavePlugins(): array
    {
        return $this->getProvidedDependency(InvoiceDependencyProvider::PLUGINS_POST_SAVE);
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToSequenceNumberFacadeInterface
     */
    protected function getSequenceNumberFacade(): InvoiceToSequenceNumberFacadeInterface
    {
        return $this->getProvidedDependency(InvoiceDependencyProvider::FACADE_SEQUENCE_NUMBER);
    }

    /**
     * @return \FondOfOryx\Zed\Invoice\Dependency\Facade\InvoiceToStoreFacadeInterface
     */
    protected function getStoreFacade(): InvoiceToStoreFacadeInterface
    {
        return $this->getProvidedDependency(InvoiceDependencyProvider::FACADE_STORE);
    }
}
