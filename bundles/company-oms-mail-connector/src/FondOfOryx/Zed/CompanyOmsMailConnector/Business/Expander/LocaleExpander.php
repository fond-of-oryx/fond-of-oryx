<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander;

use Exception;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class LocaleExpander implements ExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface
     */
    protected $companyUserReferenceFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade
     * @param \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface $localeFacade
     */
    public function __construct(
        CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade,
        CompanyOmsMailConnectorToLocaleFacadeInterface $localeFacade
    ) {
        $this->companyUserReferenceFacade = $companyUserReferenceFacade;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        $companyUser = $this->getCompanyUser($mailTransfer, $orderTransfer);

        return $mailTransfer->setLocale($this->getLocale($companyUser->getCompany()->getFkLocale()));
    }

    /**
     * @param int $fkLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function getLocale(int $fkLocale): LocaleTransfer
    {
        $availableLocale = $this->localeFacade->getAvailableLocales();
        if (array_key_exists($fkLocale, $availableLocale) === false) {
            $fkLocale = array_key_first($availableLocale);
        }

        return $this->localeFacade->getLocaleById($fkLocale);
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function getCompanyUser(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): CompanyUserTransfer
    {
        $companyUser = $mailTransfer->getCompanyUser();
        if ($companyUser === null || $companyUser->getCompanyUserReference() !== $orderTransfer->getCompanyUserReference()) {
            $companyUser = $this->getCompanyUserByReference($orderTransfer->getCompanyUserReference());
            $mailTransfer->setCompanyUser($companyUser);
        }

        return $companyUser;
    }

    /**
     * @param string $companyUserReference
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected function getCompanyUserByReference(string $companyUserReference): CompanyUserTransfer
    {
        $responseTransfer = $this->companyUserReferenceFacade->findCompanyUserByCompanyUserReference((new CompanyUserTransfer())->setCompanyUserReference($companyUserReference));

        if ($responseTransfer->getIsSuccessful() === true) {
            return $responseTransfer->getCompanyUser();
        }

        throw new Exception(sprintf('Company user with reference "%s" not found!', $companyUserReference));
    }
}
