<?php

namespace App\Http\Controllers\Admin;

use App\Commentstudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentstudentsRequest;
use App\Http\Requests\Admin\UpdateCommentstudentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class CommentstudentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Commentstudent.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        
        if (request()->ajax()) {
            $query = Commentstudent::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
       
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'commentstudents.id',
                'commentstudents.name',
                'commentstudents.deskripsi',
                'commentstudents.photo_comment',
                'commentstudents.job',
                'commentstudents.show',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'commentstudent_';
                $routeKey = 'admin.commentstudents';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('deskripsi', function ($row) {
                return $row->deskripsi ? $row->deskripsi : '';
            });
            $table->editColumn('photo_comment', function ($row) {
                if($row->photo_comment) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->photo_comment) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->photo_comment) .'"/>'; };
            });
            $table->editColumn('job', function ($row) {
                return $row->job ? $row->job : '';
            });
            $table->editColumn('show', function ($row) {
                return \Form::checkbox("show", 1, $row->show == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','photo_comment','show']);

            return $table->make(true);
        }

        return view('admin.commentstudents.index');
    }

    /**
     * Show the form for creating new Commentstudent.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.commentstudents.create');
    }

    /**
     * Store a newly created Commentstudent in storage.
     *
     * @param  \App\Http\Requests\StoreCommentstudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentstudentsRequest $request)
    {
        
        $request = $this->saveFiles($request);
        $commentstudent = Commentstudent::create($request->all());



        return redirect()->route('admin.commentstudents.index');
    }


    /**
     * Show the form for editing Commentstudent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $commentstudent = Commentstudent::findOrFail($id);

        return view('admin.commentstudents.edit', compact('commentstudent'));
    }

    /**
     * Update Commentstudent in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentstudentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentstudentsRequest $request, $id)
    {
      
        $request = $this->saveFiles($request);
        $commentstudent = Commentstudent::findOrFail($id);
        $commentstudent->update($request->all());



        return redirect()->route('admin.commentstudents.index');
    }


    /**
     * Display Commentstudent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
    
        $commentstudent = Commentstudent::findOrFail($id);

        return view('admin.commentstudents.show', compact('commentstudent'));
    }


    /**
     * Remove Commentstudent from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $commentstudent = Commentstudent::findOrFail($id);
        $commentstudent->delete();

        return redirect()->route('admin.commentstudents.index');
    }

    /**
     * Delete all selected Commentstudent at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
      
        if ($request->input('ids')) {
            $entries = Commentstudent::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Commentstudent from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
    
        $commentstudent = Commentstudent::onlyTrashed()->findOrFail($id);
        $commentstudent->restore();

        return redirect()->route('admin.commentstudents.index');
    }

    /**
     * Permanently delete Commentstudent from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
      
        $commentstudent = Commentstudent::onlyTrashed()->findOrFail($id);
        $commentstudent->forceDelete();

        return redirect()->route('admin.commentstudents.index');
    }
}
