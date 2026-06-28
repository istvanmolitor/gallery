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

    protected function initColumns(): void
    {
        $this->addColumn('name')->setSearchable()->setOrderable();
    }

    protected function getBaseQuery(): Builder
    {
        return Gallery::query()->with('images');
    }
}
