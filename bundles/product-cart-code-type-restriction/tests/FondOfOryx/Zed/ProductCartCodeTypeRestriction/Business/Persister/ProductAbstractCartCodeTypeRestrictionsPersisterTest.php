<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractCartCodeTypeRestrictionsPersisterTest extends Unit
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
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister\ProductAbstractCartCodeTypeRestrictionsPersister
     */
    protected $productAbstractCartCodeTypeRestrictionsPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractCartCodeTypeRestrictionsPersister = new ProductAbstractCartCodeTypeRestrictionsPersister(
            $this->repositoryMock,
            $this->entityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testPersist(): void
    {
        $idProductAbstract = 1;
        $currentCartCodeTypeIds = [1, 2];
        $newCartCodeTypeIds = [2, 3];

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($idProductAbstract);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedCartCodeTypeIdsByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($currentCartCodeTypeIds);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCartCodeTypeIds')
            ->willReturn($newCartCodeTypeIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteProductAbstractCartCodeTypeRestrictions')
            ->with(
                $idProductAbstract,
                static::callback(
                    static function (array $cartCodeTypeIds) use ($currentCartCodeTypeIds) {
                        return count($cartCodeTypeIds) === 1
                            && $cartCodeTypeIds[0] === $currentCartCodeTypeIds[0];
                    },
                ),
            );

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createProductAbstractCartCodeTypeRestriction')
            ->with(
                static::callback(
                    static function (
                        ProductAbstractCartCodeTypeRestrictionTransfer $productAbstractCartCodeTypeRestrictionTransfer
                    ) use (
                        $idProductAbstract,
                        $newCartCodeTypeIds
                    ) {
                        return $productAbstractCartCodeTypeRestrictionTransfer->getIdProductAbstract() === $idProductAbstract
                            && $productAbstractCartCodeTypeRestrictionTransfer->getIdCartCodeType() === $newCartCodeTypeIds[1];
                    },
                ),
            );

        $this->productAbstractCartCodeTypeRestrictionsPersister->persist($this->productAbstractTransferMock);
    }

    /**
     * @return void
     */
    public function testPersistWithInvalidProductAbstractTransfer(): void
    {
        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
            ->method('findBlacklistedCartCodeTypeIdsByIdProductAbstract');

        $this->productAbstractTransferMock->expects(static::never())
            ->method('getBlacklistedCartCodeTypeIds');

        $this->entityManagerMock->expects(static::never())
            ->method('deleteProductAbstractCartCodeTypeRestrictions');

        $this->entityManagerMock->expects(static::never())
            ->method('createProductAbstractCartCodeTypeRestriction');

        $this->productAbstractCartCodeTypeRestrictionsPersister->persist($this->productAbstractTransferMock);
    }
}
