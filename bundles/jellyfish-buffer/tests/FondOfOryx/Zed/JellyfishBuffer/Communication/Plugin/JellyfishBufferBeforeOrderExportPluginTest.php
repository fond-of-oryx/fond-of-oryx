<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferFacade;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class JellyfishBufferBeforeOrderExportPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Communication\Plugin\JellyfishBufferBeforeOrderExportPlugin
     */
    protected $jellyfishBufferBeforeOrderExportPlugin;

    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Business\JellyfishBufferFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishBufferFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishOrderTransferMock;

    /**
     * @var array
     */
    protected $options;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->jellyfishBufferFacadeMock = $this->getMockBuilder(JellyfishBufferFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishOrderTransferMock = $this->getMockBuilder(JellyfishOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->options = [];

        $this->jellyfishBufferBeforeOrderExportPlugin = new JellyfishBufferBeforeOrderExportPlugin();
        $this->jellyfishBufferBeforeOrderExportPlugin->setFacade($this->jellyfishBufferFacadeMock);
    }

    /**
     * @return void
     */
    public function testBefore(): void
    {
        $this->jellyfishBufferFacadeMock->expects($this->atLeastOnce())
            ->method('bufferOrder')
            ->with(
                $this->jellyfishOrderTransferMock,
                $this->options,
            );

        $this->jellyfishBufferBeforeOrderExportPlugin->before(
            $this->jellyfishOrderTransferMock,
            $this->options,
        );
    }
}
