<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\GraphQl\Quote;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\ResourceModel\Quote as QuoteResource;
use Magento\Quote\Model\QuoteIdToMaskedQuoteIdInterface;
use Magento\Quote\Model\QuoteFactory;

/**
 * Get masked quote id by reserved order id
 */
class GetMaskedQuoteIdByReservedOrderId
{
    /**
     * @var QuoteFactory
     */
    private $quoteFactory;

    /**
     * @var QuoteResource
     */
    private $quoteResource;

    /**
     * @var QuoteIdToMaskedQuoteIdInterface
     */
    private $quoteIdToMaskedId;

    /**
     * @param QuoteFactory $quoteFactory
     * @param QuoteResource $quoteResource
     * @param QuoteIdToMaskedQuoteIdInterface $quoteIdToMaskedId
     */
    public function __construct(
        QuoteFactory $quoteFactory,
        QuoteResource $quoteResource,
        QuoteIdToMaskedQuoteIdInterface $quoteIdToMaskedId
    ) {
        $this->quoteFactory = $quoteFactory;
        $this->quoteResource = $quoteResource;
        $this->quoteIdToMaskedId = $quoteIdToMaskedId;
    }

    /**
     * Get masked quote id by reserved order id
     *
     * @param string $reversedOrderId
     * @return string
     * @throws NoSuchEntityException
     */
    public function execute(string $reversedOrderId): string
    {
        $quote = $this->quoteFactory->create();
        $this->quoteResource->load($quote, $reversedOrderId, 'reserved_order_id');

        return $this->quoteIdToMaskedId->execute((int)$quote->getId());
    }
}
