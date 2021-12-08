<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Dependency\Service;

use Spryker\Service\UtilSanitize\UtilSanitizeServiceInterface;

class CompanyProductListConnectorGuiToUtilSanitizeServiceBridge implements
    CompanyProductListConnectorGuiToUtilSanitizeServiceInterface
{
    /**
     * @var \Spryker\Service\UtilSanitize\UtilSanitizeServiceInterface
     */
    protected $utilSanitizeService;

    /**
     * @param \Spryker\Service\UtilSanitize\UtilSanitizeServiceInterface $utilSanitizeService
     */
    public function __construct(UtilSanitizeServiceInterface $utilSanitizeService)
    {
        $this->utilSanitizeService = $utilSanitizeService;
    }

    /**
     * @param string $text
     * @param bool $double
     * @param string|null $charset
     *
     * @return string
     */
    public function escapeHtml(string $text, bool $double = true, ?string $charset = null): string
    {
        return $this->utilSanitizeService->escapeHtml($text, $double, $charset);
    }
}
