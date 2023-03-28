<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer;

use FondOfOryx\Shared\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiConstants;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;

class CompanyUserWriter implements CompanyUserWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface
     */
    protected CompanyUserReaderInterface $companyUserReader;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface
     */
    protected BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface $businessOnBehalfFacade;

    /**
     * @param \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader\CompanyUserReaderInterface $companyUserReader
     * @param \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface $businessOnBehalfFacade
     */
    public function __construct(
        CompanyUserReaderInterface $companyUserReader,
        BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface $businessOnBehalfFacade
    ) {
        $this->companyUserReader = $companyUserReader;
        $this->businessOnBehalfFacade = $businessOnBehalfFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer
     */
    public function setDefaultByRestBusinessOnBehalfRequest(
        RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
    ): RestBusinessOnBehalfResponseTransfer {
        $restBusinessOnBehalfResponseTransfer = (new RestBusinessOnBehalfResponseTransfer())->setIsSuccessful(true);
        $companyUserTransfer = $this->companyUserReader->getByRestBusinessOnBehalfRequest(
            $restBusinessOnBehalfRequestTransfer,
        );

        if ($companyUserTransfer === null) {
            $restBusinessOnBehalfErrorTransfer = (new RestBusinessOnBehalfErrorTransfer())
                ->setMessage(BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_COMPANY_USER_NOT_FOUND)
                ->setErrorCode(BusinessOnBehalfRestApiConstants::ERROR_CODE_COMPANY_USER_NOT_FOUND);

            return $restBusinessOnBehalfResponseTransfer->setIsSuccessful(false)
                ->addError($restBusinessOnBehalfErrorTransfer);
        }

        $customerTransfer = $companyUserTransfer->getCustomer();

        if ($customerTransfer === null) {
            $restBusinessOnBehalfErrorTransfer = (new RestBusinessOnBehalfErrorTransfer())
                ->setMessage(BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_INVALID_COMPANY_USER)
                ->setErrorCode(BusinessOnBehalfRestApiConstants::ERROR_CODE_INVALID_COMPANY_USER);

            return $restBusinessOnBehalfResponseTransfer->setIsSuccessful(false)
                ->addError($restBusinessOnBehalfErrorTransfer);
        }

        $this->businessOnBehalfFacade->unsetDefaultCompanyUserByCustomer($companyUserTransfer->getCustomer());
        $this->businessOnBehalfFacade->setDefaultCompanyUser($companyUserTransfer);

        return $restBusinessOnBehalfResponseTransfer;
    }
}
