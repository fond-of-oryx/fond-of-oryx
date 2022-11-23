<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;

class ErpOrderAddressWriter implements ErpOrderAddressWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface
     */
    protected $erpOrderAddressPluginExecutor;

    /**
     * @param \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderAddressPluginExecutorInterface $erpOrderAddressPluginExecutor
     */
    public function __construct(
        ErpOrderEntityManagerInterface $entityManager,
        ErpOrderAddressPluginExecutorInterface $erpOrderAddressPluginExecutor
    ) {
        $this->entityManager = $entityManager;
        $this->erpOrderAddressPluginExecutor = $erpOrderAddressPluginExecutor;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function create(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        $erpOrderAddressTransfer = $this->erpOrderAddressPluginExecutor->executePreSavePlugins($erpOrderAddressTransfer);
        $erpOrderAddressTransfer = $this->entityManager->createErpOrderAddress($erpOrderAddressTransfer);

        return $this->erpOrderAddressPluginExecutor->executePostSavePlugins($erpOrderAddressTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function update(
        ErpOrderAddressTransfer $erpOrderAddressTransfer
    ): ErpOrderAddressTransfer {
        $erpOrderAddressTransfer = $this->erpOrderAddressPluginExecutor->executePreSavePlugins($erpOrderAddressTransfer);
        $erpOrderAddressTransfer = $this->entityManager->updateErpOrderAddress($erpOrderAddressTransfer);

        return $this->erpOrderAddressPluginExecutor->executePostSavePlugins($erpOrderAddressTransfer);
    }

    /**
     * @param int $idErpOrderAddress
     *
     * @return void
     */
    public function delete(int $idErpOrderAddress): void
    {
        $this->entityManager->deleteErpOrderAddressByIdErpOrderAddress($idErpOrderAddress);
    }
}
