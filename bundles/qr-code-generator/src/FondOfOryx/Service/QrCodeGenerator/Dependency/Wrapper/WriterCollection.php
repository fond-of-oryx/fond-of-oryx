<?php

namespace FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper;

use Closure;
use Endroid\QrCode\Writer\BinaryWriter;
use Endroid\QrCode\Writer\DebugWriter;
use Endroid\QrCode\Writer\EpsWriter;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Writer\WriterInterface;
use Exception;

class WriterCollection implements WriterCollectionInterface
{
    /**
     * @var string
     */
    protected const PNG = 'png';

    /**
     * @var string
     */
    protected const SVG = 'svg';

    /**
     * @var string
     */
    protected const BINARY = 'binary';

    /**
     * @var string
     */
    protected const EPS = 'eps';

    /**
     * @var string
     */
    protected const PDF = 'pdf';

    /**
     * @var string
     */
    protected const DEBUG = 'debug';

    /**
     * @var array<\Closure>|array<\Endroid\QrCode\Writer\WriterInterface>
     */
    protected $writer = [];

    /**
     * @param array<\Endroid\QrCode\Writer\WriterInterface> $writerBag
     */
    public function __construct(array $writerBag)
    {
        $this->init($writerBag);
    }

    /**
     * @param array<\Endroid\QrCode\Writer\WriterInterface> $writerBag
     *
     * @return void
     */
    protected function init(array $writerBag): void
    {
        $self = $this;
        $this->writer = [
            static::PNG => static function () use ($self) {
                return $self->createPngWriter();
            },
            static::SVG => static function () use ($self) {
                return $self->createSvgWriter();
            },
            static::BINARY => static function () use ($self) {
                return $self->createBinaryWriter();
            },
            static::EPS => static function () use ($self) {
                return $self->createEpsWriter();
            },
            static::PDF => static function () use ($self) {
                return $self->createPdfWriter();
            },
            static::DEBUG => static function () use ($self) {
                return $self->createDebugWriter();
            },
        ];

        foreach ($writerBag as $name => $writer) {
            $this->add($name, $writer);
        }
    }

    /**
     * @param string $name
     * @param \Endroid\QrCode\Writer\WriterInterface $writer
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollectionInterface
     */
    public function add(string $name, WriterInterface $writer): WriterCollectionInterface
    {
        $this->writer[$name] = $writer;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->writer);
    }

    /**
     * @param string $name
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    public function get(string $name): WriterInterface
    {
        if ($this->has($name)) {
            $writer = $this->writer[$name];
            if ($writer instanceof Closure) {
                return $writer();
            }

            return $writer;
        }

        throw new Exception(sprintf('Writer with name "%s" not known! Available writer %s', $name, implode(',', array_keys($this->writer))));
    }

    /**
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    protected function createPngWriter(): WriterInterface
    {
        return new PngWriter();
    }

    /**
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    protected function createSvgWriter(): WriterInterface
    {
        return new SvgWriter();
    }

    /**
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    protected function createBinaryWriter(): WriterInterface
    {
        return new BinaryWriter();
    }

    /**
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    protected function createEpsWriter(): WriterInterface
    {
        return new EpsWriter();
    }

    /**
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    protected function createPdfWriter(): WriterInterface
    {
        return new PdfWriter();
    }

    /**
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    protected function createDebugWriter(): WriterInterface
    {
        return new DebugWriter();
    }
}
