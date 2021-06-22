<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Resolver;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToLocaleFacadeBridge;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

class LocaleResolverTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Dependency\Facade\CreditMemoToLocaleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Resolver\ResolverInterface
     */
    protected $resolver;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->localeFacadeMock = $this->getMockBuilder(CreditMemoToLocaleFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)->disableOriginalConstructor()->getMock();

        $this->resolver = new LocaleResolver($this->localeFacadeMock);
    }

    /**
     * @return void
     */
    public function testResolveAndAdd(): void
    {
        $this->localeFacadeMock->expects(static::once())->method('getLocaleById')->willReturn($this->localeTransferMock);
        $this->creditMemoTransferMock->expects(static::once())->method('getFkLocale')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('setLocale')->willReturn($this->creditMemoTransferMock);

        $this->resolver->resolveAndAdd($this->creditMemoTransferMock);
    }
}
