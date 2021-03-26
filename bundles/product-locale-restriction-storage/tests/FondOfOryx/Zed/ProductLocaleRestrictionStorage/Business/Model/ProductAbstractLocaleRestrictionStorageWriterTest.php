<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface;
use Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorage;

class ProductAbstractLocaleRestrictionStorageWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorage[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $storageEntityMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model\ProductAbstractLocaleRestrictionStorageWriter
     */
    protected $productAbstractLocaleRestrictionStorageWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ProductLocaleRestrictionStorageRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storageEntityMocks = [
            1 => $this->getMockBuilder(FooProductAbstractLocaleRestrictionStorage::class)
                ->disableOriginalConstructor()
                ->getMock(),
            3 => $this->getMockBuilder(FooProductAbstractLocaleRestrictionStorage::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productAbstractLocaleRestrictionStorageWriter = new ProductAbstractLocaleRestrictionStorageWriter(
            $this->productLocaleRestrictionFacadeMock,
            $this->repositoryMock,
            true
        );
    }

    /**
     * @return void
     */
    public function testPublish(): void
    {
        $productAbstractIds = [1, 3];
        $blacklistedLocales = [
            1 => ['de_DE', 'en_US'],
            3 => ['en_US'],
        ];

        $this->productLocaleRestrictionFacadeMock->expects(static::atLeastOnce())
            ->method('getBlacklistedLocalesByProductAbstractIds')
            ->with($productAbstractIds)
            ->willReturn($blacklistedLocales);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('findProductAbstractLocaleRestrictionStorageEntitiesByProductAbstractIds')
            ->with($productAbstractIds)
            ->willReturn($this->storageEntityMocks);

        $this->storageEntityMocks[1]->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $data) use ($blacklistedLocales) {
                        return isset($data['id_product_abstract'], $data['blacklisted_locales'])
                            && $data['id_product_abstract'] === 1
                            && $data['blacklisted_locales'] === $blacklistedLocales[1];
                    }
                )
            )->willReturn($this->storageEntityMocks[1]);

        $this->storageEntityMocks[1]->expects(static::atLeastOnce())
            ->method('setFkProductAbstract')
            ->with(1)
            ->willReturn($this->storageEntityMocks[1]);

        $this->storageEntityMocks[1]->expects(static::atLeastOnce())
            ->method('setIsSendingToQueue')
            ->with(true)
            ->willReturn($this->storageEntityMocks[1]);

        $this->storageEntityMocks[1]->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn($this->storageEntityMocks[1]);

        $this->storageEntityMocks[3]->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $data) use ($blacklistedLocales) {
                        return isset($data['id_product_abstract'], $data['blacklisted_locales'])
                            && $data['id_product_abstract'] === 3
                            && $data['blacklisted_locales'] === $blacklistedLocales[3];
                    }
                )
            )->willReturn($this->storageEntityMocks[3]);

        $this->storageEntityMocks[3]->expects(static::atLeastOnce())
            ->method('setFkProductAbstract')
            ->with(3)
            ->willReturn($this->storageEntityMocks[3]);

        $this->storageEntityMocks[3]->expects(static::atLeastOnce())
            ->method('setIsSendingToQueue')
            ->with(true)
            ->willReturn($this->storageEntityMocks[3]);

        $this->storageEntityMocks[3]->expects(static::atLeastOnce())
            ->method('save')
            ->willReturn($this->storageEntityMocks[3]);

        $this->productAbstractLocaleRestrictionStorageWriter->publish($productAbstractIds);
    }
}
