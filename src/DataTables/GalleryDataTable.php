<?php

declare(strict_types=1);

namespace Molitor\Gallery\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Molitor\Admin\DataTables\DataTable;
use Molitor\Gallery\Http\Resources\GalleryResource;
use Molitor\Gallery\Models\Gallery;

class GalleryDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return Gallery::class;
    }

    protected function getResourceClass(): string
    {
        return GalleryResource::class;
    }

    protected function getSearchPlaceholder(): string
    {
        return 'Keresés név vagy slug alapján...';
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')->setSearchable()->setOrderable();
    }

    public function query(Builder $query): Builder
    {
        return $query->with('images');
    }
}
