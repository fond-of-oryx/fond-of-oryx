<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearchExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;

class BlacklistedLocalesProductAbstractMapExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PageMapTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pageMapTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface
     */
    protected $pageMapBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionSearch\Communication\Plugin\ProductPageSearchExtension\BlacklistedLocalesProductAbstractMapExpanderPlugin
     */
    protected $blacklistedLocalesProductAbstractMapExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->pageMapTransferMock = $this->getMockBuilder(PageMapTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMapBuilderMock = $this->getMockBuilder(PageMapBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->blacklistedLocalesProductAbstractMapExpanderPlugin = new BlacklistedLocalesProductAbstractMapExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandProductMap(): void
    {
        $blacklistedLocales = ['de_DE', 'en_US'];

        $this->pageMapTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedLocales')
            ->with($blacklistedLocales)
            ->willReturn($this->pageMapTransferMock);

        static::assertEquals(
            $this->pageMapTransferMock,
            $this->blacklistedLocalesProductAbstractMapExpanderPlugin->expandProductMap(
                $this->pageMapTransferMock,
                $this->pageMapBuilderMock,
                ['blacklisted_locales' => $blacklistedLocales],
                $this->localeTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testExpandProductMapWithInvalidProductData(): void
    {
        $this->pageMapTransferMock->expects(static::never())
            ->method('setBlacklistedLocales');

        static::assertEquals(
            $this->pageMapTransferMock,
            $this->blacklistedLocalesProductAbstractMapExpanderPlugin->expandProductMap(
                $this->pageMapTransferMock,
                $this->pageMapBuilderMock,
                [],
                $this->localeTransferMock
            )
        );
    }
}
