<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig;
use FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

class FullTextBoostedMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ErpOrderPageSearchConfig|MockObject $configMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected FullTextExpanderPluginInterface|MockObject $fullTextExpanderPluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper\FullTextBoostedMapper
     */
    protected FullTextBoostedMapper $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpOrderPageSearchConfig::class)
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
