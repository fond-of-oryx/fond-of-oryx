<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Model;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface;
use FondOfOryx\Shared\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;

class ProductAbstractLocaleRestrictionStorageReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $storageClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $synchronizationServiceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    protected $storageKeyBuilderMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Model\ProductAbstractLocaleRestrictionStorageReader
     */
    protected $productAbstractLocaleRestrictionStorageReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->storageClientMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->synchronizationServiceMock = $this->getMockBuilder(ProductLocaleRestrictionStorageToSynchronizationServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storageKeyBuilderMock = $this->getMockBuilder(SynchronizationKeyGeneratorPluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractLocaleRestrictionStorageReader = new ProductAbstractLocaleRestrictionStorageReader(
            $this->storageClientMock,
            $this->synchronizationServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testGetByIdProductAbstract(): void
    {
        $idProductAbstract = 1;
        $key = 'foo';
        $data = [
            'id_product_abstract' => $idProductAbstract,
            'blacklisted_locales' => ['de_DE'],
        ];

        $this->synchronizationServiceMock->expects(static::atLeastOnce())
            ->method('getStorageKeyBuilder')
            ->with(ProductLocaleRestrictionStorageConfig::PRODUCT_ABSTRACT_LOCALE_RESTRICTION_RESOURCE_NAME)
            ->willReturn($this->storageKeyBuilderMock);

        $this->storageKeyBuilderMock->expects(static::atLeastOnce())
            ->method('generateKey')
            ->with(
                static::callback(
                    static function (SynchronizationDataTransfer $synchronizationDataTransfer) use ($idProductAbstract) {
                        return $synchronizationDataTransfer->getReference() === (string)$idProductAbstract;
                    },
                ),
            )->willReturn($key);

        $this->storageClientMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($key)
            ->willReturn($data);

        $productAbstractLocaleRestrictionStorageTransfer = $this->productAbstractLocaleRestrictionStorageReader
            ->getByIdProductAbstract($idProductAbstract);

        static::assertEquals(
            $data['id_product_abstract'],
            $productAbstractLocaleRestrictionStorageTransfer->getIdProductAbstract(),
        );

        static::assertEquals(
            $data['blacklisted_locales'],
            $productAbstractLocaleRestrictionStorageTransfer->getBlacklistedLocales(),
        );
    }

    /**
     * @return void
     */
    public function testGetByIdProductAbstractWithoutData(): void
    {
        $idProductAbstract = 1;
        $key = 'foo';
        $data = null;

        $this->synchronizationServiceMock->expects(static::atLeastOnce())
            ->method('getStorageKeyBuilder')
            ->with(ProductLocaleRestrictionStorageConfig::PRODUCT_ABSTRACT_LOCALE_RESTRICTION_RESOURCE_NAME)
            ->willReturn($this->storageKeyBuilderMock);

        $this->storageKeyBuilderMock->expects(static::atLeastOnce())
            ->method('generateKey')
            ->with(
                static::callback(
                    static function (SynchronizationDataTransfer $synchronizationDataTransfer) use ($idProductAbstract) {
                        return $synchronizationDataTransfer->getReference() === (string)$idProductAbstract;
                    },
                ),
            )->willReturn($key);

        $this->storageClientMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($key)
            ->willReturn($data);

        $productAbstractLocaleRestrictionStorageTransfer = $this->productAbstractLocaleRestrictionStorageReader
            ->getByIdProductAbstract($idProductAbstract);

        static::assertEquals(
            null,
            $productAbstractLocaleRestrictionStorageTransfer,
        );
    }
}
