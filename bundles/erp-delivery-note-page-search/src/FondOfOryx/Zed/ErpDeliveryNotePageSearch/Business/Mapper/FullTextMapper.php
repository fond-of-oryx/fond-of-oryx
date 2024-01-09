<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig;

class FullTextMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig
     */
    protected ErpDeliveryNotePageSearchConfig $config;

    /**
     * @var array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected array $fullTextExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig $config
     * @param array<\FondOfOryx\Zed\ErpDeliveryNotePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface> $fullTextExpanderPlugins
     */
    public function __construct(
        ErpDeliveryNotePageSearchConfig $config,
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
     * @return array<scalar>
     */
    public function fromData(array $data): array
    {
        $fullText = parent::fromData($data);

        foreach ($this->fullTextExpanderPlugins as $fullTextExpanderPlugin) {
            $fullText = $fullTextExpanderPlugin->expand($data, $fullText);
        }

        return $fullText;
    }
}
