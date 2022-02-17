<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ErpDeliveryNotePageSearchToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Service\ErpDeliveryNotePageSearchToUtilEncodingServiceInterface
     */
    protected $erpDeliveryNotePageSearchToUtilEncodingServiceBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->utilEncodingServiceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToUtilEncodingServiceBridge = new ErpDeliveryNotePageSearchToUtilEncodingServiceBridge(
            $this->utilEncodingServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $value = 'A string!';
        $encodedJson = json_encode($value);

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->willReturn($encodedJson);

        $this->assertEquals(
            $encodedJson,
            $this->erpDeliveryNotePageSearchToUtilEncodingServiceBridge->encodeJson($value),
        );
    }

    /**
     * @return void
     */
    public function testDecodeJson(): void
    {
        $value = 'A string!';
        $decodedJson = ['A string!'];

        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('decodeJson')
            ->willReturn($decodedJson);

        $this->assertEquals(
            $decodedJson,
            $this->erpDeliveryNotePageSearchToUtilEncodingServiceBridge->decodeJson($value),
        );
    }
}
