<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderPluginExecutor implements ErpOrderPluginExecutorInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface[]
     */
    protected $erpOrderPreSavePlugins;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface[]
     */
    protected $erpOrderPostSavePlugins;

    /**
     * @param \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface[] $erpOrderPreSavePlugins
     * @param \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface[] $erpOrderPostSavePlugins
     */
    public function __construct(array $erpOrderPreSavePlugins, array $erpOrderPostSavePlugins)
    {
        $this->erpOrderPreSavePlugins = $erpOrderPreSavePlugins;
        $this->erpOrderPostSavePlugins = $erpOrderPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function executePostSavePlugins(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        foreach ($this->erpOrderPostSavePlugins as $plugin) {
            $erpOrderTransfer = $plugin->postSave($erpOrderTransfer);
        }

        return $erpOrderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTransfer $erpOrderTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    public function executePreSavePlugins(ErpOrderTransfer $erpOrderTransfer): ErpOrderTransfer
    {
        foreach ($this->erpOrderPreSavePlugins as $plugin) {
            $erpOrderTransfer = $plugin->preSave($erpOrderTransfer);
        }

        return $erpOrderTransfer;
    }
}
