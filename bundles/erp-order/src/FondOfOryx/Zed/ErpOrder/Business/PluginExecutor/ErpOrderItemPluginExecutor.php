<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderItemTransfer;

class ErpOrderItemPluginExecutor implements ErpOrderItemPluginExecutorInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface[]
     */
    protected $erpOrderItemPreSavePlugins;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface[]
     */
    protected $erpOrderItemPostSavePlugins;

    /**
     * @param \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface[] $erpOrderItemPreSavePlugins
     * @param \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface[] $erpOrderItemPostSavePlugins
     */
    public function __construct(array $erpOrderItemPreSavePlugins, array $erpOrderItemPostSavePlugins)
    {
        $this->erpOrderItemPreSavePlugins = $erpOrderItemPreSavePlugins;
        $this->erpOrderItemPostSavePlugins = $erpOrderItemPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function executePostSavePlugins(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer
    {
        foreach ($this->erpOrderItemPostSavePlugins as $plugin) {
            $erpOrderItemTransfer = $plugin->postSave($erpOrderItemTransfer);
        }

        return $erpOrderItemTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderItemTransfer $erpOrderItemTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    public function executePreSavePlugins(ErpOrderItemTransfer $erpOrderItemTransfer): ErpOrderItemTransfer
    {
        foreach ($this->erpOrderItemPreSavePlugins as $plugin) {
            $erpOrderItemTransfer = $plugin->preSave($erpOrderItemTransfer);
        }

        return $erpOrderItemTransfer;
    }
}
