<?php
/**
 * HasMany
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 * @date January 13th, 2016
 */

namespace Nova\ORM\Relation;

use Nova\ORM\Model;
use Nova\ORM\Relation;


class HasMany extends Relation
{
    protected $foreignKey;
    protected $primaryKey;


    public function __construct($className, Model $model, $foreignKey)
    {
        parent::__construct($className);

        // The foreignKey is associated to host Model.
        $this->foreignKey = $foreignKey;

        // The primaryKey is associated to host Model.
        $this->primaryKey = $model->getPrimaryKey();
    }

    public function type()
    {
        return 'hasMany';
    }

    public function get()
    {
        $order = $this->getOrder();
        $limit = $this->getLimit();
        $offset = $this->getOffset();

        $result = $this->model
            ->where($this->wheres())
            ->orderBy($order)
            ->limit($limit)
            ->offset($offset)
            ->findManyBy($this->foreignKey, $this->primaryKey);

        $this->resetState();

        return $result;
    }
}
