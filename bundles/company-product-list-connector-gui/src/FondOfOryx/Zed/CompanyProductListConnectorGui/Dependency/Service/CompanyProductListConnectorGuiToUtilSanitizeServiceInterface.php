<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service;

interface CompanyProductListConnectorGuiToUtilSanitizeServiceInterface
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
