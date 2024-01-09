<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;

class FullTextBoostedMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig
     */
    protected ErpInvoicePageSearchConfig $config;

    /**
     * @var array<\FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected array $fullTextBoostedExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig $config
     * @param array<\FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface> $fullTextBoostedExpanderPlugins
     */
    public function __construct(
        ErpInvoicePageSearchConfig $config,
        array $fullTextBoostedExpanderPlugins
    ) {
        $this->config = $config;
        $this->fullTextBoostedExpanderPlugins = $fullTextBoostedExpanderPlugins;
    }

    /**
     * @return array<string>
     */
    protected function getFields(): array
    {
        return $this->config->getFullTextBoostedFields();
    }

    /**
     * @param array $data
     *
     * @return array<scalar>
     */
    public function fromData(array $data): array
    {
        $fullTextBoosted = parent::fromData($data);

        foreach ($this->fullTextBoostedExpanderPlugins as $fullTextBoostedExpanderPlugin) {
            $fullTextBoosted = $fullTextBoostedExpanderPlugin->expand($data, $fullTextBoosted);
        }

        return $fullTextBoosted;
    }
}
