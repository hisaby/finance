<?php

namespace App\GraphQL\Directives;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgBuilderDirective;
use Nuwave\Lighthouse\Support\Contracts\ArgDirectiveForArray;

final class SearchDirective extends BaseDirective implements ArgDirectiveForArray, ArgBuilderDirective
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
"""
Perform search operation.
"""
directive @search(within: String) on ARGUMENT_DEFINITION
GRAPHQL;
    }

    /**
     * Add additional constraints to the builder based on the given argument value.
     *
     * @param  Builder $builder
     * @param  mixed  $value
     * @return Builder
     */
    public function handleBuilder($builder, $value): Builder
    {
        if($builder->getModel() instanceof Transaction) {
            return $builder->where('amount', 'LIKE', "%$value%")
                ->orWhereHas('brand', function($builder) use($value) {
                    return $builder->where('name', 'LIKE', "%$value%");
                })->orWhere('note', 'LIKE', "%$value%");
        }

        return $builder;
    }
}
