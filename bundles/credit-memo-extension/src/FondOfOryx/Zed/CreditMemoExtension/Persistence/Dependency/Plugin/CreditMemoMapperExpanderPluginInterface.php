<?php

namespace FondOfOryx\Zed\CreditMemoExtension\Persistence\Dependency\Plugin;

use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;

interface CreditMemoMapperExpanderPluginInterface
{
    /**
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $fooCreditMemo
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function expand(FooCreditMemo $fooCreditMemo, CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer;
}
