<?php

namespace FondOfOryx\Zed\JellyfishBufferGui\Communication;

use FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderHistoryTable;
use FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderTable;
use FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToJellyfishBufferInterface;
use FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiDependencyProvider;
use Generated\Shared\Transfer\ExportedOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishBufferGui\JellyfishBufferGuiConfig getConfig()
 * @method \FondOfOryx\Zed\JellyfishBufferGui\Persistence\JellyfishBufferGuiQueryContainer getQueryContainer()
 */
class JellyfishBufferGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @param int $idStore
     *
     * @return \FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderTable
     */
    public function createExportedOrderTable($idStore)
    {
        return new ExportedOrderTable(
            $this->getStoreFacade(),
            $this->getQueryContainer(),
            $idStore,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\ExportedOrderTransfer $exportedOrderTransfer
     *
     * @return \FondOfOryx\Zed\JellyfishBufferGui\Communication\Table\ExportedOrderHistoryTable
     */
    public function createExportedOrderHistoryTable(ExportedOrderTransfer $exportedOrderTransfer)
    {
        return new ExportedOrderHistoryTable(
            $this->getJellyfishBufferFacade(),
            $this->getQueryContainer(),
            $exportedOrderTransfer,
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToJellyfishBufferInterface
     */
    public function getJellyfishBufferFacade(): JellyfishBufferGuiToJellyfishBufferInterface
    {
        return $this->getProvidedDependency(JellyfishBufferGuiDependencyProvider::FACADE_JELLYFISH_BUFFER);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishBufferGui\Dependency\Facade\JellyfishBufferGuiToStoreFacadeInterface
     */
    public function getStoreFacade(): JellyfishBufferGuiToStoreFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishBufferGuiDependencyProvider::FACADE_STORE);
    }
}
