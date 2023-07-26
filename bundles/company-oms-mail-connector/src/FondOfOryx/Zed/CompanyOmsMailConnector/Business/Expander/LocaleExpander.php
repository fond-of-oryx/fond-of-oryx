<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander;

use Exception;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Throwable;

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
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * @var array<int, string>
     */
    protected $availabileLocale = [];

    /**
     * @param \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade
     * @param \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToLocaleFacadeInterface $localeFacade
     * @param \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyFacadeInterface $companyFacade
     */
    public function __construct(
        CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade,
        CompanyOmsMailConnectorToLocaleFacadeInterface $localeFacade,
        CompanyOmsMailConnectorToCompanyFacadeInterface $companyFacade
    ) {
        $this->companyUserReferenceFacade = $companyUserReferenceFacade;
        $this->localeFacade = $localeFacade;
        $this->companyFacade = $companyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        $companyUser = null;

        try {
            $companyUser = $this->getCompanyUser($mailTransfer, $orderTransfer);
        }
        catch (Throwable $throwable){
            //ToDo: maybe log here
        }

        $localeId = $orderTransfer->getFkLocale();
        if ($companyUser !== null){
            $localeId = $this->getCompanyLocaleId($mailTransfer, $companyUser);
        }

        return $mailTransfer->setLocale($this->getLocale($localeId));
    }

    /**
     * @param int $fkLocale
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    protected function getLocale(int $fkLocale): LocaleTransfer
    {
        $availableLocale = $this->getAvailabileLocale();
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
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUser
     *
     * @return int
     */
    protected function getCompanyLocaleId(MailTransfer $mailTransfer, CompanyUserTransfer $companyUser): int
    {
        $company = $companyUser->getCompany();
        if ($company === null || $company->getFkLocale() === null) {
            $company = $this->companyFacade->findCompanyById($companyUser->getFkCompany());
        }

        if ($company !== null && $company->getFkLocale() !== null) {
            $companyUser->setCompany($company);
            $mailTransfer->setCompanyUser($companyUser);

            return $company->getFkLocale();
        }

        return $this->getFallbackLocaleId();
    }

    /**
     * @return int
     */
    protected function getFallbackLocaleId(): int
    {
        return array_key_first($this->getAvailabileLocale());
    }

    /**
     * @return array<int, string>
     */
    protected function getAvailabileLocale(): array
    {
        if (count($this->availabileLocale) === 0) {
            $this->availabileLocale = $this->localeFacade->getAvailableLocales();
        }

        return $this->availabileLocale;
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
