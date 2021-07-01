<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder\Business\Model\Mapper;

use Generated\Shared\Transfer\JellyfishOrderAddressTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;

class JellyfishOrderAddressMapper implements JellyfishOrderAddressMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderAddressExpanderPostMapPluginInterface[]
     */
    protected $jellyfishOrderAddressExpanderPostMapPlugins;

    /**
     * @param \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderAddressExpanderPostMapPluginInterface[] $jellyfishOrderAddressExpanderPostMapPlugins
     */
    public function __construct(array $jellyfishOrderAddressExpanderPostMapPlugins)
    {
        $this->jellyfishOrderAddressExpanderPostMapPlugins = $jellyfishOrderAddressExpanderPostMapPlugins;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $salesOrderAddress
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    public function fromSalesOrderAddress(SpySalesOrderAddress $salesOrderAddress): JellyfishOrderAddressTransfer
    {
        $jellyfishOrderAddressTransfer = new JellyfishOrderAddressTransfer();

        $jellyfishOrderAddressTransfer->setId($salesOrderAddress->getIdSalesOrderAddress())
            ->setName1($salesOrderAddress->getFirstName())
            ->setName2($salesOrderAddress->getLastName())
            ->setAddress1($salesOrderAddress->getAddress1())
            ->setAddress2($salesOrderAddress->getAddress2())
            ->setAddress3($salesOrderAddress->getAddress3())
            ->setCity($salesOrderAddress->getCity())
            ->setZipCode($salesOrderAddress->getZipCode())
            ->setCountry($salesOrderAddress->getCountry()->getIso2Code())
            ->setPhone($salesOrderAddress->getPhone());

        $jellyfishOrderAddressTransfer = $this->expandOrderAddressTransfer($jellyfishOrderAddressTransfer, $salesOrderAddress);

        return $jellyfishOrderAddressTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress $salesOrderAddress
     *
     * @return \Generated\Shared\Transfer\JellyfishOrderAddressTransfer
     */
    protected function expandOrderAddressTransfer(
        JellyfishOrderAddressTransfer $jellyfishOrderAddressTransfer,
        SpySalesOrderAddress $salesOrderAddress
    ): JellyfishOrderAddressTransfer {
        foreach ($this->jellyfishOrderAddressExpanderPostMapPlugins as $jellyfishOrderAddressExpanderPostMapPlugin) {
            $jellyfishOrderAddressTransfer = $jellyfishOrderAddressExpanderPostMapPlugin->expand($jellyfishOrderAddressTransfer, $salesOrderAddress);
        }

        return $jellyfishOrderAddressTransfer;
    }
}
