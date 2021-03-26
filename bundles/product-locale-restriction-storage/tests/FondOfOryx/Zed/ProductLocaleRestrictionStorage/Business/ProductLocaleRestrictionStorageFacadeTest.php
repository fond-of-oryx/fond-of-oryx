<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model\ProductAbstractLocaleRestrictionStorageWriterInterface;

class ProductLocaleRestrictionStorageFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model\ProductAbstractLocaleRestrictionStorageWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractLocaleRestrictionStorageWriterMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageFacade
     */
    protected $productLocaleRestrictionStorageFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductLocaleRestrictionStorageBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractLocaleRestrictionStorageWriterMock = $this->getMockBuilder(ProductAbstractLocaleRestrictionStorageWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageFacade = new ProductLocaleRestrictionStorageFacade();
        $this->productLocaleRestrictionStorageFacade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPublish(): void
    {
        $productAbstractIds = [1, 2, 3];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractLocaleRestrictionStorageWriter')
            ->willReturn($this->productAbstractLocaleRestrictionStorageWriterMock);

        $this->productAbstractLocaleRestrictionStorageWriterMock->expects(static::atLeastOnce())
            ->method('publish')
            ->with($productAbstractIds);

        $this->productLocaleRestrictionStorageFacade->publish($productAbstractIds);
    }
}
