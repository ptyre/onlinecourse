<?php

namespace App\Http\Controllers\Admin;

use App\Titlefooter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTitlefootersRequest;
use App\Http\Requests\Admin\UpdateTitlefootersRequest;
use Yajra\DataTables\DataTables;

class TitlefootersController extends Controller
{
    /**
     * Display a listing of Titlefooter.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      


        
        if (request()->ajax()) {
            $query = Titlefooter::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
      
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'titlefooters.id',
                'titlefooters.title',
                'titlefooters.qoute',
                'titlefooters.small_descriptive_footer',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'titlefooter_';
                $routeKey = 'admin.titlefooters';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('qoute', function ($row) {
                return $row->qoute ? $row->qoute : '';
            });
            $table->editColumn('small_descriptive_footer', function ($row) {
                return $row->small_descriptive_footer ? $row->small_descriptive_footer : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.titlefooters.index');
    }

    /**
     * Show the form for creating new Titlefooter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.titlefooters.create');
    }

    /**
     * Store a newly created Titlefooter in storage.
     *
     * @param  \App\Http\Requests\StoreTitlefootersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTitlefootersRequest $request)
    {
     
        $titlefooter = Titlefooter::create($request->all());



        return redirect()->route('admin.titlefooters.index');
    }


    /**
     * Show the form for editing Titlefooter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $titlefooter = Titlefooter::findOrFail($id);

        return view('admin.titlefooters.edit', compact('titlefooter'));
    }

    /**
     * Update Titlefooter in storage.
     *
     * @param  \App\Http\Requests\UpdateTitlefootersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTitlefootersRequest $request, $id)
    {
      
        $titlefooter = Titlefooter::findOrFail($id);
        $titlefooter->update($request->all());



        return redirect()->route('admin.titlefooters.index');
    }


    /**
     * Display Titlefooter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $titlefooter = Titlefooter::findOrFail($id);

        return view('admin.titlefooters.show', compact('titlefooter'));
    }


    /**
     * Remove Titlefooter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $titlefooter = Titlefooter::findOrFail($id);
        $titlefooter->delete();

        return redirect()->route('admin.titlefooters.index');
    }

    /**
     * Delete all selected Titlefooter at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
     
        if ($request->input('ids')) {
            $entries = Titlefooter::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Titlefooter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
     
        $titlefooter = Titlefooter::onlyTrashed()->findOrFail($id);
        $titlefooter->restore();

        return redirect()->route('admin.titlefooters.index');
    }

    /**
     * Permanently delete Titlefooter from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
    
        $titlefooter = Titlefooter::onlyTrashed()->findOrFail($id);
        $titlefooter->forceDelete();

        return redirect()->route('admin.titlefooters.index');
    }
}
