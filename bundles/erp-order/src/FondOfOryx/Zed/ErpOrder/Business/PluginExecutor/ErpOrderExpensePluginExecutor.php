<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderExpenseTransfer;

class ErpOrderExpensePluginExecutor implements ErpOrderExpensePluginExecutorInterface
{
    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderExpensePreSavePluginInterface>
     */
    protected $erpOrderExpensePreSavePlugins;

    /**
     * @var array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderExpensePostSavePluginInterface>
     */
    protected $erpOrderExpensePostSavePlugins;

    /**
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderExpensePreSavePluginInterface> $erpOrderExpensePreSavePlugins
     * @param array<\FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderExpensePostSavePluginInterface> $erpOrderExpensePostSavePlugins
     */
    public function __construct(array $erpOrderExpensePreSavePlugins, array $erpOrderExpensePostSavePlugins)
    {
        $this->erpOrderExpensePreSavePlugins = $erpOrderExpensePreSavePlugins;
        $this->erpOrderExpensePostSavePlugins = $erpOrderExpensePostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function executePostSavePlugins(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer
    {
        foreach ($this->erpOrderExpensePostSavePlugins as $plugin) {
            $erpOrderExpenseTransfer = $plugin->postSave($erpOrderExpenseTransfer);
        }

        return $erpOrderExpenseTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderExpenseTransfer $erpOrderExpenseTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderExpenseTransfer
     */
    public function executePreSavePlugins(ErpOrderExpenseTransfer $erpOrderExpenseTransfer): ErpOrderExpenseTransfer
    {
        foreach ($this->erpOrderExpensePreSavePlugins as $plugin) {
            $erpOrderExpenseTransfer = $plugin->preSave($erpOrderExpenseTransfer);
        }

        return $erpOrderExpenseTransfer;
    }
}
