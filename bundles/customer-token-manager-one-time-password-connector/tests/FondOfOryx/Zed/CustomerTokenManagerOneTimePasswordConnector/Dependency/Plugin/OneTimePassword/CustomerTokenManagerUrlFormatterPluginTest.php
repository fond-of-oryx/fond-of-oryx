<?php

namespace FondOfOryx\Zed\CustomerTokenManagerOneTimePasswordConnector\Dependency\Plugin\OneTimePassword;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;

class CustomerTokenManagerUrlFormatterPluginTest extends Unit
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

        $this->plugin = new CustomerTokenManagerUrlFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testFormatUrlAndReplaceToken(): void
    {
        $path = 'https://localhost.dev/{{token}}';
        $token = 'token';
        $pathExpected = 'https://localhost.dev/' . $token;

        static::assertSame($pathExpected, $this->plugin->formatUrl($path, $token, $this->attributesTransferMock));
    }

    /**
     * @return void
     */
    public function testFormatUrlNoReplacement(): void
    {
        $path = 'https://localhost.dev/';
        $token = 'token';

        static::assertSame($path, $this->plugin->formatUrl($path, $token, $this->attributesTransferMock));
    }
}
