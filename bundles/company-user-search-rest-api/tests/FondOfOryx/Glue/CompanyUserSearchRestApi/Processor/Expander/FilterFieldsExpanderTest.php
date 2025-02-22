<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface
     */
    protected MockObject|FilterFieldsExpanderPluginInterface $filterFieldsExpanderPluginMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Expander\FilterFieldsExpander
     */
    protected FilterFieldsExpander $filterFieldsExpander;

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
        /** @var \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransferMocks */
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
