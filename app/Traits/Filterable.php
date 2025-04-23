<?php

namespace App\Traits;

trait Filterable
{
    public function scopeFilter($query, array $filters)
    {
        foreach ($filters as $key => $value) {
            if (method_exists($this, 'scope' . ucfirst($key))) {
                $query->{$key}($value);
            } elseif (isset($this->filterable) && in_array($key, $this->filterable)) {
                $query->where($key, $value);
            }
        }

        return $query;
    }
}