<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConstants;

class ProductDefaultCategoryAssignerConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productDefaultCategoryAssignerConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productDefaultCategoryAssignerConfig = $this->getMockBuilder(ProductDefaultCategoryAssignerConfig::class)
            ->onlyMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetDefaultCategoryId(): void
    {
        $this->productDefaultCategoryAssignerConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductDefaultCategoryAssignerConstants::DEFAULT_CATEGORY_ID, 0)
            ->willReturn(0);

        static::assertEquals(null, $this->productDefaultCategoryAssignerConfig->getDefaultCategoryId());
    }

    /**
     * @return void
     */
    public function testGetDefaultCategoryIdWithCustomValue(): void
    {
        $this->productDefaultCategoryAssignerConfig->expects(static::atLeastOnce())
            ->method('get')
            ->with(ProductDefaultCategoryAssignerConstants::DEFAULT_CATEGORY_ID, 0)
            ->willReturn(1);

        static::assertEquals(1, $this->productDefaultCategoryAssignerConfig->getDefaultCategoryId());
    }
}
