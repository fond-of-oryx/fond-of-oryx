<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Generated\Shared\Transfer\CreditMemoTransfer;

class CreditMemoPluginExecutor implements CreditMemoPluginExecutorInterface
{
    /**
     * @var array|\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPreSavePluginInterface[]
     */
    protected $creditMemoPreSavePlugins;

    /**
     * @var array|\FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface[]
     */
    protected $creditMemoPostSavePlugins;

    /**
     * @param \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPreSavePluginInterface[] $creditMemoPreSavePlugins
     * @param \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface[] $creditMemoPostSavePlugins
     */
    public function __construct(
        array $creditMemoPreSavePlugins,
        array $creditMemoPostSavePlugins
    ) {
        $this->creditMemoPreSavePlugins = $creditMemoPreSavePlugins;
        $this->creditMemoPostSavePlugins = $creditMemoPostSavePlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function executePostSavePlugins(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        foreach ($this->creditMemoPostSavePlugins as $creditMemoPostSavePlugin) {
            $creditMemoTransfer = $creditMemoPostSavePlugin
                ->postSave($creditMemoTransfer);
        }

        return $creditMemoTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function executePreSavePlugins(
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        foreach ($this->creditMemoPreSavePlugins as $creditMemoPreSavePlugin) {
            $creditMemoTransfer = $creditMemoPreSavePlugin
                ->preSave($creditMemoTransfer);
        }

        return $creditMemoTransfer;
    }
}
