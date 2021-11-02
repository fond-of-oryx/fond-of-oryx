<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface;
use Generated\Shared\Transfer\CartCodeTypeTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var array<\PHPUnit\Framework\MockObject\MockObject>|array<\Generated\Shared\Transfer\CartCodeTypeTransfer>
     */
    protected $cartCodeTypeMocks;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander\ProductAbstractExpander
     */
    protected $productAbstractExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartCodeTypeMocks = [
            $this->getMockBuilder(CartCodeTypeTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productAbstractExpander = new ProductAbstractExpander($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idProductAbstract = 1;
        $idCartCodeType = 1;

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($idProductAbstract);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedCartCodeTypeByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($this->cartCodeTypeMocks);

        $this->cartCodeTypeMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCartCodeType')
            ->willReturn($idCartCodeType);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedCartCodeTypes')
            ->with(
                static::callback(
                    static function (ArrayObject $blacklistedCartCodeTypes) use ($idCartCodeType) {
                        return $blacklistedCartCodeTypes->count() === 1
                            && $blacklistedCartCodeTypes->offsetGet(0)->getIdCartCodeType() === $idCartCodeType;
                    },
                ),
            )->willReturn($this->productAbstractTransferMock);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedCartCodeTypeIds')
            ->with([$idCartCodeType])->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->productAbstractExpander->expand($this->productAbstractTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithInvalidProductAbstractTransfer(): void
    {
        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
            ->method('findBlacklistedCartCodeTypeByIdProductAbstract');

        $this->productAbstractTransferMock->expects(static::never())
            ->method('setBlacklistedCartCodeTypes')
            ->willReturn($this->productAbstractTransferMock);

        $this->productAbstractTransferMock->expects(static::never())
            ->method('setBlacklistedCartCodeTypeIds')
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->productAbstractExpander->expand($this->productAbstractTransferMock),
        );
    }
}
