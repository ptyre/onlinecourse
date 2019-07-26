<?php

namespace App\Http\Controllers\Api\V1;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagsRequest;
use App\Http\Requests\Admin\UpdateTagsRequest;
use Yajra\DataTables\DataTables;

class TagsController extends Controller
{
    public function index()
    {
        return Tag::all();
    }

    public function show($id)
    {
        return Tag::findOrFail($id);
    }

    public function update(UpdateTagsRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        

        return $tag;
    }

    public function store(StoreTagsRequest $request)
    {
        $tag = Tag::create($request->all());
        

        return $tag;
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return '';
    }
}
