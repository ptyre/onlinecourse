<?php

namespace App\Http\Controllers\Admin;

use App\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRegistersRequest;
use App\Http\Requests\Admin\UpdateRegistersRequest;
use Yajra\DataTables\DataTables;

class RegistersController extends Controller
{
    /**
     * Display a listing of Register.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       


        
        if (request()->ajax()) {
            $query = Register::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
      
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'registers.id',
                'registers.title_register',
                'registers.deskripsi_register',
                'registers.show',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'register_';
                $routeKey = 'admin.registers';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title_register', function ($row) {
                return $row->title_register ? $row->title_register : '';
            });
            $table->editColumn('deskripsi_register', function ($row) {
                return $row->deskripsi_register ? $row->deskripsi_register : '';
            });
            $table->editColumn('show', function ($row) {
                return \Form::checkbox("show", 1, $row->show == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','show']);

            return $table->make(true);
        }

        return view('admin.registers.index');
    }

    /**
     * Show the form for creating new Register.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.registers.create');
    }

    /**
     * Store a newly created Register in storage.
     *
     * @param  \App\Http\Requests\StoreRegistersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegistersRequest $request)
    {
     
        $register = Register::create($request->all());



        return redirect()->route('admin.registers.index');
    }


    /**
     * Show the form for editing Register.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $register = Register::findOrFail($id);

        return view('admin.registers.edit', compact('register'));
    }

    /**
     * Update Register in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistersRequest $request, $id)
    {
       
        $register = Register::findOrFail($id);
        $register->update($request->all());



        return redirect()->route('admin.registers.index');
    }


    /**
     * Display Register.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $register = Register::findOrFail($id);

        return view('admin.registers.show', compact('register'));
    }


    /**
     * Remove Register from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $register = Register::findOrFail($id);
        $register->delete();

        return redirect()->route('admin.registers.index');
    }

    /**
     * Delete all selected Register at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
      
        if ($request->input('ids')) {
            $entries = Register::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Register from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
      
        $register = Register::onlyTrashed()->findOrFail($id);
        $register->restore();

        return redirect()->route('admin.registers.index');
    }

    /**
     * Permanently delete Register from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
  
        $register = Register::onlyTrashed()->findOrFail($id);
        $register->forceDelete();

        return redirect()->route('admin.registers.index');
    }
}
