<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $localeTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractExpander
     */
    protected $productAbstractExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductLocaleRestrictionRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMocks = [
            $this->getMockBuilder(LocaleTransfer::class)
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
        $idLocale = 1;

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($idProductAbstract);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findLocaleBlacklistByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($this->localeTransferMocks);

        $this->localeTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdLocale')
            ->willReturn($idLocale);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedLocales')
            ->with(
                static::callback(
                    static function (ArrayObject $blacklistedLocales) use ($idLocale) {
                        return $blacklistedLocales->count() === 1
                            && $blacklistedLocales->offsetGet(0)->getIdLocale() === $idLocale;
                    }
                )
            )->willReturn($this->productAbstractTransferMock);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedLocaleIds')
            ->with([$idLocale])->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->productAbstractExpander->expand($this->productAbstractTransferMock)
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
            ->method('findLocaleBlacklistByIdProductAbstract');

        $this->productAbstractTransferMock->expects(static::never())
            ->method('setBlacklistedLocales')
            ->willReturn($this->productAbstractTransferMock);

        $this->productAbstractTransferMock->expects(static::never())
            ->method('setBlacklistedLocaleIds')
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->productAbstractExpander->expand($this->productAbstractTransferMock)
        );
    }
}
