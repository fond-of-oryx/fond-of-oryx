<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderAmountTransfer;

class ErpOrderAmountPluginExecutor implements ErpOrderAmountPluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAmountPreSavePluginInterface>
     */
    protected $erpOrderAmountPreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAmountPostSavePluginInterface>
     */
    protected $erpOrderAmountPostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAmountPreSavePluginInterface> $erpOrderAmountPreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAmountPostSavePluginInterface> $erpOrderAmountPostSavePlugins
     */
    public function __construct(array $erpOrderAmountPreSavePlugins, array $erpOrderAmountPostSavePlugins)
    {
        $this->erpOrderAmountPreSavePlugins = $erpOrderAmountPreSavePlugins;
        $this->erpOrderAmountPostSavePlugins = $erpOrderAmountPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function executePostSavePlugins(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer
    {
        foreach ($this->erpOrderAmountPostSavePlugins as $plugin) {
            $erpOrderAmountTransfer = $plugin->postSave($erpOrderAmountTransfer);
        }

        return $erpOrderAmountTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAmountTransfer $erpOrderAmountTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAmountTransfer
     */
    public function executePreSavePlugins(ErpOrderAmountTransfer $erpOrderAmountTransfer): ErpOrderAmountTransfer
    {
        foreach ($this->erpOrderAmountPreSavePlugins as $plugin) {
            $erpOrderAmountTransfer = $plugin->preSave($erpOrderAmountTransfer);
        }

        return $erpOrderAmountTransfer;
    }
}
