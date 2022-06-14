<?php

namespace FondOfOryx\Zed\ProductListApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductListApi\Business\Model\ProductListApiInterface;
use FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepository;
use Spryker\Zed\Kernel\Container;

class ProductListApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Business\ProductListApiBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(ProductListApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new ProductListApiBusinessFactory();
        $this->businessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateProductListApi(): void
    {
        static::assertInstanceOf(
            ProductListApiInterface::class,
            $this->businessFactory->createProductListApi(),
        );
    }
}
