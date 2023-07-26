<?php

namespace FondOfOryx\Zed\CompanyOmsMailConnector\Business\Expander;

use Exception;
use FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class MailExpander implements ExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface
     */
    protected $companyUserReferenceFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyOmsMailConnector\Dependency\Facade\CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade
     */
    public function __construct(CompanyOmsMailConnectorToCompanyUserReferenceFacadeInterface $companyUserReferenceFacade)
    {
        $this->companyUserReferenceFacade = $companyUserReferenceFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        $recipientName = null;
        $recipientMailAddress = null;

        try {
            $companyUser = $this->getCompanyUser($mailTransfer, $orderTransfer);
            $companyBusinessUnitTransfer = $this->getCompanyBusinessUnit($companyUser);
            $recipientMailAddress = $companyBusinessUnitTransfer->getEmail();
            $recipientName = $companyBusinessUnitTransfer->getName();
        }
        catch (\Throwable $throwable){
            if ($recipientMailAddress === null) {
                $recipientMailAddress = $orderTransfer->getEmail();
            }
            if ($recipientName === null) {
                $recipientName = sprintf('%s %s', $orderTransfer->getFirstName(), $orderTransfer->getLastName());
            }
            //ToDo: maybe log here
        }



        if ($recipientMailAddress === null) {
            return $mailTransfer;
        }

        if ($this->isRecipient($recipientMailAddress, $mailTransfer) === false) {
            $recipientTransfer = (new MailRecipientTransfer())->setEmail($recipientMailAddress)->setName($recipientName);
            $mailTransfer->addRecipient($recipientTransfer);
        }

        return $this->addRecipientBcc($mailTransfer, $orderTransfer, $recipientMailAddress);
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param string $recipientMailAddress
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    protected function addRecipientBcc(
        MailTransfer $mailTransfer,
        OrderTransfer $orderTransfer,
        string $recipientMailAddress
    ): MailTransfer {
        if (
            $orderTransfer->getEmail() === $recipientMailAddress ||
            $this->isRecipient($orderTransfer->getEmail(), $mailTransfer) === true
        ) {
            return $mailTransfer;
        }

        return $mailTransfer->addRecipientBcc(
            (new MailRecipientTransfer())
                ->setEmail($orderTransfer->getEmail())
                ->setName($orderTransfer->getFirstName() . ' ' . $orderTransfer->getLastName()),
        );
    }

    /**
     * @param string $mail
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return bool
     */
    protected function isRecipient(string $mail, MailTransfer $mailTransfer): bool
    {
        foreach ($mailTransfer->getRecipients() as $recipientTransfer) {
            if ($recipientTransfer->getEmail() === $mail) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected function getCompanyBusinessUnit(CompanyUserTransfer $companyUserTransfer): CompanyBusinessUnitTransfer
    {
        $companyBusinessUnitTransfer = $companyUserTransfer->getCompanyBusinessUnit();
        if ($companyBusinessUnitTransfer !== null) {
            return $companyBusinessUnitTransfer;
        }

        throw new Exception('CompanyUserTransfer has no CompanyBusinessUnitTransfer data!');
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
