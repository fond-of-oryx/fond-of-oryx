<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Processor\Expander;

use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestReturnLabelRequestExpander implements RestReturnLabelRequestExpanderInterface
{
    /**
     * @inheritDoc
     */
    public function expand(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        RestRequestInterface $restRequest
    ): RestReturnLabelRequestTransfer {
        return $this->expandWithIdCustomer($restReturnLabelRequestTransfer, $restRequest);
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelRequestTransfer
     */
    protected function expandWithIdCustomer(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        RestRequestInterface $restRequest
    ): RestReturnLabelRequestTransfer {
        $getUserMethod = 'getUser';

        if (method_exists($restRequest, 'getRestUser')) {
            $getUserMethod = 'getRestUser';
        }

        if ($restRequest->$getUserMethod() === null) {
            return $restReturnLabelRequestTransfer;
        }

        /** @var \Generated\Shared\Transfer\RestUserTransfer|\Spryker\Glue\GlueApplication\Rest\Request\Data\UserInterface $restUser */
        $restUser = $restRequest->$getUserMethod();

        if ($restReturnLabelRequestTransfer->getCustomer() === null) {
            $restReturnLabelRequestTransfer->setCustomer(new RestCustomerTransfer());
        }

        $restReturnLabelRequestTransfer->getCustomer()
            ->setIdCustomer($restUser->getSurrogateIdentifier());

        return $restReturnLabelRequestTransfer;
    }
}
