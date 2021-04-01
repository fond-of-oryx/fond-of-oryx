<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractRestrictionReaderInterface;

class ProductLocaleRestrictionStorageClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractRestrictionReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractRestrictionReaderMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageClient
     */
    protected $productLocaleRestrictionStorageClient;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductLocaleRestrictionStorageFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractRestrictionReaderMock = $this->getMockBuilder(ProductAbstractRestrictionReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageClient = new ProductLocaleRestrictionStorageClient();
        $this->productLocaleRestrictionStorageClient->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testIsProductAbstractRestricted(): void
    {
        $idProductAbstract = 1;

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractRestrictionReader')
            ->willReturn($this->productAbstractRestrictionReaderMock);

        $this->productAbstractRestrictionReaderMock->expects(static::atLeastOnce())
            ->method('isRestricted')
            ->with($idProductAbstract)
            ->willReturn(true);

        static::assertTrue(
            $this->productLocaleRestrictionStorageClient->isProductAbstractRestricted($idProductAbstract)
        );
    }
}
