<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Validator;

use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorCollectionTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class SplittableCheckoutRequestValidator implements SplittableCheckoutRequestValidatorInterface
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestValidatorPluginInterface[]
     */
    protected $splittableCheckoutRequestValidatorPlugins;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestAttributesValidatorPluginInterface[]
     */
    protected $splittableCheckoutRequestAttributesValidatorPlugins;

    /**
     * SplittableCheckoutRequestValidator constructor.
     *
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestValidatorPluginInterface[] $splittableCheckoutRequestValidatorPlugins
     * @param \FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\SplittableCheckoutRequestAttributesValidatorPluginInterface[] $splittableCheckoutRequestAttributesValidatorPlugins
     */
    public function __construct(
        array $splittableCheckoutRequestValidatorPlugins,
        array $splittableCheckoutRequestAttributesValidatorPlugins
    ) {
        $this->splittableCheckoutRequestValidatorPlugins = $splittableCheckoutRequestValidatorPlugins;
        $this->splittableCheckoutRequestAttributesValidatorPlugins = $splittableCheckoutRequestAttributesValidatorPlugins;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $splittableCheckoutRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    public function validateSplittableCheckoutRequest(
        RestRequestInterface $restRequest,
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
    ): RestErrorCollectionTransfer {
        $restErrorCollectionTransfer = new RestErrorCollectionTransfer();
        $restErrorCollectionTransfer = $this->executeSplittableCheckoutRequestAttributesValidatorPlugins(
            $restSplittableCheckoutRequestAttributesTransfer,
            $restErrorCollectionTransfer
        );

        return $this->executeSplittableCheckoutRequestValidatorPlugins(
            $restSplittableCheckoutRequestAttributesTransfer,
            $restErrorCollectionTransfer
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RestErrorCollectionTransfer $pluginErrorCollectionTransfer
     * @param \Generated\Shared\Transfer\RestErrorCollectionTransfer $restErrorCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    protected function copyPluginErrorCollection(
        RestErrorCollectionTransfer $pluginErrorCollectionTransfer,
        RestErrorCollectionTransfer $restErrorCollectionTransfer
    ): RestErrorCollectionTransfer {
        foreach ($pluginErrorCollectionTransfer->getRestErrors() as $restError) {
            $restErrorCollectionTransfer->addRestError($restError);
        }

        return $restErrorCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\RestErrorCollectionTransfer $restErrorCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    protected function executeSplittableCheckoutRequestAttributesValidatorPlugins(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer,
        RestErrorCollectionTransfer $restErrorCollectionTransfer
    ): RestErrorCollectionTransfer {
        foreach ($this->splittableCheckoutRequestAttributesValidatorPlugins as $splittableCheckoutRequestAttributesValidatorPlugin) {
            $pluginErrorCollectionTransfer = $splittableCheckoutRequestAttributesValidatorPlugin
                ->validateAttributes($restSplittableCheckoutRequestAttributesTransfer);

            $restErrorCollectionTransfer = $this->copyPluginErrorCollection(
                $pluginErrorCollectionTransfer,
                $restErrorCollectionTransfer
            );
        }

        return $restErrorCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer
     * @param \Generated\Shared\Transfer\RestErrorCollectionTransfer $restErrorCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\RestErrorCollectionTransfer
     */
    protected function executeSplittableCheckoutRequestValidatorPlugins(
        RestSplittableCheckoutRequestAttributesTransfer $restSplittableCheckoutRequestAttributesTransfer,
        RestErrorCollectionTransfer $restErrorCollectionTransfer
    ): RestErrorCollectionTransfer {
        foreach ($this->splittableCheckoutRequestValidatorPlugins as $splittableCheckoutRequestValidatorPlugin) {
            $pluginErrorCollectionTransfer = $splittableCheckoutRequestValidatorPlugin->validateAttributes(
                $restSplittableCheckoutRequestAttributesTransfer
            );

            $restErrorCollectionTransfer = $this->copyPluginErrorCollection(
                $pluginErrorCollectionTransfer,
                $restErrorCollectionTransfer
            );
        }

        return $restErrorCollectionTransfer;
    }

}
