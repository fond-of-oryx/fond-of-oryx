<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\ErpDeliveryNotePageSearchExtension;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class GtinFullTextExpanderPlugin extends AbstractPlugin implements FullTextExpanderPluginInterface
{
    public const KEY_ITEMS = ErpDeliveryNotePageSearchPublisher::ERP_DELIVERY_NOTE_ITEMS;

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
