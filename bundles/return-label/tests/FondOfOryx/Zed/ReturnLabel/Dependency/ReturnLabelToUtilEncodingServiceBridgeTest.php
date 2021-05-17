<?php

namespace FondOfOryx\Zed\ReturnLabel\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilEncoding\UtilEncodingService;

class ReturnLabelToUtilEncodingServiceBridgeTest extends Unit
{
    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Dependency\Service\ReturnLabelToUtilEncodingServiceInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->utilEncodingServiceMock = $this->getMockBuilder(UtilEncodingService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ReturnLabelToUtilEncodingServiceBridge($this->utilEncodingServiceMock);
    }

    /**
     * @return void
     */
    public function testEncodeJson(): void
    {
        $this->utilEncodingServiceMock->expects(static::atLeastOnce())
            ->method('encodeJson')
            ->with(['foo' => 'bar'])
            ->willReturn('{"foo":"bar"}');

        static::assertIsString($this->bridge->encodeJson(['foo' => 'bar']));
    }
}
