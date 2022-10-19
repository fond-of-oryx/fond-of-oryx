<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldsExpanderPluginMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander\FilterFieldsExpander
     */
    protected $expander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldsExpanderPluginMock = $this->getMockBuilder(FilterFieldsExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $plugins = [$this->filterFieldsExpanderPluginMock];
        $this->expander = new FilterFieldsExpander($plugins);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $filterFieldTransfers = new ArrayObject($this->filterFieldTransferMock);

        $this->filterFieldsExpanderPluginMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock, $filterFieldTransfers)
            ->willReturn($filterFieldTransfers);

        static::assertInstanceOf(
            ArrayObject::class,
            $this->expander->expand(
                $this->restRequestMock,
                $filterFieldTransfers,
            ),
        );

        static::assertEquals(
            $filterFieldTransfers,
            $this->expander->expand(
                $this->restRequestMock,
                $filterFieldTransfers,
            ),
        );
    }
}
