<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;

class DeveloperController extends AdminController
{
    protected $routes = 'admin.developer';

    public function __construct()
    {
        $this->singularPageTitle = 'Настройки';
        $this->pluralPageTitle = 'Настойки';
    }

    public function menuIndex()
    {
        return view('admin.developer.menu.index')->with('pageTitle', 'Меню')->with('routes', $this->routes);
    }

    public function menuStore(MenuRequest $request)
    {
        Menu::create($request->all());

        return redirect()->route('admin.developer.menu.index')->with('success', 'Действието е записано успешно.');
    }

    public function treeIndex()
    {
        return view('admin.developer.tree.index')->with('pageTitle', 'Дърво')->with('routes', $this->routes);
    }

}
