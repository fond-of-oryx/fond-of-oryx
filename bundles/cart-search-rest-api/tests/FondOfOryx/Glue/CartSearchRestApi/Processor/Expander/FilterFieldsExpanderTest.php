<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldsExpanderPluginMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $filterFieldTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Expander\FilterFieldsExpander
     */
    protected $filterFieldsExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldsExpanderPluginMock = $this->getMockBuilder(FilterFieldsExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsExpander = new FilterFieldsExpander(
            [$this->filterFieldsExpanderPluginMock],
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $filterFieldTransferMocks = new ArrayObject($this->filterFieldTransferMocks);

        $this->filterFieldsExpanderPluginMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock, $filterFieldTransferMocks)
            ->willReturn($filterFieldTransferMocks);

        static::assertEquals(
            $filterFieldTransferMocks,
            $this->filterFieldsExpander->expand(
                $this->restRequestMock,
                $filterFieldTransferMocks,
            ),
        );
    }
}
