<?php

namespace App\Http\Controllers\Admin;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of News.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      

        
        if (request()->ajax()) {
            $query = News::query();
            $query->with("tags");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
       
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'news.id',
                'news.title',
                'news.writer',
                'news.tags_id',
                'news.descriptive',
                'news.small_descriptive',
                'news.date_news',
                'news.show',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'news_';
                $routeKey = 'admin.news';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('writer', function ($row) {
                return $row->writer ? $row->writer : '';
            });
            $table->editColumn('tags.title', function ($row) {
                return $row->tags ? $row->tags->title : '';
            });
            $table->editColumn('descriptive', function ($row) {
                return $row->descriptive ? $row->descriptive : '';
            });
            $table->editColumn('small_descriptive', function ($row) {
                return $row->small_descriptive ? $row->small_descriptive : '';
            });
            $table->editColumn('date_news', function ($row) {
                return $row->date_news ? $row->date_news : '';
            });
            $table->editColumn('show', function ($row) {
                return \Form::checkbox("show", 1, $row->show == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','show']);

            return $table->make(true);
        }

        return view('admin.news.index');
    }

    /**
     * Show the form for creating new News.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $tags = \App\Tag::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.news.create', compact('tags'));
    }

    /**
     * Store a newly created News in storage.
     *
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
      
        $news = News::create($request->all());



        return redirect()->route('admin.news.index');
    }


    /**
     * Show the form for editing News.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        
        $tags = \App\Tag::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $news = News::findOrFail($id);

        return view('admin.news.edit', compact('news', 'tags'));
    }

    /**
     * Update News in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, $id)
    {
        $news = News::findOrFail($id);
        $news->update($request->all());



        return redirect()->route('admin.news.index');
    }


    /**
     * Display News.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $news = News::findOrFail($id);

        return view('admin.news.show', compact('news'));
    }


    /**
     * Remove News from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index');
    }

    /**
     * Delete all selected News at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        
        if ($request->input('ids')) {
            $entries = News::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore News from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
      
        $news = News::onlyTrashed()->findOrFail($id);
        $news->restore();

        return redirect()->route('admin.news.index');
    }

    /**
     * Permanently delete News from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
      
        $news = News::onlyTrashed()->findOrFail($id);
        $news->forceDelete();

        return redirect()->route('admin.news.index');
    }
}
