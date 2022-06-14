<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

class RestResourceMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestItemsAttributesMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restItemsAttributesMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestItemsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restItemsAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestResourceMapper
     */
    protected $restResourceMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restItemsAttributesMapperMock = $this->getMockBuilder(RestItemsAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restItemsAttributesTransferMock = $this->getMockBuilder(RestItemsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMapper = new RestResourceMapper(
            $this->restItemsAttributesMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testFromItem(): void
    {
        $groupKey = 'foo-bar-1';

        $this->restItemsAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromItem')
            ->with($this->itemTransferMock)
            ->willReturn($this->restItemsAttributesTransferMock);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getGroupKey')
            ->willReturn($groupKey);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                CartSearchRestApiConfig::RESOURCE_CART_ITEMS,
                $groupKey,
                $this->restItemsAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        static::assertEquals(
            $this->restResourceMock,
            $this->restResourceMapper->fromItem($this->itemTransferMock),
        );
    }
}
