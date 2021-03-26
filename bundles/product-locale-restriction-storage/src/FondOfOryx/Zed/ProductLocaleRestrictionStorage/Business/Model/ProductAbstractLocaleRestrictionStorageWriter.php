<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model;

use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface;
use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionStorageTransfer;
use Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorage;

class ProductAbstractLocaleRestrictionStorageWriter implements ProductAbstractLocaleRestrictionStorageWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface
     */
    protected $productLocaleRestrictionFacade;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface
     */
    protected $repository;

    /**
     * @var bool
     */
    protected $isSendingToQueue;

    /**
     * @param \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface $productLocaleRestrictionFacade
     * @param \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface $repository
     * @param bool $isSendingToQueue
     */
    public function __construct(
        ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface $productLocaleRestrictionFacade,
        ProductLocaleRestrictionStorageRepositoryInterface $repository,
        bool $isSendingToQueue
    ) {
        $this->productLocaleRestrictionFacade = $productLocaleRestrictionFacade;
        $this->repository = $repository;
        $this->isSendingToQueue = $isSendingToQueue;
    }

    /**
     * @param int[] $productAbstractIds
     *
     * @return void
     */
    public function publish(array $productAbstractIds): void
    {
        $productAbstractIds = array_unique($productAbstractIds);

        $blacklistedLocales = $this->productLocaleRestrictionFacade
            ->getBlacklistedLocalesByProductAbstractIds($productAbstractIds);

        $storageEntities = $this->repository
            ->findProductAbstractLocaleRestrictionStorageEntitiesByProductAbstractIds($productAbstractIds);

        $this->storeData($blacklistedLocales, $storageEntities);
    }

    /**
     * @param array $blacklistedLocales
     * @param \Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorage[] $storageEntities
     *
     * @return void
     */
    protected function storeData(array $blacklistedLocales, array $storageEntities): void
    {
        foreach ($blacklistedLocales as $idProductAbstract => $blacklistedLocaleNames) {
            $productAbstractLocaleRestrictionStorageTransfer = (new ProductAbstractLocaleRestrictionStorageTransfer())
                ->setIdProductAbstract($idProductAbstract)
                ->setBlacklistedLocales($blacklistedLocaleNames);

            if (!isset($storageEntities[$idProductAbstract])) {
                $storageEntities[$idProductAbstract] = new FooProductAbstractLocaleRestrictionStorage();
            }

            $data = $productAbstractLocaleRestrictionStorageTransfer->modifiedToArray();

            $storageEntities[$idProductAbstract]->setData($data)
                ->setFkProductAbstract($idProductAbstract)
                ->setIsSendingToQueue($this->isSendingToQueue)
                ->save();
        }
    }
}
