<?php

namespace FondOfOryx\Zed\ProductListsRestApi\Business\Reader;

use FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface;
use FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class ProductListReader implements ProductListReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \FondOfOryx\Zed\ProductListsRestApi\Persistence\ProductListsRestApiRepositoryInterface $repository
     * @param \FondOfOryx\Zed\ProductListsRestApi\Dependency\Facade\ProductListsRestApiToProductListFacadeInterface $productListFacade
     */
    public function __construct(
        ProductListsRestApiRepositoryInterface $repository,
        ProductListsRestApiToProductListFacadeInterface $productListFacade
    ) {
        $this->repository = $repository;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer|null
     */
    public function getByRestProductListUpdateRequest(
        RestProductListUpdateRequestTransfer $restProductListUpdateRequestTransfer
    ): ?ProductListTransfer {
        $uuid = $restProductListUpdateRequestTransfer->getProductListId();

        if ($uuid === null) {
            return null;
        }

        $idProductList = $this->repository->getIdProductListByUuid($uuid);

        if ($idProductList === null) {
            return null;
        }

        $productListTransfer = (new ProductListTransfer())
            ->setIdProductList($idProductList);

        return $this->productListFacade->getProductListById($productListTransfer);
    }
}
