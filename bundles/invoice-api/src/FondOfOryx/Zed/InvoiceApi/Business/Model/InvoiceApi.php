<?php

namespace FondOfOryx\Zed\InvoiceApi\Business\Model;

use FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface;
use FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface;
use FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class InvoiceApi implements InvoiceApiInterface
{
    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface
     */
    protected $apiFacade;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface
     */
    protected $invoiceFacade;

    /**
     * @var \FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface
     */
    protected $transferMapper;

    /**
     * @param \FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToApiFacadeInterface $apiFacade
     * @param \FondOfOryx\Zed\InvoiceApi\Business\Mapper\TransferMapperInterface $transferMapper
     * @param \FondOfOryx\Zed\InvoiceApi\Dependency\Facade\InvoiceApiToInvoiceFacadeInterface $invoiceFacade
     */
    public function __construct(
        InvoiceApiToApiFacadeInterface $apiFacade,
        TransferMapperInterface $transferMapper,
        InvoiceApiToInvoiceFacadeInterface $invoiceFacade
    ) {
        $this->apiFacade = $apiFacade;
        $this->transferMapper = $transferMapper;
        $this->invoiceFacade = $invoiceFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ApiDataTransfer $apiDataTransfer
     *
     * @throws \Spryker\Zed\Api\Business\Exception\EntityNotSavedException
     *
     * @return \Generated\Shared\Transfer\ApiItemTransfer
     */
    public function add(ApiDataTransfer $apiDataTransfer): ApiItemTransfer
    {
        $data = (array)$apiDataTransfer->getData();

        $invoiceTransfer = $this->transferMapper->toTransfer($data);

        $invoiceResponseTransfer = $this->invoiceFacade->createInvoice(
            $invoiceTransfer,
        );

        $invoiceTransfer = $invoiceResponseTransfer->getInvoiceTransfer();

        if ($invoiceTransfer === null || $invoiceResponseTransfer->getIsSuccess() === false) {
            throw new EntityNotSavedException(
                'Could not save invoice.',
                ApiConfig::HTTP_CODE_INTERNAL_ERROR,
            );
        }

        return $this->apiFacade->createApiItem(
            $invoiceTransfer,
            (string)$invoiceTransfer->getIdInvoice(),
        );
    }
}
