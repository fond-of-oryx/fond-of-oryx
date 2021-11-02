<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractCountryRestrictionsPersisterInterface;
use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractExpanderInterface;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepository;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductCountryRestrictionFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractExpanderMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractCountryRestrictionsPersisterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractCountryRestrictionsPersisterMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\ProductCountryRestrictionFacade
     */
    protected $productCountryRestrictionFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductCountryRestrictionBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductCountryRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractExpanderMock = $this->getMockBuilder(ProductAbstractExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractCountryRestrictionsPersisterMock = $this->getMockBuilder(ProductAbstractCountryRestrictionsPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCountryRestrictionFacade = new ProductCountryRestrictionFacade();
        $this->productCountryRestrictionFacade->setFactory($this->factoryMock);
        $this->productCountryRestrictionFacade->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testExpandProductAbstract(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractExpander')
            ->willReturn($this->productAbstractExpanderMock);

        $this->productAbstractExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->productAbstractTransferMock)
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->productCountryRestrictionFacade->expandProductAbstract($this->productAbstractTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testPersistProductAbstractCountryRestrictions(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractCountryRestrictionsPersister')
            ->willReturn($this->productAbstractCountryRestrictionsPersisterMock);

        $this->productAbstractCountryRestrictionsPersisterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->productAbstractTransferMock);

        $this->productCountryRestrictionFacade->persistProductAbstractCountryRestrictions(
            $this->productAbstractTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testGetBlacklistedCountriesByProductConcreteSkus(): void
    {
        $productConcreteSkus = ['FOO-1', 'FOO-2'];
        $blacklistedCountries = ['FOO-1' => ['DE', 'UK']];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedCountriesByProductConcreteSkus')
            ->with($productConcreteSkus)
            ->willReturn($blacklistedCountries);

        static::assertEquals(
            $blacklistedCountries,
            $this->productCountryRestrictionFacade->getBlacklistedCountriesByProductConcreteSkus(
                $productConcreteSkus,
            ),
        );
    }
}
