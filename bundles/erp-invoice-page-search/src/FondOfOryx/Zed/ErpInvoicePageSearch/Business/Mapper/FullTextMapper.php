<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\Mapper;

use FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig;

class FullTextMapper extends AbstractFullTextMapper
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig
     */
    protected ErpInvoicePageSearchConfig $config;

    /**
     * @var array<\FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface>
     */
    protected array $fullTextExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig $config
     * @param array<\FondOfOryx\Zed\ErpInvoicePageSearchExtension\Dependency\Plugin\FullTextExpanderPluginInterface> $fullTextExpanderPlugins
     */
    public function __construct(
        ErpInvoicePageSearchConfig $config,
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
