<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Model;

use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface;
use FondOfOryx\Shared\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig;
use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;

class ProductAbstractLocaleRestrictionStorageReader implements ProductAbstractLocaleRestrictionStorageReaderInterface
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface
     */
    protected $storageClient;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface
     */
    protected $synchronizationService;

    /**
     * @param \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToStorageClientInterface $storageClient
     * @param \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Service\ProductLocaleRestrictionStorageToSynchronizationServiceInterface $synchronizationService
     */
    public function __construct(
        ProductLocaleRestrictionStorageToStorageClientInterface $storageClient,
        ProductLocaleRestrictionStorageToSynchronizationServiceInterface $synchronizationService
    ) {
        $this->storageClient = $storageClient;
        $this->synchronizationService = $synchronizationService;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer|null
     */
    public function getByIdProductAbstract(int $idProductAbstract): ?ProductAbstractLocaleRestrictionStorageTransfer
    {
        $key = $this->generateKey($idProductAbstract);
        $productAbstractLocaleRestrictionStorageData = $this->storageClient->get($key);

        if (!$productAbstractLocaleRestrictionStorageData) {
            return null;
        }

        return $this->mapProductAbstractLocaleRestrictionStorage($productAbstractLocaleRestrictionStorageData);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return string
     */
    protected function generateKey(int $idProductAbstract): string
    {
        $synchronizationDataTransfer = (new SynchronizationDataTransfer())
            ->setReference((string)$idProductAbstract);

        return $this->synchronizationService
            ->getStorageKeyBuilder(ProductLocaleRestrictionStorageConfig::PRODUCT_ABSTRACT_LOCALE_RESTRICTION_RESOURCE_NAME)
            ->generateKey($synchronizationDataTransfer);
    }

    /**
     * @param array $productAbstractLocaleRestrictionStorageData
     *
     * @return \Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer
     */
    protected function mapProductAbstractLocaleRestrictionStorage(
        array $productAbstractLocaleRestrictionStorageData
    ): ProductAbstractLocaleRestrictionStorageTransfer {
        return (new ProductAbstractLocaleRestrictionStorageTransfer())->fromArray(
            $productAbstractLocaleRestrictionStorageData,
            true,
        );
    }

    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<\Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer>
     */
    public function getByProductAbstractIds(array $productAbstractIds): array
    {
        $productAbstractLocaleRestrictionStorageKeys = $this->generateProductAbstractLocaleRestrictionStorageKeys($productAbstractIds);
        $productAbstractLocaleRestrictionStorageData = $this->storageClient->getMulti($productAbstractLocaleRestrictionStorageKeys);

        return $this->mapProductAbstractLocaleRestrictionTransfers($productAbstractLocaleRestrictionStorageData);
    }

    /**
     * @param array<int> $productAbstractIds
     *
     * @return array<string>
     */
    protected function generateProductAbstractLocaleRestrictionStorageKeys(array $productAbstractIds): array
    {
        $productAbstractLocaleRestrictionStorageKeys = [];

        foreach ($productAbstractIds as $idProductAbstract) {
            $productAbstractLocaleRestrictionStorageKeys[] = $this->generateKey($idProductAbstract);
        }

        return $productAbstractLocaleRestrictionStorageKeys;
    }

    /**
     * @param array $productAbstractLocaleRestrictionStorageData
     *
     * @return array<\Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer>
     */
    protected function mapProductAbstractLocaleRestrictionTransfers(array $productAbstractLocaleRestrictionStorageData): array
    {
        $productAbstractLocaleRestrictionStorageTransfers = [];

        foreach ($productAbstractLocaleRestrictionStorageData as $data) {
            if (!$data) {
                continue;
            }

            $productAbstractLocaleRestrictionStorageTransfers[] = $this->mapProductAbstractLocaleRestrictionStorage(
                json_decode($data, true),
            );
        }

        return $productAbstractLocaleRestrictionStorageTransfers;
    }
}
