<?php namespace Nano7\Database\Model\Relations;

use Nano7\Database\Model\Builder;

abstract class ForeignRelation extends Relation
{
    /**
     * The Eloquent query builder instance.
     *
     * @var Builder
     */
    protected $query;

    /**
     * The foreign key of the parent model.
     *
     * @var string
     */
    protected $foreignKey;

    /**
     * The associated key on the parent model.
     *
     * @var string
     */
    protected $ownerKey;

    /**
     * @param $parent
     * @param Builder $query
     */
    public function __construct($parent, Builder $query, $foreignKey, $ownerKey)
    {
        parent::__construct($parent, $query->getModel());

        $this->query = $query;
        $this->foreignKey = $foreignKey;
        $this->ownerKey = $ownerKey;

        $this->addConstraints();
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->query;
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    abstract public function addConstraints();
}