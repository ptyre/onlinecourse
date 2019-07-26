<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreServicesRequest;
use App\Http\Requests\Admin\UpdateServicesRequest;
use Yajra\DataTables\DataTables;

class ServicesController extends Controller
{
    /**
     * Display a listing of Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        if (request()->ajax()) {
            $query = Service::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
      
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'services.id',
                'services.title_service',
                'services.description',
                'services.photo_service',
                'services.show',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'service_';
                $routeKey = 'admin.services';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title_service', function ($row) {
                return $row->title_service ? $row->title_service : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('photo_service', function ($row) {
                return $row->photo_service ? $row->photo_service : '';
            });
            $table->editColumn('show', function ($row) {
                return \Form::checkbox("show", 1, $row->show == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','show']);

            return $table->make(true);
        }

        return view('admin.services.index');
    }

    /**
     * Show the form for creating new Service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('admin.services.create');
    }

    /**
     * Store a newly created Service in storage.
     *
     * @param  \App\Http\Requests\StoreServicesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServicesRequest $request)
    {
    
        $service = Service::create($request->all());



        return redirect()->route('admin.services.index');
    }


    /**
     * Show the form for editing Service.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $service = Service::findOrFail($id);

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update Service in storage.
     *
     * @param  \App\Http\Requests\UpdateServicesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServicesRequest $request, $id)
    {
      
        $service = Service::findOrFail($id);
        $service->update($request->all());



        return redirect()->route('admin.services.index');
    }


    /**
     * Display Service.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
        $service = Service::findOrFail($id);

        return view('admin.services.show', compact('service'));
    }


    /**
     * Remove Service from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index');
    }

    /**
     * Delete all selected Service at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
     
        if ($request->input('ids')) {
            $entries = Service::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Service from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
    
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->restore();

        return redirect()->route('admin.services.index');
    }

    /**
     * Permanently delete Service from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
      
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->forceDelete();

        return redirect()->route('admin.services.index');
    }
}
