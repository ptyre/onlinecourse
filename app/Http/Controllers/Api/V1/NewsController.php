<?php

namespace App\Http\Controllers\Api\V1;

use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    public function index()
    {
        return News::all();
    }

    public function show($id)
    {
        return News::findOrFail($id);
    }

    public function update(UpdateNewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $news->update($request->all());
        

        return $news;
    }

    public function store(StoreNewsRequest $request)
    {
        $news = News::create($request->all());
        

        return $news;
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return '';
    }
}
