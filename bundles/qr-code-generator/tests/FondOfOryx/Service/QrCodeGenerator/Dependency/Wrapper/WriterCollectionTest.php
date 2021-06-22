<?php

namespace FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper;

use Codeception\Test\Unit;
use Endroid\QrCode\Writer\WriterInterface;
use Exception;

class WriterCollectionTest extends Unit
{
    /**
     * @var \Endroid\QrCode\Writer\WriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $writerMock;

    /**
     * @var \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollectionInterface
     */
    protected $writerCollection;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->writerMock = $this->getMockBuilder(WriterInterface::class)->disableOriginalConstructor()->getMock();

        $this->writerCollection = new WriterCollection([]);
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->writerCollection->add('test', $this->writerMock);
        static::assertTrue($this->writerCollection->has('test'));
    }

    /**
     * @return void
     */
    public function testHasWillReturnFalse(): void
    {
        static::assertFalse($this->writerCollection->has('falseTest'));
    }

    /**
     * @return void
     */
    public function testGetFromClosure(): void
    {
        static::assertInstanceOf(WriterInterface::class, $this->writerCollection->get('png'));
        static::assertInstanceOf(WriterInterface::class, $this->writerCollection->get('pdf'));
        static::assertInstanceOf(WriterInterface::class, $this->writerCollection->get('binary'));
        static::assertInstanceOf(WriterInterface::class, $this->writerCollection->get('svg'));
        static::assertInstanceOf(WriterInterface::class, $this->writerCollection->get('eps'));
        static::assertInstanceOf(WriterInterface::class, $this->writerCollection->get('debug'));
    }

    /**
     * @return void
     */
    public function testGetWillThrowException(): void
    {
        $exception = null;
        try {
            $this->writerCollection->get('throwExceptionTest');
        } catch (Exception $e) {
            $exception = $e;
        }

        $compare = 'Writer with name "throwExceptionTest" not known!';
        static::assertNotNull($exception);
        static::assertSame($compare, substr($exception->getMessage(), 0, strlen($compare)));
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->writerCollection->add('test', $this->writerMock);
        static::assertSame($this->writerMock, $this->writerCollection->get('test'));
    }

    /**
     * @return void
     */
    public function testInitAddFromConstructor(): void
    {
        $writerCollection = new WriterCollection(['test' => $this->writerMock]);
        static::assertTrue($writerCollection->has('test'));
    }
}
