<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface;

class PasswordGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Service\CustomerRegistrationToUtilTextServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilTextServiceMock;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->utilTextServiceMock = $this->getMockBuilder(CustomerRegistrationToUtilTextServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->generator = new PasswordGenerator(
            $this->utilTextServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testGenerateRandomString(): void
    {
        $this->utilTextServiceMock->expects(static::once())->method('generateRandomString')->willReturn('randomstring');
        $this->assertSame('randomstring', $this->generator->generateRandomString());
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->assertSame(20, strlen($this->generator->generate()));
    }

    /**
     * @return void
     */
    public function testGenerateCustomLength(): void
    {
        $this->assertSame(40, strlen($this->generator->generate(40)));
    }

    /**
     * @return void
     */
    public function testGenerateWithCustomKeySpace(): void
    {
        $keySpace = '1234ABCD';
        $arrayKeySpace = str_split($keySpace, 1);
        $password = $this->generator->generate(99, $keySpace);
        $this->assertSame(99, strlen($password));

        foreach (str_split($password, 1) as $char) {
            static::assertContains($char, $arrayKeySpace);
        }
    }
}
