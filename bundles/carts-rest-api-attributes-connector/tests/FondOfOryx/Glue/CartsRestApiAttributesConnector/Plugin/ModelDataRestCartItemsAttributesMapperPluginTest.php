<?php

namespace FondOfOryx\Glue\CartsRestApiAttributesConnector\Plugin;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ModelDataRestCartItemsAttributesMapperPluginTest extends Unit
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
     * @var \FondOfOryx\Glue\CartsRestApiAttributesConnector\Plugin\ModelDataRestCartItemsAttributesMapperPlugin
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

        $this->plugin = new ModelDataRestCartItemsAttributesMapperPlugin();
    }

    /**
     * @return void
     */
    public function testMapItemTransferToRestItemsAttributesTransfer(): void
    {
        $attributes = [
            'model' => 'test',
            'abc' => 'def',
        ];

        $this->itemTransferMock
            ->expects(static::atLeastOnce())
            ->method('getConcreteAttributes')
            ->willReturn($attributes);

        $this->restItemsAttributesTransferMock
            ->expects(static::once())
            ->method('setModel')
            ->with($attributes['model']);

        $this->plugin->mapItemTransferToRestItemsAttributesTransfer($this->itemTransferMock, $this->restItemsAttributesTransferMock, '');
    }

    /**
     * @return void
     */
    public function testMapItemTransferToRestItemsAttributesTransferNothingMapped(): void
    {
        $attributes = [
            'abc' => 'def',
        ];

        $this->itemTransferMock
            ->expects(static::atLeastOnce())
            ->method('getConcreteAttributes')
            ->willReturn($attributes);

        $this->restItemsAttributesTransferMock
            ->expects(static::never());

        $this->plugin->mapItemTransferToRestItemsAttributesTransfer($this->itemTransferMock, $this->restItemsAttributesTransferMock, '');
    }
}
