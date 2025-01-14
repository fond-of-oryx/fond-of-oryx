<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class SplittableCheckoutRestApiToGlossaryStorageClientBridgeTest extends Unit
{
    /**
     * @var \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected GlossaryStorageClientInterface|MockObject $glossaryStorageClientMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientBridge
     */
    protected SplittableCheckoutRestApiToGlossaryStorageClientBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(GlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new SplittableCheckoutRestApiToGlossaryStorageClientBridge($this->glossaryStorageClientMock);
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = 'de_DE';
        $untranslated = 'x.x.x';
        $parameters = [];
        $translated = 'x';

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($untranslated, $locale, $parameters)
            ->willReturn($translated);

        static::assertEquals(
            $translated,
            $this->bridge->translate($untranslated, $locale, $parameters),
        );
    }
}
