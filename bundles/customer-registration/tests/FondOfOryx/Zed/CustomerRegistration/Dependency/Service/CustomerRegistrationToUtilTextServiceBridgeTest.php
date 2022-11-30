<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Service;

use Codeception\Test\Unit;
use Spryker\Service\UtilText\UtilTextServiceInterface;

class CustomerRegistrationToUtilTextServiceBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface
     */
    protected $service;

    /**
     * @var \Spryker\Service\UtilText\UtilTextServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilTextServiceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->utilTextServiceMock = $this->getMockBuilder(UtilTextServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new CustomerRegistrationToUtilTextServiceBridge(
            $this->utilTextServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testGenerateRandomString(): void
    {
        $this->utilTextServiceMock->expects(static::atLeastOnce())->method('generateRandomString')->willReturn('foobar');

        $this->service->generateRandomString(99);
    }
}
