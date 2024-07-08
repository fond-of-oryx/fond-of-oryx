<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class DocumentRestRequestExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\DocumentRestRequestTransfer
     */
    protected MockObject|DocumentRestRequestTransfer $documentRestRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\DocumentsRestApi\Dependency\Plugin\DocumentRestRequestExpanderPluginInterface
     */
    protected MockObject|DocumentRestRequestExpanderPluginInterface $pluginMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Processor\Expander\DocumentRestRequestExpander
     */
    protected DocumentRestRequestExpander $expanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginMock = $this->getMockBuilder(DocumentRestRequestExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->documentRestRequestTransferMock = $this->getMockBuilder(DocumentRestRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->expanderPlugin = new DocumentRestRequestExpander([$this->pluginMock]);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->pluginMock->expects(static::atLeastOnce())
            ->method('expand')
            ->willReturn($this->documentRestRequestTransferMock);

        static::assertEquals(
            $this->documentRestRequestTransferMock,
            $this->expanderPlugin->expand($this->restRequestMock, $this->documentRestRequestTransferMock),
        );
    }
}
