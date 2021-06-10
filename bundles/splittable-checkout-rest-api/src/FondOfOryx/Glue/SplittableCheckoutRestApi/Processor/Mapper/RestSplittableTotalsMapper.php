<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestSplittableTotalsTransfer;
use Generated\Shared\Transfer\RestTotalsTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;

class RestSplittableTotalsMapper implements RestSplittableTotalsMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsTransfer $splittableTotalsTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableTotalsTransfer
     */
    public function fromSplittableTotals(SplittableTotalsTransfer $splittableTotalsTransfer): RestSplittableTotalsTransfer
    {
        $splitKeys = [];
        $restSplittableTotalsTransfer = new RestSplittableTotalsTransfer();

        foreach ($splittableTotalsTransfer->getTotalsList() as $key => $totalTransfer) {
            $splitKeys[] = $key;
            $restTotalsTransfer = (new RestTotalsTransfer())->fromArray($totalTransfer->toArray(), true);

            if ($totalTransfer->getTaxTotal() !== null) {
                $restTotalsTransfer->setTaxTotal($totalTransfer->getTaxTotal()->getAmount());
            }

            $restSplittableTotalsTransfer->addTotals($key, $restTotalsTransfer);
        }

        return $restSplittableTotalsTransfer
            ->setSplitKeys($splitKeys);
    }
}
