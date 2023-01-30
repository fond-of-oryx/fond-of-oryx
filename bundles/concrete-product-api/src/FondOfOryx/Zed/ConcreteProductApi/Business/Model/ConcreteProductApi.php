<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Business\Model;

use FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToApiFacadeInterface;
use FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeInterface;
use FondOfOryx\Zed\ConcreteProductApi\Persistence\ConcreteProductApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;

class ConcreteProductApi implements ConcreteProductApiInterface
{
    /**
     * @var string
     */
    protected const KEY_ID_PRODUCT = 'id_product';

    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeInterface
     */
    protected $productFacade;

    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Persistence\ConcreteProductApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToProductFacadeInterface $productFacade
     * @param \FondOfOryx\Zed\ConcreteProductApi\Persistence\ConcreteProductApiRepositoryInterface $repository
     */
    public function __construct(
        ConcreteProductApiToApiFacadeInterface     $apiFacade,
        ConcreteProductApiToProductFacadeInterface $productFacade,
        ConcreteProductApiRepositoryInterface      $repository
    ) {
        $this->apiFacade = $apiFacade;
        $this->productFacade = $productFacade;
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
            if (!isset($item[static::KEY_ID_PRODUCT])) {
                continue;
            }

            $data[$index] = $this->getByIdProductConcrete($item[static::KEY_ID_PRODUCT])->toArray();
        }

        return $apiCollectionTransfer->setData($data);
    }

    /**
     * @param int $id
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function get(int $id): ApiItemTransfer
    {
        $productConcreteTransfer = $this->getByIdProductConcrete($id);

        return $this->apiFacade->createApiItem($productConcreteTransfer, (string)$id);
    }

    /**
     * @param int $idProductConcrete
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ProductConcreteTransfer
     */
    protected function getByIdProductConcrete(int $idProductConcrete): ProductConcreteTransfer
    {
        $productConcreteTransfer = $this->productFacade->findProductConcreteById($idProductConcrete);

        if ($productConcreteTransfer === null) {
            throw new EntityNotFoundException(
                'Could not found concrete product.',
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $productConcreteTransfer;
    }
}
