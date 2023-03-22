<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig;

class FullTextBoostedMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig $config
     */
    public function __construct(ErpOrderPageSearchConfig $config)
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
