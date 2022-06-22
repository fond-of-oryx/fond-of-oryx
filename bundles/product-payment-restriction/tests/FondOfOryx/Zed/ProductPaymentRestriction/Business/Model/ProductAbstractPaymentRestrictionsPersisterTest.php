<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionEntityManager;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractPaymentRestrictionsPersisterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepository
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionEntityManager
     */
    protected $entityManagerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractPaymentRestrictionsPersisterInterface
     */
    protected $productAbstractPaymentRestrictionsPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductPaymentRestrictionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductPaymentRestrictionEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractPaymentRestrictionsPersister = new ProductAbstractPaymentRestrictionsPersister(
            $this->repositoryMock,
            $this->entityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistNothingToUpdate(): void
    {
        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(10000);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedPaymentMethodIdsByIdProductAbstract')
            ->with(10000)
            ->willReturn([1]);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedPaymentMethodIds')
            ->willReturn([1]);

        $this->entityManagerMock->expects(static::never())
            ->method('deleteProductAbstractPaymentRestrictions');

        $this->entityManagerMock->expects(static::never())
            ->method('createProductAbstractPaymentRestriction');

        $this->productAbstractPaymentRestrictionsPersister->persist($this->productAbstractTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistCreate(): void
    {
        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(10000);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedPaymentMethodIdsByIdProductAbstract')
            ->with(10000)
            ->willReturn([1]);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedPaymentMethodIds')
            ->willReturn([1, 2]);

        $this->entityManagerMock->expects(static::never())
            ->method('deleteProductAbstractPaymentRestrictions');

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createProductAbstractPaymentRestriction');

        $this->productAbstractPaymentRestrictionsPersister->persist($this->productAbstractTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistDelete(): void
    {
        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(10000);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedPaymentMethodIdsByIdProductAbstract')
            ->with(10000)
            ->willReturn([1, 2]);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedPaymentMethodIds')
            ->willReturn([1]);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteProductAbstractPaymentRestrictions');

        $this->entityManagerMock->expects(static::never())
            ->method('createProductAbstractPaymentRestriction');

        $this->productAbstractPaymentRestrictionsPersister->persist($this->productAbstractTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistCreateAndDelete(): void
    {
        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(10000);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedPaymentMethodIdsByIdProductAbstract')
            ->with(10000)
            ->willReturn([1, 2, 3]);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedPaymentMethodIds')
            ->willReturn([3, 4, 5]);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteProductAbstractPaymentRestrictions');

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createProductAbstractPaymentRestriction');

        $this->productAbstractPaymentRestrictionsPersister->persist($this->productAbstractTransferMock);
    }
}
