<?php

namespace FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\Controller;

use Exception;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnectorGui\Communication\CompanyProductListConnectorGuiCommunicationFactory getFactory()
 */
class EditController extends AbstractController
{
    /**
     * @var string
     */
    public const PARAM_ID_COMPANY = 'id-company';

    /**
     * @var string
     */
    public const PAGE_EDIT = '/company-product-list-connector-gui/edit';

    /**
     * @var string
     */
    public const PAGE_EDIT_WITH_PARAMS = '/company-product-list-connector-gui/edit?%s=%d';

    /**
     * @var string
     */
    public const PAGE_COMPANY = '/company';

    /**
     * @var string
     */
    protected const MESSAGE_COMPANY_NOT_FOUND = "Company couldn't be found";

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function indexAction(Request $request)
    {
        $idCompany = $request->query->getInt(static::PARAM_ID_COMPANY);

        $form = $this->getFactory()->createCompanyProductListConnectorForm($idCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyProductListConnectorGuiTransfer = $form->getData();

            $companyProductListRelationTransfer = $this->getFactory()
                ->createCompanyProductListRelationMapper()
                ->fromCompanyProductListConnectorGui($companyProductListConnectorGuiTransfer);

            $this->getFactory()
                ->getCompanyProductListConnectorFacade()
                ->persistCompanyProductListRelation($companyProductListRelationTransfer);

            $this->addSuccessMessage('Company product list relations are updated.');

            return $this->redirectResponse(sprintf(static::PAGE_EDIT_WITH_PARAMS, static::PARAM_ID_COMPANY, $idCompany));
        }

        $companyTransfer = $this->getCompanyTransfer($idCompany);

        if (!$companyTransfer->getIdCompany()) {
            $this->addErrorMessage(static::MESSAGE_COMPANY_NOT_FOUND);

            return $this->redirectResponse(static::PAGE_COMPANY);
        }

        return $this->viewResponse([
           'availableProductLists' => $this->getFactory()->createAvailableProductListTable($companyTransfer)->render(),
           'assignedProductLists' => $this->getFactory()->createAssignedProductListTable($companyTransfer)->render(),
           'companyTransfer' => $companyTransfer,
           'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $idCompany
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    protected function getCompanyTransfer(int $idCompany): CompanyTransfer
    {
        $companyTransfer = (new CompanyTransfer())
            ->setIdCompany($idCompany);

        try {
            return $this->getFactory()->getCompanyFacade()->getCompanyById($companyTransfer);
        } catch (Exception $exception) {
            return new CompanyTransfer();
        }
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function availableProductListTableAction(Request $request): JsonResponse
    {
        $idCompany = $request->query->getInt(static::PARAM_ID_COMPANY);

        return $this->jsonResponse(
            $this->getFactory()
                ->createAvailableProductListTable(
                    (new CompanyTransfer())->setIdCompany($idCompany),
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
        $idCompany = $request->query->getInt(static::PARAM_ID_COMPANY);

        return $this->jsonResponse(
            $this->getFactory()
                ->createAssignedProductListTable(
                    (new CompanyTransfer())->setIdCompany($idCompany),
                )->fetchData(),
        );
    }
}
