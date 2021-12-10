<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Dependency\Service;

interface CustomerProductListConnectorGuiToUtilSanitizeServiceInterface
{
    /**
     * @param string $text
     * @param bool $double
     * @param string|null $charset
     *
     * @return string
     */
    public function escapeHtml(string $text, bool $double = true, ?string $charset = null): string;
}
