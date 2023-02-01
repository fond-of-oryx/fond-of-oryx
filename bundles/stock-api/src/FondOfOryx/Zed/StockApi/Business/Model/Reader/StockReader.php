<?php

namespace FondOfOryx\Zed\StockApi\Business\Model\Reader;

use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeInterface;
use FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface;
use FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerInterface;
use FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiPaginationTransfer;
use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnSelectionTransfer;
use Generated\Shared\Transfer\PropelQueryBuilderColumnTransfer;
use Generated\Shared\Transfer\StockTransfer;
use Orm\Zed\Stock\Persistence\Map\SpyStockTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Map\TableMap;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StockReader implements StockReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface
     */
    protected $stockFacade;

    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderQueryContainer;

    /**
     * @var \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToStockInterface $stockFacade
     * @param \FondOfOryx\Zed\StockApi\Dependency\Facade\StockApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\StockApi\Dependency\QueryContainer\StockApiToApiQueryBuilderQueryContainerInterface $queryBuilderQueryContainer
     * @param \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainerInterface $stockApiQueryContainer
     */
    public function __construct(
        StockApiToStockInterface $stockFacade,
        StockApiToApiFacadeInterface $apiFacade,
        StockApiToApiQueryBuilderQueryContainerInterface $queryBuilderQueryContainer,
        StockApiQueryContainerInterface $stockApiQueryContainer
    ) {
        $this->stockFacade = $stockFacade;
        $this->apiFacade = $apiFacade;
        $this->apiQueryBuilderQueryContainer = $queryBuilderQueryContainer;
        $this->queryContainer = $stockApiQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiCollectionTransfer
     */
    public function findStock(ApiRequestTransfer $apiRequestTransfer): ApiCollectionTransfer
    {
        $query = $this->buildQuery($apiRequestTransfer);
        $collection = $this->toTransferCollection($query->find()->toArray());

        foreach ($collection as $k => $stockApiTransfer) {
            $collection[$k] = $this->getStockById($stockApiTransfer->getIdStock())
                ->getData();
        }

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
    public function getStockById(int $id): ApiItemTransfer
    {
        $stockTransfer = $this->stockFacade->findStockById($id);

        if ($stockTransfer === null) {
            throw new EntityNotFoundException(
                'Could not find stock.',
                ApiConfig::HTTP_CODE_NOT_FOUND,
            );
        }

        return $this->apiFacade->createApiItem($stockTransfer, (string)$id);
    }

    /**
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function buildQuery(ApiRequestTransfer $apiRequestTransfer): ModelCriteria
    {
        $apiQueryBuilderQueryTransfer = $this->buildApiQueryBuilderQuery($apiRequestTransfer);
        $query = $this->queryContainer->queryFind();
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
        $tableColumns = SpyStockTableMap::getFieldNames(TableMap::TYPE_FIELDNAME);

        foreach ($tableColumns as $columnAlias) {
            $columnTransfer = (new PropelQueryBuilderColumnTransfer())
                ->setName(SpyStockTableMap::TABLE_NAME . '.' . $columnAlias)
                ->setAlias($columnAlias);

            $columnSelectionTransfer->addTableColumn($columnTransfer);
        }

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
     * @return \Generated\Shared\Transfer\StockTransfer
     */
    protected function toTransfer(array $data): StockTransfer
    {
        return (new StockTransfer())->fromArray($data, true);
    }

    /**
     * @param array $data
     *
     * @return array<int, \Generated\Shared\Transfer\StockTransfer>
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
