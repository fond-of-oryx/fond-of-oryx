<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface;

class ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientBridgeTest extends Unit
{
    /**
     * @var \Spryker\Client\GlossaryStorage\GlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this
            ->getMockBuilder(GlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ErpDeliveryNotePageSearchRestApiToGlossaryStorageClientBridge($this->clientMock);
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $id = 'foo';
        $localeName = 'de_DE';
        $parameters = [];
        $translatedValue = 'Foo';

        $this->clientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($id, $localeName, $parameters)
            ->willReturn($translatedValue);

        static::assertEquals(
            $translatedValue,
            $this->bridge->translate($id, $localeName, $parameters),
        );
    }
}
