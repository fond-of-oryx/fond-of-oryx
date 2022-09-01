<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

class ErpOrderTotalsPluginExecutor implements ErpOrderTotalsPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPreSavePluginInterface>
     */
    protected $erpOrderTotalsPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPostSavePluginInterface>
     */
    protected $erpOrderTotalsPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPreSavePluginInterface> $erpOrderTotalsPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPostSavePluginInterface> $erpOrderTotalsPostSavePlugins
     */
    public function __construct(array $erpOrderTotalsPreSavePlugins, array $erpOrderTotalsPostSavePlugins)
    {
        $this->erpOrderTotalsPreSavePlugins = $erpOrderTotalsPreSavePlugins;
        $this->erpOrderTotalsPostSavePlugins = $erpOrderTotalsPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function executePostSavePlugins(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        foreach ($this->erpOrderTotalsPostSavePlugins as $plugin) {
            $erpOrderTotalsTransfer = $plugin->postSave($erpOrderTotalsTransfer);
        }

        return $erpOrderTotalsTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderTotalsTransfer $erpOrderTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderTotalsTransfer
     */
    public function executePreSavePlugins(ErpOrderTotalsTransfer $erpOrderTotalsTransfer): ErpOrderTotalsTransfer
    {
        foreach ($this->erpOrderTotalsPreSavePlugins as $plugin) {
            $erpOrderTotalsTransfer = $plugin->preSave($erpOrderTotalsTransfer);
        }

        return $erpOrderTotalsTransfer;
    }
}
