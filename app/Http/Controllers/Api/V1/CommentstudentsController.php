<?php

namespace App\Http\Controllers\Api\V1;

use App\Commentstudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentstudentsRequest;
use App\Http\Requests\Admin\UpdateCommentstudentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class CommentstudentsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Commentstudent::all();
    }

    public function show($id)
    {
        return Commentstudent::findOrFail($id);
    }

    public function update(UpdateCommentstudentsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $commentstudent = Commentstudent::findOrFail($id);
        $commentstudent->update($request->all());
        

        return $commentstudent;
    }

    public function store(StoreCommentstudentsRequest $request)
    {
        $request = $this->saveFiles($request);
        $commentstudent = Commentstudent::create($request->all());
        

        return $commentstudent;
    }

    public function destroy($id)
    {
        $commentstudent = Commentstudent::findOrFail($id);
        $commentstudent->delete();
        return '';
    }
}
