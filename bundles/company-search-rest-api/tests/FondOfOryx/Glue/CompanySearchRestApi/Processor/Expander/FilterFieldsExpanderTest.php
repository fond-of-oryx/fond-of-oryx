<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsExpanderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApiExtension\Dependency\Plugin\FilterFieldsExpanderPluginInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FilterFieldsExpanderPluginInterface $filterFieldsExpanderPluginMock;

    /**
     * @var array<(\PHPUnit\Framework\MockObject\MockObject|(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject))>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Expander\FilterFieldsExpander
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
