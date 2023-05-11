<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer;

class RestOrderBudgetSearchPaginationMapper implements RestOrderBudgetSearchPaginationMapperInterface
{
    /**
     * @var string
     */
    public const PARAMETER_NAME_PAGE = 'page';

    /**
     * @var string
     */
    public const PARAMETER_NAME_ITEMS_PER_PAGE = 'ipp';

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig
     */
    protected OrderBudgetSearchRestApiConfig $config;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig $config
     */
    public function __construct(OrderBudgetSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

 /**
  * @param \Generated\Shared\Transfer\OrderBudgetListTransfer $orderBudgetListTransfer
  *
  * @return \Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer
  */
    public function fromOrderBudgetList(
        OrderBudgetListTransfer $orderBudgetListTransfer
    ): RestOrderBudgetSearchPaginationTransfer {
        $restOrderBudgetSearchPaginationTransfer = new RestOrderBudgetSearchPaginationTransfer();

        $paginationTransfer = $orderBudgetListTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restOrderBudgetSearchPaginationTransfer;
        }

        return $restOrderBudgetSearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestOrderBudgetSearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestOrderBudgetSearchPaginationConfigTransfer
     */
    protected function createRestOrderBudgetSearchPaginationConfig(): RestOrderBudgetSearchPaginationConfigTransfer
    {
        return (new RestOrderBudgetSearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
