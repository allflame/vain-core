<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-core
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-core
 */
declare(strict_types = 1);

namespace Vain\Core\Database\Phinx;

use Phinx\Db\Adapter\PostgresAdapter;
use Phinx\Db\Table\Column;

/**
 * Class PhinxPostgresAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhinxPostgresAdapter extends PostgresAdapter
{
    const PHINX_TYPE_INET = 'inet';

    /**
     * @inheritDoc
     */
    public function getAdapterType()
    {
        return 'postgres';
    }

    /**
     * @inheritDoc
     */
    public function getColumnTypes()
    {
        return array_merge(parent::getColumnTypes(), ['inet']);
    }

    /**
     * @inheritDoc
     */
    public function isValidColumnType(Column $column)
    {
        return parent::isValidColumnType($column);
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        if (isset($options['default_migration_table'])) {
            $this->setSchemaTableName($options['default_migration_table']);
        }

        if (isset($options['pdo'])) {
            $this->setConnection($options['pdo']);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSqlType($type, $limit = null)
    {
        if (static::PHINX_TYPE_INET === $type) {
            return ['name' => $type];
        }

        return parent::getSqlType($type, $limit);
    }

    /**
     * @inheritDoc
     */
    public function getPhinxType($sqlType)
    {
        if ('inet' === $sqlType) {
            return static::PHINX_TYPE_INET;
        }

        return parent::getPhinxType($sqlType);
    }
}
