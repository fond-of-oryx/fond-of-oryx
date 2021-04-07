<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface;
use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class ProductAbstractExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CountryTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $countryTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractExpander
     */
    protected $productAbstractExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(ProductCountryRestrictionRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMocks = [
            $this->getMockBuilder(CountryTransfer::class)
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
        $idCountry = 1;

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn($idProductAbstract);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findBlacklistedCountryByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($this->countryTransferMocks);

        $this->countryTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCountry')
            ->willReturn($idCountry);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedCountries')
            ->with(
                static::callback(
                    static function (ArrayObject $blacklistedCountries) use ($idCountry) {
                        return $blacklistedCountries->count() === 1
                            && $blacklistedCountries->offsetGet(0)->getIdCountry() === $idCountry;
                    }
                )
            )->willReturn($this->productAbstractTransferMock);

        $this->productAbstractTransferMock->expects(static::atLeastOnce())
            ->method('setBlacklistedCountryIds')
            ->with([$idCountry])->willReturn($this->productAbstractTransferMock);

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
            ->method('findBlacklistedCountryByIdProductAbstract');

        $this->productAbstractTransferMock->expects(static::never())
            ->method('setBlacklistedCountries')
            ->willReturn($this->productAbstractTransferMock);

        $this->productAbstractTransferMock->expects(static::never())
            ->method('setBlacklistedCountryIds')
            ->willReturn($this->productAbstractTransferMock);

        static::assertEquals(
            $this->productAbstractTransferMock,
            $this->productAbstractExpander->expand($this->productAbstractTransferMock)
        );
    }
}
