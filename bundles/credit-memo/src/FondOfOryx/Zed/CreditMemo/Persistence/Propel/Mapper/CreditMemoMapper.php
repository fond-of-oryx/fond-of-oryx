<?php

namespace FondOfOryx\Zed\CreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

class CreditMemoMapper implements CreditMemoMapperInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CreditMemoExtension\Persistence\Dependency\Plugin\CreditMemoMapperExpanderPluginInterface>
     */
    protected $creditMemoMapperExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Zed\CreditMemoExtension\Persistence\Dependency\Plugin\CreditMemoMapperExpanderPluginInterface> $creditMemoMapperExpanderPlugins
     */
    public function __construct(array $creditMemoMapperExpanderPlugins)
    {
        $this->creditMemoMapperExpanderPlugins = $creditMemoMapperExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     *
     * @return \Orm\Zed\CreditMemo\Persistence\FooCreditMemo
     */
    public function mapTransferToEntity(
        CreditMemoTransfer $creditMemoTransfer,
        FooCreditMemo $fooCreditMemo
    ): FooCreditMemo {
        $fooCreditMemo->fromArray(
            $creditMemoTransfer->modifiedToArray(false),
        );

        if ($creditMemoTransfer->getLocale() !== null) {
            $fooCreditMemo->setFkLocale($creditMemoTransfer->getLocale()->getIdLocale());
        }

        return $fooCreditMemo;
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function mapEntityToTransfer(
        FooCreditMemo $fooCreditMemo,
        CreditMemoTransfer $creditMemoTransfer
    ): CreditMemoTransfer {
        $creditMemoTransfer->fromArray($fooCreditMemo->toArray(), true);

        return $this->expandCreditMemoTransferMapping($fooCreditMemo, $creditMemoTransfer);
    }

    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected function expandCreditMemoTransferMapping(FooCreditMemo $fooCreditMemo, CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        foreach ($this->creditMemoMapperExpanderPlugins as $expanderPlugin) {
            $creditMemoTransfer = $expanderPlugin->expand($fooCreditMemo, $creditMemoTransfer);
        }

        return $creditMemoTransfer;
    }
}
