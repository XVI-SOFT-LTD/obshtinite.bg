<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;

class MenuController extends AdminController
{
    public function updateMenuOrder(Request $request)
    {
        $menuOrder = $request->input('menuOrder');
        if (!empty($menuOrder)) {
            $menuOrder = json_decode($menuOrder, true);
            DB::table('menus')->truncate();
            foreach ($menuOrder as $menu) {
                $this->updateDB($menu, 0);
            }
        }

        return redirect()->route('admin.developer.menu.index')->with('success', 'Менюто е добавено успешно.');
    }

    private function updateDB(array $menu, int $parentId = 0)
    {
        $lastId = DB::table('menus')->insertGetId([
            'parent_id' => $parentId,
            'title' => $menu['title'],
            'url' => $menu['url'],
            'icon' => $menu['icon'] ?? null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if (isset($menu['children']) && count($menu['children'])) {
            foreach ($menu['children'] as $child) {
                $this->updateDB($child, $lastId);
            }
        }

    }

}
