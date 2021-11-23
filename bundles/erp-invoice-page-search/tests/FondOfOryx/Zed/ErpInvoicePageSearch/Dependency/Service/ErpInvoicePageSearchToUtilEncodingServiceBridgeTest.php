<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

class ErpInvoicePageSearchToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Service\ErpInvoicePageSearchToUtilEncodingServiceInterface
     */
    protected $erpInvoicePageSearchToUtilEncodingServiceBridge;

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

        $this->erpInvoicePageSearchToUtilEncodingServiceBridge = new ErpInvoicePageSearchToUtilEncodingServiceBridge(
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
            $this->erpInvoicePageSearchToUtilEncodingServiceBridge->encodeJson($value),
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
            $this->erpInvoicePageSearchToUtilEncodingServiceBridge->decodeJson($value),
        );
    }
}
