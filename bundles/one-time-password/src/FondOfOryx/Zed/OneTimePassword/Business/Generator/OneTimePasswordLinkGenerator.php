<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToLocaleFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToStoreFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OneTimePasswordLinkGenerator implements OneTimePasswordLinkGeneratorInterface
{
    /**
     * @var string
     */
    protected const LINK_LOCALE_PLACEHOLDER = '{{locale}}';

    /**
     * @var string
     */
    protected const LINK_PARAMETER_FORMAT = '%s?%s=%s';

    /**
     * @var string
     */
    protected const LINK_PARAMETER_EXTENSION_FORMAT = '%s&%s=%s';

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface
     */
    protected $oneTimePasswordGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface
     */
    protected $oneTimePasswordEncoder;

    /**
     * @var array<\FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface>
     */
    protected $urlFormatterPlugins;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig
     */
    protected $oneTimePasswordConfig;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface $oneTimePasswordGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface $oneTimePasswordEncoder
     * @param \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToLocaleFacadeInterface $localeFacade
     * @param \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig $oneTimePasswordConfig
     * @param array<\FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface> $urlFormatterPlugins
     */
    public function __construct(
        OneTimePasswordGeneratorInterface $oneTimePasswordGenerator,
        OneTimePasswordEncoderInterface $oneTimePasswordEncoder,
        OneTimePasswordToStoreFacadeInterface $storeFacade,
        OneTimePasswordToLocaleFacadeInterface $localeFacade,
        OneTimePasswordConfig $oneTimePasswordConfig,
        array $urlFormatterPlugins
    ) {
        $this->oneTimePasswordGenerator = $oneTimePasswordGenerator;
        $this->oneTimePasswordEncoder = $oneTimePasswordEncoder;
        $this->storeFacade = $storeFacade;
        $this->localeFacade = $localeFacade;
        $this->oneTimePasswordConfig = $oneTimePasswordConfig;
        $this->urlFormatterPlugins = $urlFormatterPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer,
        ?OneTimePasswordAttributesTransfer $attributesTransfer = null
    ): OneTimePasswordResponseTransfer {
        if ($attributesTransfer === null) {
            $attributesTransfer = $this->createEmptyAttributesTransfer();
        }
        $oneTimePasswordResponseTransfer = $this->oneTimePasswordGenerator->generateOneTimePassword($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return $oneTimePasswordResponseTransfer;
        }

        $encodedLoginCredentials = $this->oneTimePasswordEncoder->encode($oneTimePasswordResponseTransfer);

        if ($encodedLoginCredentials === null) {
            return $oneTimePasswordResponseTransfer->setIsSuccess(false);
        }

        return $oneTimePasswordResponseTransfer
            ->setLoginLink($this->formatLoginLink(str_replace(static::LINK_LOCALE_PLACEHOLDER, $this->resolveLocale($attributesTransfer), $this->oneTimePasswordConfig->getLoginLinkPath()), $encodedLoginCredentials, $attributesTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer $attributesTransfer
     *
     * @return string
     */
    protected function resolveLocale(OneTimePasswordAttributesTransfer $attributesTransfer): string
    {
        $locale = $attributesTransfer->getLocale();
        $localeName = $this->localeFacade->getCurrentLocaleName();
        if ($locale !== null && $locale->getLocaleName() !== null) {
            $localeName = $locale->getLocaleName();
        }

        $availableLocaleIsoCodes = $this->storeFacade->getCurrentStore()->getAvailableLocaleIsoCodes();

        $urlLocale = array_search($localeName, $availableLocaleIsoCodes, true);

        if (!$urlLocale) {
            return $this->oneTimePasswordConfig->getDefaultUrlLocale();
        }

        return $urlLocale;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer,
        ?OneTimePasswordAttributesTransfer $attributesTransfer = null
    ): OneTimePasswordResponseTransfer {
        if ($attributesTransfer === null) {
            $attributesTransfer = $this->createEmptyAttributesTransfer();
        }
        $customerTransfer = $orderTransfer->requireCustomer()->getCustomer();

        $oneTimePasswordResponseTransfer = $this->generateLoginLink($customerTransfer, $attributesTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return $oneTimePasswordResponseTransfer;
        }

        $defaultParamFormat = static::LINK_PARAMETER_EXTENSION_FORMAT;

        if (parse_url($oneTimePasswordResponseTransfer->getLoginLink(), PHP_URL_QUERY) === null) {
            $defaultParamFormat = str_replace('&', '?', $defaultParamFormat);
        }

        $loginLink = sprintf(
            $defaultParamFormat,
            $oneTimePasswordResponseTransfer->getLoginLink(),
            $this->oneTimePasswordConfig->getLoginLinkOrderReferenceName(),
            $orderTransfer->getOrderReference(),
        );

        return $oneTimePasswordResponseTransfer
            ->setLoginLink($loginLink);
    }

    /**
     * @param string $localizedLoginLinkPath
     * @param string $encodedLoginCredentials
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer $attributesTransfer
     *
     * @return string
     */
    protected function formatLoginLink(
        string $localizedLoginLinkPath,
        string $encodedLoginCredentials,
        OneTimePasswordAttributesTransfer $attributesTransfer
    ): string {
        if (count($this->urlFormatterPlugins) > 0) {
            foreach ($this->urlFormatterPlugins as $urlFormatterPlugin) {
                $localizedLoginLinkPath = $urlFormatterPlugin->formatUrl($localizedLoginLinkPath, $encodedLoginCredentials, $attributesTransfer);
            }

            return $localizedLoginLinkPath;
        }

        return sprintf(
            static::LINK_PARAMETER_FORMAT,
            $localizedLoginLinkPath,
            $this->oneTimePasswordConfig->getLoginLinkParameterName(),
            $encodedLoginCredentials,
        );
    }

    /**
     * @return \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer
     */
    protected function createEmptyAttributesTransfer(): OneTimePasswordAttributesTransfer
    {
        return new OneTimePasswordAttributesTransfer();
    }
}
