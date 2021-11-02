<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderTotalTransfer;

class ErpOrderTotalPluginExecutor implements ErpOrderTotalPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPreSavePluginInterface>
     */
    protected $erpOrderTotalPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPostSavePluginInterface>
     */
    protected $erpOrderTotalPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPreSavePluginInterface> $erpOrderTotalPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPostSavePluginInterface> $erpOrderTotalPostSavePlugins
     */
    public function __construct(array $erpOrderTotalPreSavePlugins, array $erpOrderTotalPostSavePlugins)
    {
        $this->erpOrderTotalPreSavePlugins = $erpOrderTotalPreSavePlugins;
        $this->erpOrderTotalPostSavePlugins = $erpOrderTotalPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function executePostSavePlugins(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer
    {
        foreach ($this->erpOrderTotalPostSavePlugins as $plugin) {
            $erpOrderTotalTransfer = $plugin->postSave($erpOrderTotalTransfer);
        }

        return $erpOrderTotalTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalTransfer $erpOrderTotalTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalTransfer
     */
    public function executePreSavePlugins(ErpOrderTotalTransfer $erpOrderTotalTransfer): ErpOrderTotalTransfer
    {
        foreach ($this->erpOrderTotalPreSavePlugins as $plugin) {
            $erpOrderTotalTransfer = $plugin->preSave($erpOrderTotalTransfer);
        }

        return $erpOrderTotalTransfer;
    }
}
