<?php

namespace FondOfOryx\Client\ProductPageSearchAttributeExpander;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConstants;

class ProductPageSearchAttributeExpanderConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productPageSearchAttributeExpanderConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productPageSearchAttributeExpanderConfig = $this->getMockBuilder(ProductPageSearchAttributeExpanderConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetDefaultSortableIntegerAttributes(): void
    {
        $this->productPageSearchAttributeExpanderConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                ProductPageSearchAttributeExpanderConstants::SORTABLE_INTEGER_ATTRIBUTES,
                ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_INTEGER_ATTRIBUTES,
            )->willReturn(ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_INTEGER_ATTRIBUTES);

        static::assertEquals(
            ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_INTEGER_ATTRIBUTES,
            $this->productPageSearchAttributeExpanderConfig->getSortableIntegerAttributes(),
        );
    }

    /**
     * @return void
     */
    public function testGetSortableIntegerAttributes(): void
    {
        $this->productPageSearchAttributeExpanderConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                ProductPageSearchAttributeExpanderConstants::SORTABLE_INTEGER_ATTRIBUTES,
                ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_INTEGER_ATTRIBUTES,
            )->willReturn(['foo']);

        static::assertEquals(
            ['foo'],
            $this->productPageSearchAttributeExpanderConfig->getSortableIntegerAttributes(),
        );
    }

    /**
     * @return void
     */
    public function testGetDefaultSortableStringAttributes(): void
    {
        $this->productPageSearchAttributeExpanderConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                ProductPageSearchAttributeExpanderConstants::SORTABLE_STRING_ATTRIBUTES,
                ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_STRING_ATTRIBUTES,
            )->willReturn(ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_STRING_ATTRIBUTES);

        static::assertEquals(
            ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_STRING_ATTRIBUTES,
            $this->productPageSearchAttributeExpanderConfig->getSortableStringAttributes(),
        );
    }

    /**
     * @return void
     */
    public function testGetSortableStringAttributes(): void
    {
        $this->productPageSearchAttributeExpanderConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(
                ProductPageSearchAttributeExpanderConstants::SORTABLE_STRING_ATTRIBUTES,
                ProductPageSearchAttributeExpanderConstants::DEFAULT_SORTABLE_STRING_ATTRIBUTES,
            )->willReturn(['bar']);

        static::assertEquals(
            ['bar'],
            $this->productPageSearchAttributeExpanderConfig->getSortableStringAttributes(),
        );
    }
}
