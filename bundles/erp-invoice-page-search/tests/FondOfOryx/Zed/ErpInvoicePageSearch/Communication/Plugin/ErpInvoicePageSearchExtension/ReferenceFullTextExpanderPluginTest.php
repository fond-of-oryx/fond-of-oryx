<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\ErpInvoicePageSearchExtension;

use Codeception\Test\Unit;

class ReferenceFullTextExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Communication\Plugin\ErpInvoicePageSearchExtension\ReferenceFullTextExpanderPlugin
     */
    protected ReferenceFullTextExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->plugin = new ReferenceFullTextExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $data = [
            ReferenceFullTextExpanderPlugin::KEY_REFERENCE => 'ref',
        ];

        $fullText = [];

        static::assertEquals(
            [
                $data[ReferenceFullTextExpanderPlugin::KEY_REFERENCE],
            ],
            $this->plugin->expand($data, $fullText),
        );
    }
}
