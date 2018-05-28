<?php namespace Nano7\Database\Model;

use Nano7\Foundation\Support\Arr;

/**
 * Class HasAttributes
 * @method string getCast($key, $value)
 * @method string setCast($key, $value)
 * @method bool hasCast($key, $types = null)
 * @method bool hasGetMutator($key)
 * @method bool hasSetMutator($key)
 * @method mixed getMutateAttribute($key, $value)
 * @method mixed setMutateAttribute($key, $value)
 * @method mixed getRelationValue($key)
 */
trait HasAttributes
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The model attribute's original state.
     *
     * @var array
     */
    protected $original = [];

    /**
     * The model attributes changed of from original.
     *
     * @var array
     */
    protected $changed = [];

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        // Verificar se foi implemetado um relacionamento
        $value = $this->getRelationValue($key);
        if (! is_null($value)) {
            return $value;
        }

        // Verificar se o campo existe fisicamente ou foi implementado um mutator
        if (array_key_exists($key, $this->attributes) || $this->hasGetMutator($key)) {
            return $this->getAttributeValue($key);
        }

        return null;
    }

    /**
     * Get an attribute from the array in model.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function getAttributeFromArray($key, $default = null)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : $default;
    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getAttributeValue($key)
    {
        $value = $this->getAttributeFromArray($key);

        // Verificar se foi implementado um mutator
        if ($this->hasGetMutator($key)) {
            return $this->getMutateAttribute($key, $value);
        }

        // Verificar se foi definido o cast do key
        if ($this->hasCast($key)) {
            return $this->getCast($key, $value);
        }

        return $value;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        // First we will check for the presence of a mutator for the set operation
        // which simply lets the developers tweak the attribute as it is set on
        // the model, such as "json_encoding" an listing of data for storage.
        if ($this->hasSetMutator($key)) {
            return $this->setMutateAttribute($key, $value);
        }

        // Verificar se foi definido o cast do key
        if ($this->hasCast($key)) {
            $value = $this->setCast($key, $value);
        }

        return $this->setAttributeToArray($key, $value);
    }

    /**
     * Set an attribute to the array in model.
     *
     * @param  string  $key
     * @param  mixed $value
     * @return $this
     */
    public function setAttributeToArray($key, $value)
    {
        // Marcar key como alterado
        $this->changed[$key] = true;

        // Setar no array de atributos
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Remove a attribute.
     *
     * @param $key
     */
    public function removeAttributeFromArray($key)
    {
        if (isset($this->attributes[$key])) {
            unset($this->attributes[$key]);
        }
    }

    /**
     * Get the model's original attribute values.
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed|array
     */
    public function getOriginal($key = null, $default = null)
    {
        return Arr::get($this->original, $key, $default);
    }

    /**
     * Sync the original attributes with the current.
     *
     * @return $this
     */
    public function syncOriginal()
    {
        $this->original = $this->attributes;
        $this->changed  = [];

        return $this;
    }

    /**
     * Get the attributes that have been changed since last sync.
     *
     * @return array
     */
    public function getChanged()
    {
        $values = [];

        foreach (array_keys($this->changed) as $key) {
            $values[$key] = array_key_exists($key, $this->attributes) ? $this->attributes[$key] : null;
        }

        return $values;
    }

    /**
     * Verifica e retorna se ha alguma alteracao para ser salva.
     *
     * @return bool
     */
    public function hasChanged()
    {
        return count($this->getChanged()) > 0;
    }

    /**
     * Get all of the current attributes on the model.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get all of the current original on the model.
     *
     * @return array
     */
    public function getOriginals()
    {
        return $this->original;
    }
}
