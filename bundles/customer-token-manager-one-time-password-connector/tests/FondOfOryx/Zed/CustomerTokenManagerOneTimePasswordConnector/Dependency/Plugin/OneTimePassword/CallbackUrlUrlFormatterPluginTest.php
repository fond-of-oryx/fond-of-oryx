<?php

namespace FondOfOryx\Zed\CustomerTokenManagerOneTimePasswordConnector\Dependency\Plugin\OneTimePassword;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;

class CallbackUrlUrlFormatterPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $attributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->attributesTransferMock = $this->getMockBuilder(OneTimePasswordAttributesTransfer::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new CallbackUrlUrlFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testFormatUrlWithNoCallbackUrl(): void
    {
        $path = '';
        $credentials = '';
        $this->attributesTransferMock->expects(static::once())->method('getCallbackUrl')->willReturn(null);

        static::assertSame($path, $this->plugin->formatUrl($path, $credentials, $this->attributesTransferMock));
    }

    /**
     * @return void
     */
    public function testFormatUrlWithCallbackUrlAndNoQueryInPathPresent(): void
    {
        $path = 'https://localhost.dev';
        $callbackUrl = 'test';
        $pathExpected = 'https://localhost.dev?callback_url=' . $callbackUrl;
        $credentials = '';
        $this->attributesTransferMock->expects(static::exactly(2))->method('getCallbackUrl')->willReturn($callbackUrl);

        static::assertSame($pathExpected, $this->plugin->formatUrl($path, $credentials, $this->attributesTransferMock));
    }

    /**
     * @return void
     */
    public function testFormatUrlWithCallbackUrlAndQueryInPathPresent(): void
    {
        $path = 'https://localhost.dev?reference=123';
        $callbackUrl = 'test';
        $pathExpected = 'https://localhost.dev?reference=123&callback_url=' . $callbackUrl;
        $credentials = '';
        $this->attributesTransferMock->expects(static::exactly(2))->method('getCallbackUrl')->willReturn($callbackUrl);

        static::assertSame($pathExpected, $this->plugin->formatUrl($path, $credentials, $this->attributesTransferMock));
    }
}
