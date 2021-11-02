<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Model;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface;
use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer;

class ProductAbstractRestrictionReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractLocaleRestrictionStorageReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractLocaleRestrictionStorageReaderMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productAbstractLocaleRestrictionStorageTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractRestrictionReader
     */
    protected $productAbstractRestrictionReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeClientMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToLocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractLocaleRestrictionStorageReaderMock = $this->getMockBuilder(ProductAbstractLocaleRestrictionStorageReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractLocaleRestrictionStorageTransferMock = $this->getMockBuilder(ProductAbstractLocaleRestrictionStorageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractRestrictionReader = new ProductAbstractRestrictionReader(
            $this->localeClientMock,
            $this->productAbstractLocaleRestrictionStorageReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testIsRestricted(): void
    {
        $idProductAbstract = 1;
        $currentLocale = 'de_DE';

        $this->localeClientMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($currentLocale);

        $this->productAbstractLocaleRestrictionStorageReaderMock->expects(static::atLeastOnce())
            ->method('getByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn($this->productAbstractLocaleRestrictionStorageTransferMock);

        $this->productAbstractLocaleRestrictionStorageTransferMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocales')
            ->willReturn([$currentLocale]);

        static::assertTrue($this->productAbstractRestrictionReader->isRestricted($idProductAbstract));
    }

    /**
     * @return void
     */
    public function testIsRestrictedWithoutStorageData(): void
    {
        $idProductAbstract = 1;
        $currentLocale = 'de_DE';

        $this->localeClientMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($currentLocale);

        $this->productAbstractLocaleRestrictionStorageReaderMock->expects(static::atLeastOnce())
            ->method('getByIdProductAbstract')
            ->with($idProductAbstract)
            ->willReturn(null);

        static::assertFalse($this->productAbstractRestrictionReader->isRestricted($idProductAbstract));
    }
}
