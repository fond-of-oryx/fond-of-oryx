<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Controller;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Yves\AvailabilityAlert\AvailabilityAlertFactory getFactory()
 */
class SubmitController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $parentRequest = $this->getParentRequest();
        $idProductAbstract = $request->attributes->get('idProductAbstract');

        $subscriptionForm = $this->getFactory()
            ->createSubscriptionForm($idProductAbstract)
            ->handleRequest($parentRequest);

        $this->processSubscriptionForm($subscriptionForm, $request);

        return [
            'subscriptionForm' => $subscriptionForm->createView(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function submitWidgetAction(Request $request): JsonResponse
    {
        $formData = $request->get('availabilityAlertSubscriptionForm');
        $subscribed = false;
        if ($formData !== null) {
            $subscribed = $this->registerForAvailabilityAlert($formData, $request);
        }

        return $this->jsonResponse(
            [
                'success' => $subscribed === false ? $subscribed : $subscribed->getIsSuccess(),
            ],
        );
    }

    /**
     * @param array $formData
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer
     */
    protected function createSubscriptionRequest(
        array $formData,
        Request $request
    ): AvailabilityAlertSubscriptionRequestTransfer {
        $currentStore = $this->getFactory()->getStoreClient()->getCurrentStore();
        $availabilityAlertSubscriptionRequestTransfer = new AvailabilityAlertSubscriptionRequestTransfer();
        $availabilityAlertSubscriptionRequestTransfer->setStore($currentStore->getName());
        $availabilityAlertSubscriptionRequestTransfer->setEmail($formData['email']);
        $availabilityAlertSubscriptionRequestTransfer->setIdProductAbstract($formData['idProductAbstract']);
        $availabilityAlertSubscriptionRequestTransfer->setLocaleName($this->getFactory()->getLocaleClient()->getCurrentLocale());

        $availabilityAlertSubscriptionRequestTransfer = $this->expandForm(
            $availabilityAlertSubscriptionRequestTransfer,
            $request,
            $formData,
        );

        return $availabilityAlertSubscriptionRequestTransfer;
    }

    /**
     * @param array $formData
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    protected function registerForAvailabilityAlert(
        array $formData,
        Request $request
    ): AvailabilityAlertSubscriptionResponseTransfer {
        return $this->getFactory()
            ->getAvailabilityAlertClient()
            ->subscribe(
                $this->createSubscriptionRequest($formData, $request),
            );
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool
     */
    protected function processSubscriptionForm(FormInterface $form, Request $request): bool
    {
        if (!$form->isSubmitted() || !$form->isValid()) {
            return false;
        }

        $formTransfer = $this->getSubscriptionFormData($form)->setLocaleName($this->getLocale())
            ->setStore($this->getFactory()->getStoreClient()->getCurrentStore()->getName());
        $formTransfer = $this->expandForm($formTransfer, $request);

        $availabilityAlertSubscriptionResponseTransfer = $this->getFactory()
            ->getAvailabilityAlertClient()
            ->subscribe(
                $formTransfer,
            );

        if ($availabilityAlertSubscriptionResponseTransfer->getIsSuccess() && method_exists($request->getSession(), 'getFlashBag')) {
            $request->getSession()
                ->getFlashBag()
                ->add('availability-alert-success', 'availibility_alert.feedback.success');

            return true;
        }

        $error = new FormError($availabilityAlertSubscriptionResponseTransfer->getErrors()[0]->getMessage());

        $form->addError($error);

        return false;
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer
     */
    protected function getSubscriptionFormData(FormInterface $form): AvailabilityAlertSubscriptionRequestTransfer
    {
        return $form->getData();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function getParentRequest(): Request
    {
        return $this->getApplication()['request_stack']->getParentRequest();
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param array $formData
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer
     */
    protected function expandForm(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer,
        Request $request,
        array $formData = []
    ): AvailabilityAlertSubscriptionRequestTransfer {
        foreach ($this->getFactory()->getAvailabilityAlertSubscriptionRequestExpanderPlugins() as $plugin) {
            $availabilityAlertSubscriptionRequestTransfer = $plugin->expand(
                $availabilityAlertSubscriptionRequestTransfer,
                $formData,
                $request,
            );
        }

        return $availabilityAlertSubscriptionRequestTransfer;
    }
}
