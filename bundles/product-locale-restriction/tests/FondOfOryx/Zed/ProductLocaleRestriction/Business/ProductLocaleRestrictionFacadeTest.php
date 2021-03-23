<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractExpanderInterface;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractLocaleRestrictionsPersisterInterface;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepository;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductLocaleRestrictionFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractExpanderMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractLocaleRestrictionsPersisterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractLocaleRestrictionsPersisterMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacade
     */
    protected $productLocaleRestrictionFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductLocaleRestrictionBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductLocaleRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractExpanderMock = $this->getMockBuilder(ProductAbstractExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractLocaleRestrictionsPersisterMock = $this->getMockBuilder(ProductAbstractLocaleRestrictionsPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionFacade = new ProductLocaleRestrictionFacade();
        $this->productLocaleRestrictionFacade->setFactory($this->factoryMock);
        $this->productLocaleRestrictionFacade->setRepository($this->repositoryMock);
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
            $this->productLocaleRestrictionFacade->expandProductAbstract($this->productAbstractTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testPersistProductAbstractLocaleRestrictions(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractLocaleRestrictionsPersister')
            ->willReturn($this->productAbstractLocaleRestrictionsPersisterMock);

        $this->productAbstractLocaleRestrictionsPersisterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->productAbstractTransferMock);

        $this->productLocaleRestrictionFacade->persistProductAbstractLocaleRestrictions(
            $this->productAbstractTransferMock
        );
    }

    /**
     * @return void
     */
    public function testGetBlacklistedLocaleIdsByProductAbstractIds(): void
    {
        $productAbstractIds = [1, 2];
        $blacklistedLocaleIds = [2, 4];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedLocaleIdsByProductAbstractIds')
            ->with($productAbstractIds)
            ->willReturn($blacklistedLocaleIds);

        static::assertEquals(
            $blacklistedLocaleIds,
            $this->productLocaleRestrictionFacade->getBlacklistedLocaleIdsByProductAbstractIds(
                $productAbstractIds
            )
        );
    }
}
