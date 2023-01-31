<?php

namespace FondOfOryx\Zed\StockProductApi\Business\Model\Reader;

use FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeInterface;
use FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockInterface;
use FondOfOryx\Zed\StockProductApi\Dependency\QueryContainer\StockProductApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiQueryContainerInterface;
use FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiPaginationTransfer;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnTransfer;
use Generated\Shared\Transfer\StockProductTransfer;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Orm\Zed\Stock\Persistence\Map\SpyStockProductTableMap;
use Orm\Zed\Stock\Persistence\Map\SpyStockTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StockReader implements StockReaderInterface
{
    /**
     * @var array
     */
    protected const SPECIAL_FIELDS = [
        SpyProductTableMap::COL_SKU => 'sku',
        SpyStockTableMap::COL_NAME => 'stock_type',
    ];

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockInterface
     */
    protected $stockFacade;

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Dependency\QueryContainer\StockProductApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainer;

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToStockInterface $stockFacade
     * @param \FondOfOryx\Zed\StockProductApi\Dependency\Facade\StockProductApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\StockProductApi\Dependency\QueryContainer\StockProductApiToApiQueryBuilderQueryContainerInterface $queryBuilderQueryContainer
     * @param \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiQueryContainerInterface $stockApiQueryContainer
     * @param \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiRepositoryInterface $repository
     */
    public function __construct(
        StockProductApiToStockInterface $stockFacade,
        StockProductApiToApiFacadeInterface $apiFacade,
        StockProductApiToApiQueryBuilderQueryContainerInterface $queryBuilderQueryContainer,
        StockProductApiQueryContainerInterface $stockApiQueryContainer,
        StockProductApiRepositoryInterface $repository
    ) {
        $this->stockFacade = $stockFacade;
        $this->apiFacade = $apiFacade;
        $this->apiQueryBuilderQueryContainer = $queryBuilderQueryContainer;
        $this->queryContainer = $stockApiQueryContainer;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findStockProduct(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $query = $this->buildQuery($apiRequestTransfer);
        $collection = $this->toTransferCollection($query->find()->getData());
        $apiCollectionTransfer = $this->apiFacade->createApiCollection($collection);

        return $this->addPagination($query, $apiCollectionTransfer, $apiRequestTransfer);
    }

    /**
     * @param int $id
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotFoundException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function getStockProductById(int $id): ApiItemTransfer
    {
        $stockProductTransfer = $this->repository->getStockProductById($id);

        if ($stockProductTransfer === null) {
            throw new EntityNotFoundException(
                'Could not find stock.',
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $this->apiFacade->createApiItem($stockProductTransfer, (string)$id);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function buildQuery(ApiRequestTransfer $apiRequestTransfer): ModelCriteria
    {
        $apiQueryBuilderQueryTransfer = $this->buildApiQueryBuilderQuery($apiRequestTransfer);
        $query = $this->queryContainer->queryFind()->joinSpyProduct()->innerJoinStock();
        $query = $this->apiQueryBuilderQueryContainer->buildQueryFromRequest($query, $apiQueryBuilderQueryTransfer);

        return $query;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer
     */
    protected function buildApiQueryBuilderQuery(ApiRequestTransfer $apiRequestTransfer): ApiQueryBuilderQueryTransfer
    {
        return (new ApiQueryBuilderQueryTransfer())
            ->setApiRequest($apiRequestTransfer)
            ->setColumnSelection($this->buildColumnSelection());
    }

    /**
     * @return \Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer
     */
    protected function buildColumnSelection(): PropelQueryBuilderColumnSelectionTransfer
    {
        $columnSelectionTransfer = new PropelQueryBuilderColumnSelectionTransfer();
        $tableColumns = SpyStockProductTableMap::getFieldNames(TableMap::TYPE_FIELDNAME);

        foreach ($tableColumns as $columnAlias) {
            $columnTransfer = (new PropelQueryBuilderColumnTransfer())
                ->setName(SpyStockProductTableMap::TABLE_NAME . '.' . $columnAlias)
                ->setAlias($columnAlias);

            $columnSelectionTransfer->addTableColumn($columnTransfer);
        }

        //ToDo after bug in spryker/propel-query-builder for ColumnQueryMapper is fixed, change setAlias to "sku"
        $columnTransfer = (new PropelQueryBuilderColumnTransfer())
            ->setName(SpyProductTableMap::COL_SKU)
            ->setAlias(SpyProductTableMap::COL_SKU);

        $columnSelectionTransfer->addTableColumn($columnTransfer);

        //ToDo after bug in spryker/propel-query-builder for ColumnQueryMapper is fixed, change setAlias to "sku"
        $columnTransfer = (new PropelQueryBuilderColumnTransfer())
            ->setName(SpyStockTableMap::COL_NAME)
            ->setAlias(SpyStockTableMap::COL_NAME);

        $columnSelectionTransfer->addTableColumn($columnTransfer);

        return $columnSelectionTransfer;
    }

    /**
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\ApiCollectionTransfer $apiCollectionTransfer
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected function addPagination(
        ModelCriteria $query,
        ApiCollectionTransfer $apiCollectionTransfer,
        ApiRequestTransfer $apiRequestTransfer
    ): ApiCollectionTransfer {
        $query->setOffset(0)
            ->setLimit(-1);

        $total = $query->count();
        $page = $apiRequestTransfer->getFilter()->getLimit() ? ($apiRequestTransfer->getFilter()->getOffset() / $apiRequestTransfer->getFilter()->getLimit() + 1) : 1;
        $pageTotal = ($total && $apiRequestTransfer->getFilter()->getLimit()) ? (int)ceil($total / $apiRequestTransfer->getFilter()->getLimit()) : 1;

        if ($page > $pageTotal) {
            throw new NotFoundHttpException('Out of bounds.', null, ApiConfig::HTTP_CODE_NOT_FOUND);
        }

        $apiPaginationTransfer = (new ApiPaginationTransfer())
            ->setItemsPerPage($apiRequestTransfer->getFilter()->getLimit())
            ->setPage($page)
            ->setTotal($total)
            ->setPageTotal($pageTotal);

        $apiCollectionTransfer->setPagination($apiPaginationTransfer);

        return $apiCollectionTransfer;
    }

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer
     */
    protected function toTransfer(array $data): StockProductTransfer
    {
        $stockProductTransfer = (new StockProductTransfer())->fromArray($data, true);

        foreach ($data as $key => $val) {
            if (array_key_exists($key, static::SPECIAL_FIELDS)) {
                $stockProductTransfer->{sprintf('set%s', implode('', array_map('ucfirst', explode('_', static::SPECIAL_FIELDS[$key]))))}($val);
            }
        }

        return $stockProductTransfer;
    }

    /**
     * @param array $data
     *
     * @return array<int, \Generated\Shared\Transfer\StockProductTransfer>
     */
    protected function toTransferCollection(array $data): array
    {
        $transferList = [];

        foreach ($data as $itemData) {
            $transferList[] = $this->toTransfer($itemData);
        }

        return $transferList;
    }
}
