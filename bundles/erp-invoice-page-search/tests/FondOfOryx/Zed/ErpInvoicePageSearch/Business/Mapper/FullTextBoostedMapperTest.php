<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;
use FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

class FullTextBoostedMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ErpInvoicePageSearchConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected FullTextExpanderPluginInterface|MockObject $fullTextExpanderPluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\FullTextBoostedMapper
     */
    protected FullTextBoostedMapper $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpInvoicePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fullTextExpanderPluginMock = $this->getMockBuilder(FullTextExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new FullTextBoostedMapper(
            $this->configMock,
            [$this->fullTextExpanderPluginMock],
        );
    }

    /**
     * @return void
     */
    public function testFromData(): void
    {
        $data = [
            'foo' => [
                'bar' => 'fooBar',
                'oof' => true,
                'rab' => [
                    'foo' => new stdClass(),
                    'bar' => 1.1,
                    'rab' => 1,
                    'oof' => null,
                ],
            ],
        ];

        $fields = [
            'bar',
            'foo.bar',
            'foo.oof',
            'foo.rab',
            'foo.rab.foo',
            'foo.rab.bar',
            'foo.rab.rab',
            'foo.rab.oof',
        ];

        $fullText = [
            'fooBar',
            '1.1',
            '1',
        ];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getFullTextBoostedFields')
            ->willReturn($fields);

        $this->fullTextExpanderPluginMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($data, $fullText)
            ->willReturn($fullText);

        static::assertEquals(
            $fullText,
            $this->mapper->fromData($data),
        );
    }
}
