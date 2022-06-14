<?php

namespace FondOfOryx\Zed\ProductListApi\Business\Model;

use FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ProductListApi implements ProductListApiInterface
{
    /**
     * @var string
     */
    public const KEY_ID_PRODUCT_LIST = 'id_product_list';

    /**
     * @var \FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ProductListApi\Persistence\ProductListApiRepositoryInterface $repository
     */
    public function __construct(
        ProductListApiRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function find(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $data = [];
        $apiCollectionTransfer = $this->repository->find($apiRequestTransfer);

        foreach ($apiCollectionTransfer->getData() as $index => $item) {
            if (!isset($item[static::KEY_ID_PRODUCT_LIST])) {
                continue;
            }

            $data[$index] = $item;
        }

        return $apiCollectionTransfer->setData($data);
    }
}
