<?php

namespace App\Http\Controllers\Admin;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLessonsRequest;
use App\Http\Requests\Admin\UpdateLessonsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

class LessonsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (! Gate::allows('lesson_access')) {
            return abort(401);
        }

        $lessons = new Lesson();
        if ($request->input('id')){
            $lessons = $lessons->where('id' , $request->input('id'));
        }
        
        if (request()->ajax()) {
            $query = $lessons->query();
            $query->with("course");
            $template = 'actionsTemplate';
            if(request('show_deleted') == 1) {
                
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
                $query->onlyTrashed();
                $template = 'restoreTemplate';
            }
            $query->select([
                'lessons.id',
                'lessons.course_id',
                'lessons.title',
                'lessons.slug',
                'lessons.lesson_image',
                'lessons.short_text',
                'lessons.long_text',
                'lessons.position',
                'lessons.free_lesson',
                'lessons.published',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'lesson_';
                $routeKey = 'admin.lessons';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('course.title', function ($row) {
                return $row->course ? $row->course->title : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('lesson_image', function ($row) {
                if($row->lesson_image) { return '<a href="'. asset(env('UPLOAD_PATH').'/' . $row->lesson_image) .'" target="_blank"><img src="'. asset(env('UPLOAD_PATH').'/thumb/' . $row->lesson_image) .'"/>'; };
            });
            $table->editColumn('short_text', function ($row) {
                return $row->short_text ? $row->short_text : '';
            });
            $table->editColumn('long_text', function ($row) {
                return $row->long_text ? $row->long_text : '';
            });
            $table->editColumn('donwloaded_files', function ($row) {
                $build  = '';
                foreach ($row->getMedia('donwloaded_files') as $media) {
                    $build .= '<p class="form-group"><a href="' . $media->getUrl() . '" target="_blank">' . $media->name . '</a></p>';
                }
                
                return $build;
            });
            $table->editColumn('free_lesson', function ($row) {
                return \Form::checkbox("free_lesson", 1, $row->free_lesson == 1, ["disabled"]);
            });
            $table->editColumn('published', function ($row) {
                return \Form::checkbox("published", 1, $row->published == 1, ["disabled"]);
            });

            $table->rawColumns(['actions','massDelete','lesson_image','donwloaded_files','free_lesson','published']);

            return $table->make(true);
        }

        return view('admin.lessons.index' , ['id' => $request->id]);
    }

    /**
     * Show the form for creating new Lesson.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('lesson_create')) {
            return abort(401);
        }
        
        $courses = \App\Course::ofTeacher()->get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.lessons.create', compact('courses'));
    }

    /**
     * Store a newly created Lesson in storage.
     *
     * @param  \App\Http\Requests\StoreLessonsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonsRequest $request)
    {
        if (! Gate::allows('lesson_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $lesson = Lesson::create($request->all()
         + ['position' => Lesson::where('id', $request->id)->max('position') + 1]);


        foreach ($request->input('donwloaded_files_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $lesson->id;
            $file->save();
        }


        return redirect()->route('admin.lessons.index');
    }


    /**
     * Show the form for editing Lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('lesson_edit')) {
            return abort(401);
        }
        
        $courses = \App\Course::ofTeacher()->get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $lesson = Lesson::findOrFail($id);

        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    /**
     * Update Lesson in storage.
     *
     * @param  \App\Http\Requests\UpdateLessonsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonsRequest $request, $id)
    {
        if (! Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());


        $media = [];
        foreach ($request->input('donwloaded_files_id', []) as $index => $id) {
            $model          = config('medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $lesson->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $lesson->updateMedia($media, 'donwloaded_files');


        return redirect()->route('admin.lessons.index' , ['id' => $request->id]);
    }


    /**
     * Display Lesson.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('lesson_view')) {
            return abort(401);
        }
        
        $courses = \App\Course::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$tests = \App\Test::where('lesson_id', $id)->get();

        $lesson = Lesson::findOrFail($id);

        return view('admin.lessons.show', compact('lesson', 'tests'));
    }


    /**
     * Remove Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::findOrFail($id);
        $lesson->deletePreservingMedia();

        return redirect()->route('admin.lessons.index');
    }

    /**
     * Delete all selected Lesson at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Lesson::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->restore();

        return redirect()->route('admin.lessons.index');
    }

    /**
     * Permanently delete Lesson from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->forceDelete();

        return redirect()->route('admin.lessons.index');
    }
}
