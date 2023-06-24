<?php

namespace App\Traits;

trait ParamQueryHelper
{
    private function searchHelper($query, $searchData, $attributeSearchData)
    {
        if (! isset($searchData) || ! isset($attributeSearchData)) {
            return $query;
        }

        return $query->where(function ($query) use ($searchData, $attributeSearchData) {
            foreach ($attributeSearchData as $attribute) {
                $query->orWhere($attribute, 'like', '%'.$searchData.'%');
            }
        });
    }
}
