<?php

namespace FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\Controller;

use Exception;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnectorGui\Communication\CustomerProductListConnectorGuiCommunicationFactory getFactory()
 */
class EditController extends AbstractController
{
    /**
     * @var string
     */
    public const PARAM_ID_CUSTOMER = 'id-customer';

    /**
     * @var string
     */
    public const PAGE_EDIT = '/customer-product-list-connector-gui/edit';

    /**
     * @var string
     */
    public const PAGE_EDIT_WITH_PARAMS = '/customer-product-list-connector-gui/edit?%s=%d';

    /**
     * @var string
     */
    public const PAGE_CUSTOMER = '/customer';

    /**
     * @var string
     */
    protected const MESSAGE_CUSTOMER_NOT_FOUND = "Customer couldn't be found";

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function indexAction(Request $request)
    {
        $idCustomer = $request->query->getInt(static::PARAM_ID_CUSTOMER);

        $form = $this->getFactory()->createCustomerProductListConnectorForm($idCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerProductListConnectorGuiTransfer = $form->getData();

            $customerProductListRelationTransfer = $this->getFactory()
                ->createCustomerProductListRelationMapper()
                ->fromCustomerProductListConnectorGui($customerProductListConnectorGuiTransfer);

            $this->getFactory()
                ->getCustomerProductListConnectorFacade()
                ->persistCustomerProductListRelation($customerProductListRelationTransfer);

            $this->addSuccessMessage('Customer product list relations are updated.');

            return $this->redirectResponse(sprintf(static::PAGE_EDIT_WITH_PARAMS, static::PARAM_ID_CUSTOMER, $idCustomer));
        }

        $customerTransfer = $this->getCustomerTransfer($idCustomer);

        if (!$customerTransfer->getIdCustomer()) {
            $this->addErrorMessage(static::MESSAGE_CUSTOMER_NOT_FOUND);

            return $this->redirectResponse(static::PAGE_CUSTOMER);
        }

        return $this->viewResponse([
           'availableProductLists' => $this->getFactory()->createAvailableProductListTable($customerTransfer)->render(),
           'assignedProductLists' => $this->getFactory()->createAssignedProductListTable($customerTransfer)->render(),
           'customerTransfer' => $customerTransfer,
           'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function getCustomerTransfer(int $idCustomer): CustomerTransfer
    {
        $customerTransfer = (new CustomerTransfer())
            ->setIdCustomer($idCustomer);

        try {
            return $this->getFactory()->getCustomerFacade()->findCustomerById($customerTransfer);
        } catch (Exception $exception) {
            return new CustomerTransfer();
        }
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function availableProductListTableAction(Request $request): JsonResponse
    {
        $idCustomer = $request->query->getInt(static::PARAM_ID_CUSTOMER);

        return $this->jsonResponse(
            $this->getFactory()
                ->createAvailableProductListTable(
                    (new CustomerTransfer())->setIdCustomer($idCustomer),
                )->fetchData(),
        );
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function assignedProductListTableAction(Request $request): JsonResponse
    {
        $idCustomer = $request->query->getInt(static::PARAM_ID_CUSTOMER);

        return $this->jsonResponse(
            $this->getFactory()
                ->createAssignedProductListTable(
                    (new CustomerTransfer())->setIdCustomer($idCustomer),
                )->fetchData(),
        );
    }
}
