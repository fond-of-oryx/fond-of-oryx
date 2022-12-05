<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class EmailVerificationLinkGenerator implements EmailVerificationLinkGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface
     */
    protected $config;

    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface>
     */
    protected $emailVerificationLinkExtenderPlugins;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\CustomerRegistrationConfigInterface $config
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface> $emailVerificationLinkExtenderPlugins
     */
    public function __construct(
        CustomerRegistrationConfigInterface $config,
        array $emailVerificationLinkExtenderPlugins
    ) {
        $this->config = $config;
        $this->emailVerificationLinkExtenderPlugins = $emailVerificationLinkExtenderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function generateLink(CustomerTransfer $customerTransfer): string
    {
        $linkPattern = sprintf($this->cleanSlashes($this->config->getVerificationLinkPattern()), $this->cleanSlashes($this->config->getBaseUrl()));

        return $this->runEmailVerificationLinkExtenderPlugins($linkPattern, $customerTransfer);
    }

    /**
     * @param string $link
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    protected function runEmailVerificationLinkExtenderPlugins(string $link, CustomerTransfer $customerTransfer): string
    {
        foreach ($this->emailVerificationLinkExtenderPlugins as $emailVerificationLinkExtenderPlugin) {
            $link = $emailVerificationLinkExtenderPlugin->expand($link, $customerTransfer);
        }

        return $link;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    protected function cleanSlashes(string $string): string
    {
        return ltrim(rtrim($string, '/'), '/');
    }
}
