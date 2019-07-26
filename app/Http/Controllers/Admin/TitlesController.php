<?php

namespace App\Http\Controllers\Admin;

use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTitlesRequest;
use App\Http\Requests\Admin\UpdateTitlesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class TitlesController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Title.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       


        
        if (request()->ajax()) {
            $query = Title::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
       
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'titles.id',
                'titles.title',
                'titles.header_photo',
                'titles.type',
                'titles.show',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'title_';
                $routeKey = 'admin.titles';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('header_photo', function ($row) {
                if($row->header_photo) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->header_photo) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->header_photo) .'"/>'; };
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('show', function ($row) {
                return \Form::checkbox("show", 1, $row->show == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','header_photo','show']);

            return $table->make(true);
        }

        return view('admin.titles.index');
    }

    /**
     * Show the form for creating new Title.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.titles.create');
    }

    /**
     * Store a newly created Title in storage.
     *
     * @param  \App\Http\Requests\StoreTitlesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTitlesRequest $request)
    {
      
        $request = $this->saveFiles($request);
        $title = Title::create($request->all());



        return redirect()->route('admin.titles.index');
    }


    /**
     * Show the form for editing Title.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $title = Title::findOrFail($id);

        return view('admin.titles.edit', compact('title'));
    }

    /**
     * Update Title in storage.
     *
     * @param  \App\Http\Requests\UpdateTitlesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTitlesRequest $request, $id)
    {
     
        $request = $this->saveFiles($request);
        $title = Title::findOrFail($id);
        $title->update($request->all());



        return redirect()->route('admin.titles.index');
    }


    /**
     * Display Title.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     
        $title = Title::findOrFail($id);

        return view('admin.titles.show', compact('title'));
    }


    /**
     * Remove Title from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
        $title = Title::findOrFail($id);
        $title->delete();

        return redirect()->route('admin.titles.index');
    }

    /**
     * Delete all selected Title at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
     
        if ($request->input('ids')) {
            $entries = Title::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Title from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
      
        $title = Title::onlyTrashed()->findOrFail($id);
        $title->restore();

        return redirect()->route('admin.titles.index');
    }

    /**
     * Permanently delete Title from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
   
        $title = Title::onlyTrashed()->findOrFail($id);
        $title->forceDelete();

        return redirect()->route('admin.titles.index');
    }
}
