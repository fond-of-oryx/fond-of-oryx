<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Generated\Shared\Transfer\ErpOrderAddressTransfer;

class ErpOrderAddressPluginExecutor implements ErpOrderAddressPluginExecutorInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPreSavePluginInterface[]
     */
    protected $erpOrderAddressPreSavePlugins;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPostSavePluginInterface[]
     */
    protected $erpOrderAddressPostSavePlugins;

    /**
     * @param \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPreSavePluginInterface[] $erpOrderAddressPreSavePlugins
     * @param \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderAddressPostSavePluginInterface[] $erpOrderAddressPostSavePlugins
     */
    public function __construct(array $erpOrderAddressPreSavePlugins, array $erpOrderAddressPostSavePlugins)
    {
        $this->erpOrderAddressPreSavePlugins = $erpOrderAddressPreSavePlugins;
        $this->erpOrderAddressPostSavePlugins = $erpOrderAddressPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function executePostSavePlugins(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        foreach ($this->erpOrderAddressPostSavePlugins as $plugin) {
            $erpOrderAddressTransfer = $plugin->postSave($erpOrderAddressTransfer);
        }

        return $erpOrderAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ErpOrderAddressTransfer $erpOrderAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    public function executePreSavePlugins(ErpOrderAddressTransfer $erpOrderAddressTransfer): ErpOrderAddressTransfer
    {
        foreach ($this->erpOrderAddressPreSavePlugins as $plugin) {
            $erpOrderAddressTransfer = $plugin->preSave($erpOrderAddressTransfer);
        }

        return $erpOrderAddressTransfer;
    }
}
