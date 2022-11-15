<?php

namespace FondOfOryx\Zed\CustomerRegistration\Persistence;

use DateTime;
use Exception;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationPersistenceFactory getFactory()
 */
class CustomerRegistrationEntityManager extends AbstractEntityManager implements CustomerRegistrationEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function createCustomer(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $customerEntity = new SpyCustomer();
        $customerEntity->fromArray($customerTransfer->toArray());

        $customerEntity = $this->setLocale($customerEntity, $customerTransfer->getLocale());

        $customerEntity->save();

        $customerTransfer->setIdCustomer($customerEntity->getPrimaryKey());
        $customerTransfer->setCustomerReference($customerEntity->getCustomerReference());
        $customerTransfer->setRegistrationKey($customerEntity->getRegistrationKey());
        $customerTransfer->setCreatedAt($this->convertDate($customerEntity->getCreatedAt()));
        $customerTransfer->setUpdatedAt($this->convertDate($customerEntity->getUpdatedAt()));

        return $customerTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function flagCustomerAsVerified(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $customerEntity = $this->resolveCustomerEntity($customerTransfer);

        $customerEntity->setIsVerified(true);
        $customerEntity->save();

        return $customerTransfer
            ->setIsVerified(true)
            ->setIdCustomer($customerEntity->getIdCustomer())
            ->setEmail($customerEntity->getEmail())
            ->setUpdatedAt($this->convertDate($customerEntity->getUpdatedAt()));
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function flagCustomerAsGdprAccepted(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $customerEntity = $this->resolveCustomerEntity($customerTransfer);

        $customerEntity->setGdprAccepted(true);
        $customerEntity->save();

        return $customerTransfer
            ->setGdprAccepted(true)
            ->setIdCustomer($customerEntity->getIdCustomer())
            ->setEmail($customerEntity->getEmail())
            ->setUpdatedAt($this->convertDate($customerEntity->getUpdatedAt()));
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $customerEntity
     * @param \Generated\Shared\Transfer\LocaleTransfer|null $localeTransfer
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer
     */
    protected function setLocale(SpyCustomer $customerEntity, ?LocaleTransfer $localeTransfer): SpyCustomer
    {
        if ($localeTransfer === null) {
            //ToDo get Default locale instead of return

            return $customerEntity;
        }

        $localeEntity = $this->getFactory()->getLocaleQueryContainer()->queryLocaleByName($localeTransfer->getLocaleName())->findOne();

        if ($localeEntity) {
            $customerEntity->setLocale($localeEntity);
        }

        return $customerEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @throws \Exception
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer
     */
    protected function resolveCustomerEntity(CustomerTransfer $customerTransfer): SpyCustomer
    {
        $customerQueryContainer = $this->getFactory()->getCustomerQueryContainer();
        $customerEntity = null;
        $idCustomer = $customerTransfer->getIdCustomer();
        if ($idCustomer !== null) {
            $customerEntity = $customerQueryContainer->queryCustomerById($idCustomer)->findOne();
        }

        $mail = $customerTransfer->getEmail();
        if ($customerEntity === null && $mail !== null) {
            $customerEntity = $customerQueryContainer->queryCustomerByEmail($mail)->findOne();
        }

        if ($customerEntity === null) {
            throw new Exception(sprintf('Could not find customer by id %d nor email %s!', $idCustomer, $mail));
        }

        return $customerEntity;
    }

    /**
     * @param \DateTime|null $dateTime
     *
     * @return string|null
     */
    protected function convertDate(?DateTime $dateTime): ?string
    {
        if ($dateTime === null) {
            return null;
        }

        return $dateTime->format('Y-m-d H:i:s.u');
    }
}
