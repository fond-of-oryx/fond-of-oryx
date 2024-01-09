<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\ErpDeliveryNotePageSearchExtension;

use Codeception\Test\Unit;

class SkuFullTextExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\ErpDeliveryNotePageSearchExtension\SkuFullTextExpanderPlugin
     */
    protected SkuFullTextExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new SkuFullTextExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $data = [
            SkuFullTextExpanderPlugin::KEY_ITEMS => [
                [SkuFullTextExpanderPlugin::KEY_SKU => 'foo'],
                [SkuFullTextExpanderPlugin::KEY_SKU => 'bar'],
                [],
            ],
        ];

        $fullText = [];

        static::assertEquals(
            [
                $data[SkuFullTextExpanderPlugin::KEY_ITEMS][0][SkuFullTextExpanderPlugin::KEY_SKU],
                $data[SkuFullTextExpanderPlugin::KEY_ITEMS][1][SkuFullTextExpanderPlugin::KEY_SKU],
            ],
            $this->plugin->expand($data, $fullText),
        );
    }
}
