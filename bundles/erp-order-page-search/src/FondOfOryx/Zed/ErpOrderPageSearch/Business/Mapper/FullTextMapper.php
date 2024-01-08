<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig;

class FullTextMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig
     */
    protected ErpOrderPageSearchConfig $config;

    /**
     * @var array<\FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected array $fullTextExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig $config
     * @param array<\FondOfOryx\Zed\ErpOrderPageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface> $fullTextExpanderPlugins
     */
    public function __construct(
        ErpOrderPageSearchConfig $config,
        array $fullTextExpanderPlugins
    ) {
        $this->config = $config;
        $this->fullTextExpanderPlugins = $fullTextExpanderPlugins;
    }

    /**
     * @return array<string>
     */
    protected function getFields(): array
    {
        return $this->config->getFullTextFields();
    }

    /**
     * @param array $data
     *
     * @return array<string>
     */
    public function fromData(array $data): array
    {
        $fullTextBoosted = parent::fromData($data);

        foreach ($this->fullTextExpanderPlugins as $fullTextExpanderPlugin) {
            $fullTextBoosted = $fullTextExpanderPlugin->expand($data, $fullTextBoosted);
        }

        return $fullTextBoosted;
    }
}
