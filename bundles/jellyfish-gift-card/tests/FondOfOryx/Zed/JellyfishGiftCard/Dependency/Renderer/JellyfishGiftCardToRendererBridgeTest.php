<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Spryker\Zed\Glossary\Communication\Plugin\TwigTranslatorPlugin;
use Twig\Environment;

class JellyfishGiftCardToRendererBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Twig\Environment
     */
    protected $twigEnvironmentMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Glossary\Communication\Plugin\TwigTranslatorPlugin
     */
    protected $twigTranslatorPluginMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer\JellyfishGiftCardToRendererBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->twigEnvironmentMock = $this->getMockBuilder(Environment::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->twigTranslatorPluginMock = $this->getMockBuilder(TwigTranslatorPlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishGiftCardToRendererBridge($this->twigEnvironmentMock);
    }

    /**
     * @return void
     */
    public function testSetLocaleTransfer(): void
    {
        $this->twigEnvironmentMock->expects(static::atLeastOnce())
            ->method('getExtension')
            ->with(TwigTranslatorPlugin::class)
            ->willReturn($this->twigTranslatorPluginMock);

        $this->twigTranslatorPluginMock->expects(static::atLeastOnce())
            ->method('setLocaleTransfer')
            ->with($this->localeTransferMock);

        $this->bridge->setLocaleTransfer($this->localeTransferMock);
    }

    /**
     * @return void
     */
    public function testRender(): void
    {
        $template = 'foo.twig';
        $options = [];
        $renderedTemplate = 'Foo bar!';

        $this->twigEnvironmentMock->expects(static::atLeastOnce())
            ->method('render')
            ->with($template, $options)
            ->willReturn($renderedTemplate);

        static::assertEquals(
            $renderedTemplate,
            $this->bridge->render($template, $options),
        );
    }
}
