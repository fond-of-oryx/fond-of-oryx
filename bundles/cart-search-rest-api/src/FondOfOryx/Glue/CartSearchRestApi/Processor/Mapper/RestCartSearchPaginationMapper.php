<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestCartSearchPaginationConfigTransfer;
use Generated\Shared\Transfer\RestCartSearchPaginationTransfer;

class RestCartSearchPaginationMapper implements RestCartSearchPaginationMapperInterface
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
     * @var \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig $config
     */
    public function __construct(CartSearchRestApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer

     * @return \Generated\Shared\Transfer\RestCartSearchPaginationTransfer
     */
    public function fromQuoteList(QuoteListTransfer $quoteListTransfer): RestCartSearchPaginationTransfer
    {
        $restCartSearchPaginationTransfer = new RestCartSearchPaginationTransfer();

        $paginationTransfer = $quoteListTransfer->getPagination();

        if ($paginationTransfer === null) {
            return $restCartSearchPaginationTransfer;
        }

        return $restCartSearchPaginationTransfer->setCurrentPage($paginationTransfer->getPage())
            ->setMaxPage($paginationTransfer->getLastPage())
            ->setCurrentItemsPerPage($paginationTransfer->getMaxPerPage())
            ->setNumFound($paginationTransfer->getNbResults())
            ->setConfig($this->createRestCartSearchPaginationConfig());
    }

    /**
     * @return \Generated\Shared\Transfer\RestCartSearchPaginationConfigTransfer
     */
    protected function createRestCartSearchPaginationConfig(): RestCartSearchPaginationConfigTransfer
    {
        return (new RestCartSearchPaginationConfigTransfer())
            ->setDefaultItemsPerPage($this->config->getItemsPerPage())
            ->setItemsPerPageParameterName(static::PARAMETER_NAME_ITEMS_PER_PAGE)
            ->setParameterName(static::PARAMETER_NAME_PAGE)
            ->setValidItemsPerPageOptions($this->config->getValidItemsPerPageOptions());
    }
}
