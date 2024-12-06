<?php

namespace FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RemoveRestrictedItemsPreReloadPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected QuoteTransfer|MockObject $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Business\BusinessOnBehalfProductListConnectorFacade
     */
    protected MockObject|BusinessOnBehalfProductListConnectorFacade $facadeMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfProductListConnector\Communication\Plugin\CartExtension\RemoveRestrictedItemsPreReloadPlugin
     */
    protected RemoveRestrictedItemsPreReloadPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(BusinessOnBehalfProductListConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new RemoveRestrictedItemsPreReloadPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('filterRestrictedItems')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->preReloadItems($this->quoteTransferMock),
        );
    }
}
