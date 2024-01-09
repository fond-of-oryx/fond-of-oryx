<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig;

class FullTextBoostedMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig
     */
    protected ErpDeliveryNotePageSearchConfig $config;

    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected array $fullTextBoostedExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig $config
     * @param array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface> $fullTextBoostedExpanderPlugins
     */
    public function __construct(
        ErpDeliveryNotePageSearchConfig $config,
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
