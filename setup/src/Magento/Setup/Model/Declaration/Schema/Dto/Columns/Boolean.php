<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Model\Declaration\Schema\Dto\Columns;

use Magento\Setup\Model\Declaration\Schema\Dto\Column;
use Magento\Setup\Model\Declaration\Schema\Dto\ElementDiffAwareInterface;
use Magento\Setup\Model\Declaration\Schema\Dto\Table;

/**
 * Boolean column
 * Declared in SQL, like TINYINT(1) or BOOL or BOOLEAN. Is just alias for integer or binary type.
 */
class Boolean extends Column implements
    ElementDiffAwareInterface,
    ColumnNullableAwareInterface
{
    /**
     * @var bool
     */
    private $nullable;

    /**
     * @var bool
     */
    private $default;

    /**
     * @param string $name
     * @param string $elementType
     * @param Table $table
     * @param $nullable
     * @param $default
     */
    public function __construct(
        string $name,
        string $elementType,
        Table $table,
        bool $nullable = true,
        bool $default = false
    ) {
        parent::__construct($name, $elementType, $table);
        $this->nullable = $nullable;
        $this->default = $default;
    }

    /**
     * Check whether column can be nullable
     *
     * @return bool
     */
    public function isNullable()
    {
        return $this->nullable;
    }

    /**
     * Return default value
     * Note: default value should be float
     *
     * @return float | null
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @inheritdoc
     */
    public function getDiffSensitiveParams()
    {
        return [
            'nullable' => $this->isNullable(),
            'default' => $this->getDefault()
        ];
    }
}
