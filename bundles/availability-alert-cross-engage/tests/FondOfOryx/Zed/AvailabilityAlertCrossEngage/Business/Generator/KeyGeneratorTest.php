<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Generator;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig;

class KeyGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Generator\KeyGenerator
     */
    protected $generator;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(AvailabilityAlertCrossEngageConfig::class)->disableOriginalConstructor()->getMock();

        $this->generator = new KeyGenerator($this->configMock);
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->configMock->expects(static::once())->method('getSalt')->willReturn('test');
        $string = 'test';
        $validationKey = '28e123b2d8041c081a9bab3efe9c31d3fb80f1c0';

        $key = $this->generator->generate($string);

        static::assertSame($validationKey, $key);
    }

    /**
     * @return void
     */
    public function testGenerateInvalid(): void
    {
        $this->configMock->expects(static::once())->method('getSalt')->willReturn('test');
        $string = 'test';
        $validationKey = 'mismatch';

        $key = $this->generator->generate($string);

        static::assertNotEquals($validationKey, $key);
    }
}
