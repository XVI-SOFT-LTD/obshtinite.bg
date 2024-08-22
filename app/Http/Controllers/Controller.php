<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $onPage = 20;

    public array $breadcrumbs = [];

    public string $h1 = '';
    public string $pageTitle = '';
    public string $metaDescription = '';
    public string $metaKeywords = '';

    public function __construct()
    {
        $this->onPage = config('settings.pagination.frontend');
    }

    public function setSortable(Request $request)
    {
        $orderBy = $request->get('order_by') ?? 0;
        $onPage = $request->get('on_page') ?? $this->onPage;

        Session::put('sortable.orderBy', $orderBy);
        Session::put('sortable.onPage', $onPage);

        return redirect()->back();
    }
}
