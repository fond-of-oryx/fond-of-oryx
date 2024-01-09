<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig;
use FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface;
use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

class FullTextMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ErpDeliveryNotePageSearchConfig|MockObject $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface
     */
    protected MockObject|FullTextExpanderPluginInterface $fullTextExpanderPluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper\FullTextMapper
     */
    protected FullTextMapper $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(ErpDeliveryNotePageSearchConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fullTextExpanderPluginMock = $this->getMockBuilder(FullTextExpanderPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new FullTextMapper(
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
            ->method('getFullTextFields')
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
