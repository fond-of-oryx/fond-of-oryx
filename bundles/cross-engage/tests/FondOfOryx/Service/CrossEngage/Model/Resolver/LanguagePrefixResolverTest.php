<?php

namespace FondOfOryx\Service\CrossEngage\Model\Resolver;

use Codeception\Test\Unit;
use Spryker\Shared\Kernel\Store;

class LanguagePrefixResolverTest extends Unit
{
    /**
     * @var \Spryker\Shared\Kernel\Store|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storeMock;

    /**
     * @var \FondOfOryx\Service\CrossEngage\Model\Resolver\ResolverInterface
     */
    protected $resolver;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->storeMock = $this->getMockBuilder(Store::class)->disableOriginalConstructor()->getMock();

        $this->resolver = new LanguagePrefixResolver($this->storeMock);
    }

    /**
     * @return void
     */
    public function testResolve(): void
    {
        $this->storeMock->expects(static::once())->method('getCurrentLocale')->willReturn('de_DE');
        $this->storeMock->expects(static::once())->method('getLocales')->willReturn(['de' => 'de_DE']);
        $this->storeMock->expects(static::never())->method('getCurrentLanguage');

        static::assertSame('de', $this->resolver->resolve());
    }

    /**
     * @return void
     */
    public function testResolveGetFallback(): void
    {
        $this->storeMock->expects(static::once())->method('getCurrentLocale')->willReturn('en_US');
        $this->storeMock->expects(static::once())->method('getLocales')->willReturn(['de' => 'de_DE']);
        $this->storeMock->expects(static::once())->method('getCurrentLanguage')->willReturn('de');

        static::assertSame('de', $this->resolver->resolve());
    }
}
