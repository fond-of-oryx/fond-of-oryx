<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander\ProductAbstractExpander;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister\ProductAbstractCartCodeTypeRestrictionsPersister;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManager;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepository;

class ProductCartCodeTypeRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionBusinessFactory
     */
    protected $productCartCodeTypeRestrictionBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCartCodeTypeRestrictionBusinessFactory = new ProductCartCodeTypeRestrictionBusinessFactory();
        $this->productCartCodeTypeRestrictionBusinessFactory->setRepository($this->repositoryMock);
        $this->productCartCodeTypeRestrictionBusinessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractExpander(): void
    {
        static::assertInstanceOf(
            ProductAbstractExpander::class,
            $this->productCartCodeTypeRestrictionBusinessFactory->createProductAbstractExpander(),
        );
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractCartCodeTypeRestrictionsPersister(): void
    {
        static::assertInstanceOf(
            ProductAbstractCartCodeTypeRestrictionsPersister::class,
            $this->productCartCodeTypeRestrictionBusinessFactory->createProductAbstractCartCodeTypeRestrictionsPersister(),
        );
    }
}
