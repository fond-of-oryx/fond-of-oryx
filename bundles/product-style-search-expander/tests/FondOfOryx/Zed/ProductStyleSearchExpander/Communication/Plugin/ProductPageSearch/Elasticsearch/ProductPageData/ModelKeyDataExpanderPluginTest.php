<?php

namespace FondOfOryx\Zed\ProductStyleSearchExpander\Communication\Plugin\ProductPageSearch\Elasticsearch\ProductPageData;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductPageSearchTransfer;

class ModelKeyDataExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductStyleSearchExpander\Communication\Plugin\ProductPageSearch\Elasticsearch\ModelKeyDataExpanderPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\ProductPageSearchTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractPageSearchTransfer;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before(); // TODO: Change the autogenerated stub

        $this->productAbstractPageSearchTransfer = $this->getMockBuilder(ProductPageSearchTransfer::class)
            ->disableOriginalConstructor()
            ->setMethods(['setModelKey'])
            ->getMock();

        $this->plugin = new ModelKeyDataExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testModelKeyExpanderPluginTestSuccess(): void
    {
        $this->productAbstractPageSearchTransfer->expects($this->once())
            ->method('setModelKey');

        $this->plugin->expandProductPageData([
            'attributes' => json_encode(['model_key' => 'test']),
        ], $this->productAbstractPageSearchTransfer);
    }

    /**
     * @return void
     */
    public function testModelKeyExpanderPluginTestFailed(): void
    {
        $this->productAbstractPageSearchTransfer->expects($this->never())
            ->method('setModelKey');

        $this->plugin->expandProductPageData([
            'attributes' => json_encode(['wrong_key' => 'test']),
        ], $this->productAbstractPageSearchTransfer);
    }
}
