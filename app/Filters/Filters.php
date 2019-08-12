<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $builder;
    protected $request;
    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        // get all valid filters
        foreach ($this->getFilters() as $filter => $value) {
            // check if filter method exists
            if (method_exists($this, $filter)) {
                // apply filter
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    /**
     * Get only defined filters query
     *
     * @return array valid filters
     */
    public function getFilters()
    {
        return $this->request->only($this->filters);
    }
}
