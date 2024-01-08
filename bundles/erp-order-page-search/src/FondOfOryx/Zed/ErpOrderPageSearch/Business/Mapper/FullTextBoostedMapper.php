<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig;

class FullTextBoostedMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig
     */
    protected ErpOrderPageSearchConfig $config;

    /**
     * @var array<\FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected array $fullTextBoostedExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig $config
     * @param array<\FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface> $fullTextBoostedExpanderPlugins
     */
    public function __construct(
        ErpOrderPageSearchConfig $config,
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
     * @return array<string>
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
