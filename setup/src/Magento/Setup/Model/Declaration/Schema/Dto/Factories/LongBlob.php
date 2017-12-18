<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Model\Declaration\Schema\Dto\Factories;

use Magento\Framework\ObjectManagerInterface;

/**
 * Create text with different params
 */
class LongBlob implements FactoryInterface
{
    /**
     * Default small integer padding
     */
    const DEFAULT_BLOB_LENGTH = 2147483648;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var string
     */
    private $className;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $className
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $className = \Magento\Setup\Model\Declaration\Schema\Dto\Columns\Blob::class
    ) {
        $this->objectManager = $objectManager;
        $this->className = $className;
    }

    /**
     * Set default padding, like SMALLINT(5)
     *
     * {@inheritdoc}
     * @return array
     */
    public function create(array $data)
    {
        if (!isset($data['length'])) {
            $data['length'] = self::DEFAULT_BLOB_LENGTH;
        }

        return $this->objectManager->create($this->className, $data);
    }
}
