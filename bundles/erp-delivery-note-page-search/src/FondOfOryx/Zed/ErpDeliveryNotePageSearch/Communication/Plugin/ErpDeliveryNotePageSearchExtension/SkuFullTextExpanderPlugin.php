<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\ErpDeliveryNotePageSearchExtension;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher\ErpDeliveryNotePageSearchPublisher;
use FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class SkuFullTextExpanderPlugin extends AbstractPlugin implements FullTextExpanderPluginInterface
{
    public const KEY_ITEMS = ErpDeliveryNotePageSearchPublisher::ERP_DELIVERY_NOTE_ITEMS;

    /**
     * @var string
     */
    public const KEY_SKU = 'sku';

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

        $skus = [];

        foreach ($data[static::KEY_ITEMS] as $itemData) {
            if (!isset($itemData[static::KEY_SKU])) {
                continue;
            }

            $sku = $itemData[static::KEY_SKU];
            $skus[$sku] = $sku;
        }

        if (count($skus) < 1) {
            return $fullText;
        }

        return array_merge($fullText, array_values($skus));
    }
}
