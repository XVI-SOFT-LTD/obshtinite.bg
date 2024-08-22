<?php

namespace App\Http\Controllers\Admin;

class AdminDataTable
{
    public const NAMESPACE  = "admin.";

    protected $route = '';
    protected $columns = [];
    protected $rows = [];
    protected $actions = [];
    protected $breadcrumbs = [];
    protected $paginator;
    protected $hideCreateButton = false;

    protected function hideCreateButton()
    {
        $this->hideCreateButton = true;
    }

    public function getHideCreateButton()
    {
        return $this->hideCreateButton;
    }

    public function setHideCreateButton(bool $hideCreateButton)
    {
        $this->hideCreateButton = $hideCreateButton;
    }

    public function setRoute(string $route)
    {
        if (!str_starts_with($route, self::NAMESPACE)) {
            $route = self::NAMESPACE . $route;

        }

        $this->route = $route;
    }

    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function setBreadcrumbs(array $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /*
     * @param Eloquent\Collection $data
     * @param array $columns
     */
    public function setRows($data, $columns)
    {
        $rows = [];

        foreach ($data as $item) {
            $row = new \stdClass();

            $row->id = $item->id;
            foreach ($columns as $key => $value) {
                if (is_callable($value)) {
                    // Изпълняване на Closure и присвояване на резултата
                    $row->$key = call_user_func($value, $item);
                } elseif (is_string($key)) {
                    // Присвояване на стойността от Closure, ако има такава
                    $row->$key = $item->$value;
                } else {
                    // Присвояване на стойността директно от свойството на обекта
                    $row->$value = $item->$value;
                }
            }

            $rows[] = $row;
        }

        $this->rows = $rows;
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function getRowsCount()
    {
        return count($this->rows);
    }

    public function setActions(array $actions)
    {
        $this->actions = $actions;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function render($pageTitle = null)
    {
        return view('admin.datatable.index', [
            'dataTable' => $this,
            'routes' => $this->getRoute(),
            'breadcrumbs' => $this->breadcrumbs,
            'paginator' => $this->paginator,
            'hideCreateButton' => $this->hideCreateButton,
        ])
            ->with('pageTitle', 'Списък с ' . $pageTitle);
    }
}
