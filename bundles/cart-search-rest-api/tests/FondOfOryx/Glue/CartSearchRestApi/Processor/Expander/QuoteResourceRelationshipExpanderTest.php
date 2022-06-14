<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestResourceMapperInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestLinkInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class QuoteResourceRelationshipExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestResourceMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResourceMapperMock;

    /**
     * @var array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $restResourceMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected $transferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\QuoteResourceRelationshipExpander
     */
    protected $quoteResourceRelationshipExpander;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->restResourceMapperMock = $this->getMockBuilder(RestResourceMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMocks = [
            $this->getMockBuilder(RestResourceInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(RestResourceInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMock = $this->getMockBuilder(AbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResourceRelationshipExpander = new QuoteResourceRelationshipExpander(
            $this->restResourceMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $groupKey = 'foo-bar-1';
        $uuid = '39efd250-e5af-462e-93fb-2d31a833263b';

        $this->restResourceMocks[0]->expects(static::atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->transferMock);

        $this->restResourceMocks[1]->expects(static::atLeastOnce())
            ->method('getPayload')
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->restResourceMapperMock->expects(static::atLeastOnce())
            ->method('fromItem')
            ->with($this->itemTransferMock)
            ->willReturn($this->restResourceMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getGroupKey')
            ->willReturn($groupKey);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('addLink')
            ->with(
                RestLinkInterface::LINK_SELF,
                sprintf(
                    '%s/%s/%s/%s',
                    CartSearchRestApiConfig::RESOURCE_CARTS,
                    $uuid,
                    CartSearchRestApiConfig::RESOURCE_CART_ITEMS,
                    $groupKey,
                ),
            )->willReturn($this->restResourceMock);

        $this->restResourceMocks[1]->expects(static::atLeastOnce())
            ->method('addRelationship')
            ->with($this->restResourceMock)
            ->willReturn($this->restResourceMocks[1]);

        $this->quoteResourceRelationshipExpander->expand($this->restResourceMocks, $this->restRequestMock);
    }
}
