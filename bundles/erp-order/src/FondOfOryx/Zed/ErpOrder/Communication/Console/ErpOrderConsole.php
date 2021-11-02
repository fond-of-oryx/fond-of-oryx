<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Console;

use Exception;
use Generated\Shared\Transfer\ErpOrderAddressTransfer;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderRepositoryInterface getRepository()
 */
class ErpOrderConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'erp:order:test';

    /**
     * @var string
     */
    public const DESCRIPTION = 'Test ErpOrder Module';

    /**
     * @var string
     */
    public const RESOURCE_ERP_ORDER = 'resource';

    /**
     * @var string
     */
    public const RESOURCE_ERP_ORDER_SHORTCUT = 'r';

    /**
     * @var array<string>
     */
    protected $resources = [
        'createErpOrder', 'updateErpOrder', 'deleteErpOrderByIdErpOrder', 'findErpOrderByIdErpOrder',
    ];

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addOption(
            static::RESOURCE_ERP_ORDER,
            static::RESOURCE_ERP_ORDER_SHORTCUT,
            InputArgument::OPTIONAL,
            implode(',', $this->resources),
        );

        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION)
            ->addUsage(sprintf('-%s resource', static::RESOURCE_ERP_ORDER_SHORTCUT));
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @throws \Exception
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $status = static::CODE_SUCCESS;
        $messenger = $this->getMessenger();
        $resources = [];

        if ($input->getOption(static::RESOURCE_ERP_ORDER)) {
            $resourceString = $input->getOption(static::RESOURCE_ERP_ORDER);
            $resources = explode(',', $resourceString);
        }

        try {
            foreach ($resources as $resource) {
                if (in_array($resource, $this->resources) === false) {
                    throw new Exception(sprintf(
                        'Resource %s not available in %s',
                        $resource,
                        implode(',', $this->resources),
                    ));
                }
                $messenger->info(sprintf(
                    'running %s!',
                    $resource,
                ));

                $response = $this->getFacade()->{$resource}($this->getCreateErpOrderData());

                if ($response instanceof ErpOrderResponseTransfer) {
                    $messenger->info(sprintf(
                        'Success: %s',
                        $response->getIsSuccessful() === true ? 'Yes' : 'No',
                    ));

                    if ($response->getIsSuccessful() === true) {
                        $messenger->info(sprintf(
                            'ID: %s',
                            $response->getErpOrder()->getIdErpOrder(),
                        ));
                    }
                }
            }
        } catch (Exception $exception) {
            $status = static::CODE_ERROR;
            $messenger->error(sprintf(
                'Command %s failt with message: %s%s!',
                static::COMMAND_NAME,
                PHP_EOL,
                $exception->getMessage(),
            ));
        }

        $messenger->info(sprintf(
            'You just executed %s!',
            static::COMMAND_NAME,
        ));

        return $status;
    }

    /**
     * @return \Generated\Shared\Transfer\ErpOrderTransfer
     */
    protected function getCreateErpOrderData(): ErpOrderTransfer
    {
        $externalRef = md5((string)time());
        $ref = md5($externalRef);
        $erpOrderTransfer = new ErpOrderTransfer();

        $erpOrderTransfer
            ->setFkCompanyBusinessUnit(2)
            ->setBillingAddress($this->createAddress())
            ->setShippingAddress($this->createAddress())
            ->setReference($ref)
            ->setConcreteDeliveryDate(date('Y-m-d', strtotime('+ 10 days')))
            ->setExternalReference('06aae44d-b33c-4d6a-8bd8-85c61a921f18');

        $rnd = mt_rand(1, 7);
        for ($i = 0; $i < $rnd; $i++) {
            $erpOrderTransfer->addOrderItem($this->createItem());
        }

        return $erpOrderTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\ErpOrderAddressTransfer
     */
    protected function createAddress(): ErpOrderAddressTransfer
    {
        $address = new ErpOrderAddressTransfer();

        $address
            ->setFkCountry(60)
            ->setName1('Hans')
            ->setName2('Wurst')
            ->setAddress1('Wurst Weg 99')
            ->setCity('Wursterer')
            ->setZipCode((string)mt_rand(10000, 99999));

        return $address;
    }

    /**
     * @return \Generated\Shared\Transfer\ErpOrderItemTransfer
     */
    protected function createItem(): ErpOrderItemTransfer
    {
        $item = new ErpOrderItemTransfer();
        $qty = mt_rand(0, 100);
        $item
            ->setName(md5((string)time()))
            ->setSku(sprintf('sku-%s-%s-abc', mt_rand(10000, 99999), mt_rand(10000, 99999)))
            ->setCanceledQuantity(0)
            ->setShippedQuantity($qty)
            ->setOrderedQuantity($qty * mt_rand(1, 3))
            ->setInvoicedQuantity($qty)
            ->setStatus(mt_rand(0, 1));

        return $item;
    }
}
