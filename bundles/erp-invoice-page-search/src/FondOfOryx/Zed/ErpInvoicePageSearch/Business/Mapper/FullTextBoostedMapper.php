<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;

class FullTextBoostedMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig $config
     */
    public function __construct(ErpInvoicePageSearchConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return array<string>
     */
    protected function getFields(): array
    {
        return $this->config->getFullTextBoostedFields();
    }
}
