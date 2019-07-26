<?php

namespace App\Http\Controllers\Api\V1;

use App\Titlefooter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTitlefootersRequest;
use App\Http\Requests\Admin\UpdateTitlefootersRequest;
use Yajra\DataTables\DataTables;

class TitlefootersController extends Controller
{
    public function index()
    {
        return Titlefooter::all();
    }

    public function show($id)
    {
        return Titlefooter::findOrFail($id);
    }

    public function update(UpdateTitlefootersRequest $request, $id)
    {
        $titlefooter = Titlefooter::findOrFail($id);
        $titlefooter->update($request->all());
        

        return $titlefooter;
    }

    public function store(StoreTitlefootersRequest $request)
    {
        $titlefooter = Titlefooter::create($request->all());
        

        return $titlefooter;
    }

    public function destroy($id)
    {
        $titlefooter = Titlefooter::findOrFail($id);
        $titlefooter->delete();
        return '';
    }
}
