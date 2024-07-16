<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\ErpInvoicePageSearchExtension;

use FondOfOryx\Zed\ErpInvoicePageSearch\Business\Publisher\ErpInvoicePageSearchPublisher;
use FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class GtinFullTextExpanderPlugin extends AbstractPlugin implements FullTextExpanderPluginInterface
{
    public const KEY_ITEMS = ErpInvoicePageSearchPublisher::ERP_INVOICE_ITEMS;

    /**
     * @var string
     */
    public const KEY_GTIN = 'gtin';

    /**
     * @param array $data
     * @param array<scalar> $fullText
     *
     * @return array<scalar>
     */
    public function expand(array $data, array $fullText): array
    {
        if (!isset($data[static::KEY_ITEMS])) {
            return $fullText;
        }

        $gtins = [];

        foreach ($data[static::KEY_ITEMS] as $itemData) {
            if (!isset($itemData[static::KEY_GTIN])) {
                continue;
            }

            $gtin = $itemData[static::KEY_GTIN];
            $gtins[$gtin] = $gtin;
        }

        if (count($gtins) < 1) {
            return $fullText;
        }

        return array_merge($fullText, array_values($gtins));
    }
}
