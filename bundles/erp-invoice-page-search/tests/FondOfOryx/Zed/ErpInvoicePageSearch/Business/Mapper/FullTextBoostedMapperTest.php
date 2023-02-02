<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;
use stdClass;

class FullTextBoostedMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper\FullTextBoostedMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpInvoicePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new FullTextBoostedMapper(
            $this->configMock,
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

        static::assertEquals(
            $fullText,
            $this->mapper->fromData($data),
        );
    }
}
