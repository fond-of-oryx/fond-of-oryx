<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractCountryRestrictionsPersisterTest extends Unit
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
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractCountryRestrictionsPersister
     */
    protected $productAbstractCountryRestrictionsPersister;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductCountryRestrictionRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(ProductCountryRestrictionEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractCountryRestrictionsPersister = new ProductAbstractCountryRestrictionsPersister(
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
        $currentCountryIds = [1, 2];
        $newCountryIds = [2, 3];

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($idProductAbstract);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedCountryIdsByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($currentCountryIds);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedCountryIds')
            ->willReturn($newCountryIds);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteProductAbstractCountryRestrictions')
            ->with(
                $idProductAbstract,
                static::callback(
                    static function (array $countryIds) use ($currentCountryIds) {
                        return count($countryIds) === 1
                            && $countryIds[0] === $currentCountryIds[0];
                    },
                ),
            );

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createProductAbstractCountryRestriction')
            ->with(
                static::callback(
                    static function (
                        ProductAbstractCountryRestrictionTransfer $productAbstractCountryRestrictionTransfer
                    ) use (
                        $idProductAbstract,
                        $newCountryIds,
                    ) {
                        return $productAbstractCountryRestrictionTransfer->getIdProductAbstract() === $idProductAbstract
                            && $productAbstractCountryRestrictionTransfer->getIdCountry() === $newCountryIds[1];
                    },
                ),
            );

        $this->productAbstractCountryRestrictionsPersister->persist($this->productAbstractTransferMock);
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
            ->method('findBlacklistedCountryIdsByIdProductAbstract');

        $this->productAbstractTransferMock->expects(static::never())
            ->method('getBlacklistedCountryIds');

        $this->entityManagerMock->expects(static::never())
            ->method('deleteProductAbstractCountryRestrictions');

        $this->entityManagerMock->expects(static::never())
            ->method('createProductAbstractCountryRestriction');

        $this->productAbstractCountryRestrictionsPersister->persist($this->productAbstractTransferMock);
    }
}
