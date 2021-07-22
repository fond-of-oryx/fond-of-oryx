<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\Glossary\Business\GlossaryFacadeInterface;

class JellyfishGiftCardToGlossaryFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Glossary\Business\GlossaryFacadeInterface
     */
    protected $glossaryFacadeMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryFacadeMock = $this->getMockBuilder(GlossaryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new JellyfishGiftCardToGlossaryFacadeBridge($this->glossaryFacadeMock);
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $keyName = 'foo.bar';
        $translation = 'Foo Bar';

        $this->glossaryFacadeMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($keyName, [], null)
            ->willReturn($translation);

        static::assertEquals(
            $translation,
            $this->bridge->translate($keyName)
        );
    }
}
