<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Encoder;

use Codeception\Test\Unit;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class CustomerRegistrationToPasswordEncoderBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Encoder\CustomerRegistrationToPasswordEncoderInterface
     */
    protected $encoder;

    /**
     * @var \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $passwordEncoderMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->passwordEncoderMock = $this->getMockBuilder(PasswordEncoderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->encoder = new CustomerRegistrationToPasswordEncoderBridge(
            $this->passwordEncoderMock,
        );
    }

    /**
     * @return void
     */
    public function testEncodePassword(): void
    {
        $this->passwordEncoderMock->expects(static::atLeastOnce())->method('encodePassword')->willReturn('srgvbasde');

        $this->encoder->encodePassword('foobar');
    }
}
