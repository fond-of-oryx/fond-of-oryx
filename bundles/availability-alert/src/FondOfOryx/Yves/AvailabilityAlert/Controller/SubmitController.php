<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Controller;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Spryker\Shared\Kernel\Store;
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
    public function indexAction(Request $request)
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
        $formData = $request->request->get('availabilityAlertSubscriptionForm');
        $subscribed = false;
        $subscriptionForm = false;
        if ($formData !== null) {
            $idProductAbstract = $formData['idProductAbstract'];
            $subscriptionForm = $this->getFactory()
                ->createSubscriptionForm($idProductAbstract)->createView();

            $subscribed = $this->registerForAvailabilityAlert($formData);
        }

        return $this->jsonResponse(
            [
                'success' => $subscribed === false ? $subscribed : $subscribed->getIsSuccess(),
            ]
        );
    }

    /**
     * @param array $formData
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    protected function registerForAvailabilityAlert(array $formData): AvailabilityAlertSubscriptionResponseTransfer
    {
        $availabilityAlertSubscriptionRequestTransfer = new AvailabilityAlertSubscriptionRequestTransfer();
        $availabilityAlertSubscriptionRequestTransfer->setStore(Store::getInstance()->getStoreName());
        $availabilityAlertSubscriptionRequestTransfer->setEmail($formData['email']);
        $availabilityAlertSubscriptionRequestTransfer->setIdProductAbstract($formData['idProductAbstract']);
        $availabilityAlertSubscriptionRequestTransfer->setLocaleName(Store::getInstance()->getCurrentLocale());

        return $this->getFactory()
            ->getAvailabilityAlertClient()
            ->subscribe(
                $availabilityAlertSubscriptionRequestTransfer
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

        $availabilityAlertSubscriptionResponseTransfer = $this->getFactory()
            ->getAvailabilityAlertClient()
            ->subscribe(
                $this->getSubscriptionFormData($form)
                    ->setLocaleName($this->getLocale())
                    ->setStore(Store::getInstance()->getStoreName())
            );

        if ($availabilityAlertSubscriptionResponseTransfer->getIsSuccess()) {
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
    protected function getSubscriptionFormData(FormInterface $form)
    {
        return $form->getData();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    protected function getParentRequest()
    {
        return $this->getApplication()['request_stack']->getParentRequest();
    }
}
