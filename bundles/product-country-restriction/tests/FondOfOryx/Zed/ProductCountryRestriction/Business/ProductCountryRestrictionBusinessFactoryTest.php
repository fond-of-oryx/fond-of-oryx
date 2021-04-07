<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractCountryRestrictionsPersister;
use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractExpander;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManager;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepository;

class ProductCountryRestrictionBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionBusinessFactory
     */
    protected $productCountryRestrictionBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductCountryRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductCountryRestrictionEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionBusinessFactory = new ProductCountryRestrictionBusinessFactory();
        $this->productCountryRestrictionBusinessFactory->setRepository($this->repositoryMock);
        $this->productCountryRestrictionBusinessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractExpander(): void
    {
        static::assertInstanceOf(
            ProductAbstractExpander::class,
            $this->productCountryRestrictionBusinessFactory->createProductAbstractExpander()
        );
    }

    /**
     * @return void
     */
    public function testCreateProductAbstractCountryRestrictionsPersister(): void
    {
        static::assertInstanceOf(
            ProductAbstractCountryRestrictionsPersister::class,
            $this->productCountryRestrictionBusinessFactory->createProductAbstractCountryRestrictionsPersister()
        );
    }
}
