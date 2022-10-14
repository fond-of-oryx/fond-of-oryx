<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToLocaleFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToStoreFacadeInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface;
use Generated\Shared\Transfer\CustomerTransfer;
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
     * @var \FondOfOryx\Zed\OneTimePasswordExtension\Dependency\Plugin\UrlFormatterPluginInterface[]
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
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer {
        $oneTimePasswordResponseTransfer = $this->oneTimePasswordGenerator->generateOneTimePassword($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return $oneTimePasswordResponseTransfer;
        }

        $encodedLoginCredentials = $this->oneTimePasswordEncoder->encode($oneTimePasswordResponseTransfer);

        if ($encodedLoginCredentials === null) {
            return $oneTimePasswordResponseTransfer->setIsSuccess(false);
        }

        return $oneTimePasswordResponseTransfer
            ->setLoginLink($this->formatLoginLink(str_replace(static::LINK_LOCALE_PLACEHOLDER, $this->getUrlLocale(), $this->oneTimePasswordConfig->getLoginLinkPath()), $encodedLoginCredentials));
    }

    /**
     * @return string
     */
    protected function getUrlLocale(): string
    {
        $currentLocale = $this->localeFacade->getCurrentLocaleName();

        $availableLocaleIsoCodes = $this->storeFacade->getCurrentStore()->getAvailableLocaleIsoCodes();

        $urlLocale = array_search($currentLocale, $availableLocaleIsoCodes, true);

        if (!$urlLocale) {
            return $this->oneTimePasswordConfig->getDefaultUrlLocale();
        }

        return $urlLocale;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer
    ): OneTimePasswordResponseTransfer {
        $customerTransfer = $orderTransfer->requireCustomer()->getCustomer();

        $oneTimePasswordResponseTransfer = $this->generateLoginLink($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return $oneTimePasswordResponseTransfer;
        }

        $loginLink = sprintf(
            self::LINK_PARAMETER_EXTENSION_FORMAT,
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
     * @return string
     */
    protected function formatLoginLink(string $localizedLoginLinkPath, string $encodedLoginCredentials): string
    {
        if (count($this->urlFormatterPlugins) > 0){
            foreach ($this->urlFormatterPlugins as $urlFormatterPlugin){
                $localizedLoginLinkPath = $urlFormatterPlugin->formatUrl($localizedLoginLinkPath, $encodedLoginCredentials);
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
}
