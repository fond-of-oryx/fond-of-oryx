<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Communication\Plugin\CreditMemoExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorFacade;
use Generated\Shared\Transfer\CreditMemoTransfer;

class GiftCardsCreditMemoPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\CreditMemoGiftCardConnectorFacade|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Communication\Plugin\CreditMemoExtension\GiftCardsCreditMemoPostSavePlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $creditMemoTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->creditMemoTransferMock = $this
            ->getMockBuilder(CreditMemoTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this
            ->getMockBuilder(CreditMemoGiftCardConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardsCreditMemoPostSavePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createCreditMemoGiftCards')
            ->with($this->creditMemoTransferMock)
            ->willReturn($this->creditMemoTransferMock);

        static::assertInstanceOf(
            CreditMemoTransfer::class,
            $this->plugin->postSave($this->creditMemoTransferMock),
        );
    }
}
