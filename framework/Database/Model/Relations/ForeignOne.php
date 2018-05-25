<?php namespace Nano7\Database\Model\Relations;

use Nano7\Database\Model\Model;

class ForeignOne extends ForeignRelation
{
    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        $this->query->where($this->ownerKey, '=', $this->parent->{$this->foreignKey});
    }

    /**
     * Get the results of the relationship.
     *
     * @return null|Model
     */
    public function getResults()
    {
        return $this->query->first() ?: $this->related->newInstance();
    }
}