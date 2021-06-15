<?php

namespace FondOfOryx\Service\CrossEngage\Model\Generator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Service\CrossEngage\CrossEngageConfig;

class HashGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Service\CrossEngage\CrossEngageConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Service\CrossEngage\Model\Generator\HashGeneratorInterface
     */
    protected $generator;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CrossEngageConfig::class)->disableOriginalConstructor()->getMock();

        $this->generator = new HashGenerator($this->configMock);
    }

    /**
     * @return void
     */
    public function testGenerate(): void
    {
        $this->configMock->expects(static::once())->method('getModifyIn')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierIn')->willReturn('lower');
        $this->configMock->expects(static::once())->method('getHashAlgo')->willReturn('sha1');
        $this->configMock->expects(static::once())->method('getModifyOut')->willReturn(false);
        $this->configMock->expects(static::never())->method('getModifierOut');

        $hash = $this->generator->generate('Test');

        static::assertSame(sha1('test'), $hash);
    }

    /**
     * @return void
     */
    public function testGenerateWithModifyOut(): void
    {
        $this->configMock->expects(static::once())->method('getModifyIn')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierIn')->willReturn('lower');
        $this->configMock->expects(static::once())->method('getHashAlgo')->willReturn('sha1');
        $this->configMock->expects(static::once())->method('getModifyOut')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierOut')->willReturn('lower');

        $hash = $this->generator->generate('Test');

        static::assertSame(strtolower(sha1('test')), $hash);
    }

    /**
     * @return void
     */
    public function testGenerateWithMd5(): void
    {
        $this->configMock->expects(static::once())->method('getModifyIn')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierIn')->willReturn('lower');
        $this->configMock->expects(static::once())->method('getHashAlgo')->willReturn('md5');
        $this->configMock->expects(static::once())->method('getModifyOut')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierOut')->willReturn('lower');

        $hash = $this->generator->generate('Test');

        static::assertSame(strtolower(md5('test')), $hash);
    }

    /**
     * @return void
     */
    public function testGenerateWithHigher(): void
    {
        $this->configMock->expects(static::once())->method('getModifyIn')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierIn')->willReturn('upper');
        $this->configMock->expects(static::once())->method('getHashAlgo')->willReturn('md5');
        $this->configMock->expects(static::once())->method('getModifyOut')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierOut')->willReturn('upper');

        $hash = $this->generator->generate('Test');

        static::assertSame(strtoupper(md5('TEST')), $hash);
    }

    /**
     * @return void
     */
    public function testGenerateUnknownModifier(): void
    {
        $this->configMock->expects(static::once())->method('getModifyIn')->willReturn(true);
        $this->configMock->expects(static::once())->method('getModifierIn')->willReturn('test');

        $catch = null;
        try {
            $this->generator->generate('Test');
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
        static::assertSame('Modifier "test" not found in available modifier list (lower, upper)', $catch->getMessage());
    }
}
