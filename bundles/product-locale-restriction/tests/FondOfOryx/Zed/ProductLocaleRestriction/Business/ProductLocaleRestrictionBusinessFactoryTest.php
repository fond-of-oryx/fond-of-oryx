<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractExpander;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractLocaleRestrictionsPersister;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManager;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepository;

class ProductLocaleRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionBusinessFactory
     */
    protected $productLocaleRestrictionBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductLocaleRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductLocaleRestrictionEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionBusinessFactory = new ProductLocaleRestrictionBusinessFactory();
        $this->productLocaleRestrictionBusinessFactory->setRepository($this->repositoryMock);
        $this->productLocaleRestrictionBusinessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractExpander(): void
    {
        static::assertInstanceOf(
            ProductAbstractExpander::class,
            $this->productLocaleRestrictionBusinessFactory->createProductAbstractExpander(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractLocaleRestrictionsPersister(): void
    {
        static::assertInstanceOf(
            ProductAbstractLocaleRestrictionsPersister::class,
            $this->productLocaleRestrictionBusinessFactory->createProductAbstractLocaleRestrictionsPersister(),
        );
    }
}
