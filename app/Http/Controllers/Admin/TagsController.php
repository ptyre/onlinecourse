<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagsRequest;
use App\Http\Requests\Admin\UpdateTagsRequest;
use Yajra\DataTables\DataTables;

class TagsController extends Controller
{
    /**
     * Display a listing of Tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      


        
        if (request()->ajax()) {
            $query = Tag::query();
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('tag_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'tags.id',
                'tags.title',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'tag_';
                $routeKey = 'admin.tags';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.tags.index');
    }

    /**
     * Show the form for creating new Tag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        return view('admin.tags.create');
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param  \App\Http\Requests\StoreTagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagsRequest $request)
    {
      
        $tag = Tag::create($request->all());

        foreach ($request->input('news', []) as $data) {
            $tag->news()->create($data);
        }


        return redirect()->route('admin.tags.index');
    }


    /**
     * Show the form for editing Tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $tag = Tag::findOrFail($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update Tag in storage.
     *
     * @param  \App\Http\Requests\UpdateTagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagsRequest $request, $id)
    {
       
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        $news           = $tag->news;
        $currentNewsData = [];
        foreach ($request->input('news', []) as $index => $data) {
            if (is_integer($index)) {
                $tag->news()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentNewsData[$id] = $data;
            }
        }
        foreach ($news as $item) {
            if (isset($currentNewsData[$item->id])) {
                $item->update($currentNewsData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.tags.index');
    }


    /**
     * Display Tag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $news = \App\News::where('tags_id', $id)->get();

        $tag = Tag::findOrFail($id);

        return view('admin.tags.show', compact('tag', 'news'));
    }


    /**
     * Remove Tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('admin.tags.index');
    }

    /**
     * Delete all selected Tag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
     
        if ($request->input('ids')) {
            $entries = Tag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
    
        $tag = Tag::onlyTrashed()->findOrFail($id);
        $tag->restore();

        return redirect()->route('admin.tags.index');
    }

    /**
     * Permanently delete Tag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
     
        $tag = Tag::onlyTrashed()->findOrFail($id);
        $tag->forceDelete();

        return redirect()->route('admin.tags.index');
    }
}
