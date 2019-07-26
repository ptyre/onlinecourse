<?php

namespace App\Http\Controllers\Admin;

use App\Qoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQoutesRequest;
use App\Http\Requests\Admin\UpdateQoutesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class QoutesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Qoute.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        
        if (request()->ajax()) {
            $query = Qoute::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
      
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'qoutes.id',
                'qoutes.title',
                'qoutes.description',
                'qoutes.picture_qoute',
                'qoutes.show',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'qoute_';
                $routeKey = 'admin.qoutes';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('picture_qoute', function ($row) {
                if($row->picture_qoute) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->picture_qoute) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->picture_qoute) .'"/>'; };
            });
            $table->editColumn('show', function ($row) {
                return \Form::checkbox("show", 1, $row->show == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','picture_qoute','show']);

            return $table->make(true);
        }

        return view('admin.qoutes.index');
    }

    /**
     * Show the form for creating new Qoute.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('admin.qoutes.create');
    }

    /**
     * Store a newly created Qoute in storage.
     *
     * @param  \App\Http\Requests\StoreQoutesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQoutesRequest $request)
    {
       
        $request = $this->saveFiles($request);
        $qoute = Qoute::create($request->all());



        return redirect()->route('admin.qoutes.index');
    }


    /**
     * Show the form for editing Qoute.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $qoute = Qoute::findOrFail($id);

        return view('admin.qoutes.edit', compact('qoute'));
    }

    /**
     * Update Qoute in storage.
     *
     * @param  \App\Http\Requests\UpdateQoutesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQoutesRequest $request, $id)
    {
       
        $request = $this->saveFiles($request);
        $qoute = Qoute::findOrFail($id);
        $qoute->update($request->all());



        return redirect()->route('admin.qoutes.index');
    }


    /**
     * Display Qoute.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $qoute = Qoute::findOrFail($id);

        return view('admin.qoutes.show', compact('qoute'));
    }


    /**
     * Remove Qoute from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $qoute = Qoute::findOrFail($id);
        $qoute->delete();

        return redirect()->route('admin.qoutes.index');
    }

    /**
     * Delete all selected Qoute at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
      
        if ($request->input('ids')) {
            $entries = Qoute::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Qoute from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
      
        $qoute = Qoute::onlyTrashed()->findOrFail($id);
        $qoute->restore();

        return redirect()->route('admin.qoutes.index');
    }

    /**
     * Permanently delete Qoute from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
       
        $qoute = Qoute::onlyTrashed()->findOrFail($id);
        $qoute->forceDelete();

        return redirect()->route('admin.qoutes.index');
    }
}
