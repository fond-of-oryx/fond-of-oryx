<?php

namespace FondOfOryx\Zed\GiftCardApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiFacade;
use FondOfOryx\Zed\GiftCardApi\GiftCardApiConfig;
use Generated\Shared\Transfer\ApiDataTransfer;

class GiftCardApiValidatorPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Communication\Plugin\Api\GiftCardApiValidatorPlugin
     */
    protected $plugin;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardApi\Business\GiftCardApiFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(GiftCardApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new GiftCardApiValidatorPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->apiDataTransferMock)
            ->willReturn([]);

        static::assertIsArray($this->plugin->validate($this->apiDataTransferMock));
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertEquals(GiftCardApiConfig::RESOURCE_GIFT_CARD, $this->plugin->getResourceName());
    }
}
