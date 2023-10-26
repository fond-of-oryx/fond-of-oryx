<?php

namespace FondOfOryx\Glue\CartsRestApiAttributesConnector\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ConcreteAttributesRestCartItemsAttributesMapperPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ItemTransfer|MockObject $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestItemsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestItemsAttributesTransfer|MockObject $restItemsAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartsRestApiAttributesConnector\Plugin\ConcreteAttributesRestCartItemsAttributesMapperPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restItemsAttributesTransferMock = $this->getMockBuilder(RestItemsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ConcreteAttributesRestCartItemsAttributesMapperPlugin();
    }

    /**
     * @return void
     */
    public function testMapItemTransferToRestItemsAttributesTransfer(): void
    {
        $attributes = [
            'model' => 'test',
            'abc_def' => 'ghi',
        ];

        $attributesCheck = [
            'model' => 'test',
            'abcDef' => 'ghi',
        ];

        $this->itemTransferMock
            ->expects(static::atLeastOnce())
            ->method('getConcreteAttributes')
            ->willReturn($attributes);

        $this->restItemsAttributesTransferMock
            ->expects(static::once())
            ->method('setProductConcreteAttributes')
            ->with($attributesCheck)
            ->willReturnSelf();

        $this->plugin->mapItemTransferToRestItemsAttributesTransfer($this->itemTransferMock, $this->restItemsAttributesTransferMock, '');
    }
}
