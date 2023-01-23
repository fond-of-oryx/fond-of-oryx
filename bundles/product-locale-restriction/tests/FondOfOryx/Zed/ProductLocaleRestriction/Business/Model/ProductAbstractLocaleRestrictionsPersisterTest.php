<?php

/**
 * phpcs:disable SlevomatCodingStandard.Functions.DisallowTrailingCommaInClosureUse
 */

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManagerInterface;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractLocaleRestrictionsPersisterTest extends Unit
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
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractLocaleRestrictionsPersister
     */
    protected $productAbstractLocaleRestrictionsPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductLocaleRestrictionRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductLocaleRestrictionEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractLocaleRestrictionsPersister = new ProductAbstractLocaleRestrictionsPersister(
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
        $currentLocaleIds = [1, 2];
        $newLocaleIds = [2, 3];

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($idProductAbstract);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedLocaleIdsByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($currentLocaleIds);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocaleIds')
            ->willReturn($newLocaleIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteProductAbstractLocaleRestrictions')
            ->with(
                $idProductAbstract,
                static::callback(
                    static function (array $idLocales) use ($currentLocaleIds) {
                        return count($idLocales) === 1
                            && $idLocales[0] === $currentLocaleIds[0];
                    },
                ),
            );

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createProductAbstractLocaleRestriction')
            ->with(
                static::callback(
                    static function (
                        ProductAbstractLocaleRestrictionTransfer $productAbstractLocaleRestrictionTransfer
                    ) use (
                        $idProductAbstract,
                        $newLocaleIds,
                    ) {
                        return $productAbstractLocaleRestrictionTransfer->getIdProductAbstract() === $idProductAbstract
                            && $productAbstractLocaleRestrictionTransfer->getIdLocale() === $newLocaleIds[1];
                    },
                ),
            );

        $this->productAbstractLocaleRestrictionsPersister->persist($this->productAbstractTransferMock);
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
            ->method('findBlacklistedLocaleIdsByIdProductAbstract');

        $this->productAbstractTransferMock->expects(static::never())
            ->method('getBlacklistedLocaleIds');

        $this->entityManagerMock->expects(static::never())
            ->method('deleteProductAbstractLocaleRestrictions');

        $this->entityManagerMock->expects(static::never())
            ->method('createProductAbstractLocaleRestriction');

        $this->productAbstractLocaleRestrictionsPersister->persist($this->productAbstractTransferMock);
    }
}
