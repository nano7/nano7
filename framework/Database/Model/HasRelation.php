<?php namespace Nano7\Database\Model;

use Nano7\Database\Model\Relations\EmbedMany;
use Nano7\Database\Model\Relations\EmbedOne;
use Nano7\Database\Model\Relations\Relation;

/**
 * Class HasRelation
 * @property array $attributes
 * @method getAttributeFromArray($key, $default = null)
 * @method setAttributeToArray($key, $value)
 * @method removeAttributeFromArray($key)
 */
trait HasRelation
{
    /**
     * @var array
     */
    protected $relations = [];

    /**
     * @param $related
     * @param null $localKey
     * @param null $relation
     * @return EmbedOne
     */
    protected function embedTo($related, $localKey = null, $relation = null)
    {
        // If no relation name was given, we will use this debug backtrace to extract
        // the calling method's name and use that as the relationship name as most
        // of the time this will be what we desire to use for the relationships.
        if (is_null($relation)) {
            list(, $caller) = debug_backtrace(false);

            $relation = $caller['function'];
        }

        if (is_null($localKey)) {
            $localKey = $relation;
        }

        $instance = new $related(
            function ($key, $id) use ($localKey) {
                $sub = $this->getAttributeFromArray($localKey, []);
                return array_key_exists($key, $sub) ? $sub[$key] : null;
            },
            function ($key, $value, $id) use ($localKey) {
                $sub = $this->getAttributeFromArray($localKey, []);
                $sub[$key] = $value;

                $this->setAttributeToArray($localKey, $sub);
                return null;
            },
            function ($id) use ($localKey) {
                //????
            }
        );

        return new EmbedOne($this, $instance, $localKey);
    }

    /**
     * @param $related
     * @param null $localKey
     * @param null $relation
     * @return EmbedMany
     */
    protected function embedMany($related, $localKey = null, $relation = null)
    {
        // If no relation name was given, we will use this debug backtrace to extract
        // the calling method's name and use that as the relationship name as most
        // of the time this will be what we desire to use for the relationships.
        if (is_null($relation)) {
            list(, $caller) = debug_backtrace(false);

            $relation = $caller['function'];
        }

        if (is_null($localKey)) {
            $localKey = $relation;
        }

        $instance = new $related(
            function ($key, $id) use ($localKey) {
                $list = $this->getAttributeFromArray($localKey, []);
                $item = array_key_exists($id, $list) ? $list[$id] : [];
                return array_key_exists($key, $item) ? $item[$key] : null;
            },
            function ($key, $value, $id) use ($localKey) {
                $list = $this->getAttributeFromArray($localKey, []);

                if (is_null($id)) {
                    $id = count($list);
                    $list[$id] = [];
                }

                $list[$id][$key] = $value;

                $this->setAttributeToArray($localKey, $list);

                return $id;
            },
            function ($id) use ($localKey) {
                $list = $this->getAttributeFromArray($localKey);
                if (is_null($list)) {
                    return;
                }

                if (isset($list[$id])) {
                    unset($list[$id]);
                }

                $this->setAttributeToArray($localKey, $list);
            }
        );

        return new EmbedMany($this, $instance, $localKey);
    }

    /**
     * Get a relationship.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getRelationValue($key)
    {
        // Verificar se relation ja foi carregado
        if (array_key_exists($key, $this->relations)) {
            return $this->relations[$key];
        }

        // Verificar se relation foi implementado
        if (method_exists($this, $key)) {
            return $this->getRelationshipFromMethod($key);
        }

        return null;
    }

    /**
     * Get a relationship value from a method.
     *
     * @param  string  $method
     * @return mixed
     *
     * @throws \LogicException
     */
    protected function getRelationshipFromMethod($method)
    {
        $relation = $this->$method();

        if (! $relation instanceof Relation) {
            throw new \LogicException(sprintf('%s::%s must return a relationship instance.', get_called_class(), $method));
        }

        return $this->relations[$method] = $relation->getResults();
    }
}
