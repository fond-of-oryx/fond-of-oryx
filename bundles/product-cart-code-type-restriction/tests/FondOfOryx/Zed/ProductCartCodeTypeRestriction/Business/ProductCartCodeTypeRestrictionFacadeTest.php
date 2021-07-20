<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander\ProductAbstractExpanderInterface;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister\ProductAbstractCartCodeTypeRestrictionsPersisterInterface;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepository;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductCartCodeTypeRestrictionFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander\ProductAbstractExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractExpanderMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister\ProductAbstractCartCodeTypeRestrictionsPersisterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractCartCodeTypeRestrictionsPersisterMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacade
     */
    protected $productCartCodeTypeRestrictionFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractExpanderMock = $this->getMockBuilder(ProductAbstractExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractCartCodeTypeRestrictionsPersisterMock = $this->getMockBuilder(ProductAbstractCartCodeTypeRestrictionsPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productCartCodeTypeRestrictionFacade = new ProductCartCodeTypeRestrictionFacade();
        $this->productCartCodeTypeRestrictionFacade->setFactory($this->factoryMock);
        $this->productCartCodeTypeRestrictionFacade->setRepository($this->repositoryMock);
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
            $this->productCartCodeTypeRestrictionFacade->expandProductAbstract($this->productAbstractTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testPersistProductAbstractCartCodeTypeRestrictions(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createProductAbstractCartCodeTypeRestrictionsPersister')
            ->willReturn($this->productAbstractCartCodeTypeRestrictionsPersisterMock);

        $this->productAbstractCartCodeTypeRestrictionsPersisterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->productAbstractTransferMock);

        $this->productCartCodeTypeRestrictionFacade->persistProductAbstractCartCodeTypeRestrictions(
            $this->productAbstractTransferMock
        );
    }

    /**
     * @return void
     */
    public function testGetBlacklistedCartCodeTypesByProductConcreteSkus(): void
    {
        $productConcreteSkus = ['FOO-1', 'FOO-2'];
        $blacklistedCartCodeTypes = ['FOO-1' => ['gift card', 'voucher']];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedCartCodeTypesByProductConcreteSkus')
            ->with($productConcreteSkus)
            ->willReturn($blacklistedCartCodeTypes);

        static::assertEquals(
            $blacklistedCartCodeTypes,
            $this->productCartCodeTypeRestrictionFacade->getBlacklistedCartCodeTypesByProductConcreteSkus(
                $productConcreteSkus
            )
        );
    }
}
