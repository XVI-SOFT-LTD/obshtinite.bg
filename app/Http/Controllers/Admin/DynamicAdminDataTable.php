<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminDataTable;

class DynamicAdminDataTable extends AdminDataTable
{
    protected array $skipSortableIds = [];

    public function setSkipSortableIds(array $ids = [])
    {
        $this->skipSortableIds = $ids;
    }

    public function getSkipSortableIds()
    {
        return $this->skipSortableIds;
    }

    /**
     * Override the render method
     * */
    public function render($pageTitle = null)
    {
        return view('admin.datatable.index_dynamics', [
            'dataTable' => $this,
            'routes' => $this->getRoute(),
            'breadcrumbs' => $this->breadcrumbs,
            'hideCreateButton' => $this->hideCreateButton,
        ])
            ->with('pageTitle', 'Списък с ' . $pageTitle);
    }
}
