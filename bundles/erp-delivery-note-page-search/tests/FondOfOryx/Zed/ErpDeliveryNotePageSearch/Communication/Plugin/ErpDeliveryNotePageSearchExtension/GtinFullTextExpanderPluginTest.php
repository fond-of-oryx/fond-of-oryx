<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\ErpDeliveryNotePageSearchExtension;

use Codeception\Test\Unit;

class GtinFullTextExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Communication\Plugin\ErpDeliveryNotePageSearchExtension\GtinFullTextExpanderPlugin
     */
    protected GtinFullTextExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new GtinFullTextExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $data = [
            GtinFullTextExpanderPlugin::KEY_ITEMS => [
                [GtinFullTextExpanderPlugin::KEY_GTIN => 'foo'],
                [GtinFullTextExpanderPlugin::KEY_GTIN => 'bar'],
                [],
            ],
        ];

        $fullText = [];

        static::assertEquals(
            [
                $data[GtinFullTextExpanderPlugin::KEY_ITEMS][0][GtinFullTextExpanderPlugin::KEY_GTIN],
                $data[GtinFullTextExpanderPlugin::KEY_ITEMS][1][GtinFullTextExpanderPlugin::KEY_GTIN],
            ],
            $this->plugin->expand($data, $fullText),
        );
    }
}
