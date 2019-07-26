<?php
Route::get('/admin', function () { return redirect('/admin/home'); });

// Authentication Routes...
Route::get('login', 'FrontEndIndexController@showLoginForm')->name('login');
Route::post('/', 'FrontEndIndexController@create')->name('register2');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Register Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('auth.register');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

//front end
Route::get('/', 'FrontEndIndexController@index')->name('front.home');
Route::get('/course', 'FrontCourseController@index')->name('front.course');
Route::get('/profile', 'FrontCourseController@profile')->name('front.profile');;
Route::get('/course/{slug}', 'FrontCoursePostController@index')->name('front.course.post');
Route::get('/lesson/{course_id}/{slug}', 'FrontLessonPostController@index')->name('front.lesson.post');
Route::post('/lesson/{slug}/test', 'FrontLessonPostController@test')->name('front.lesson.test');
Route::get('/contact', 'FrontContactController@index')->name('front.contact');
Route::get('/teacher', 'FrontTeacherController@index')->name('front.teacher');
Route::get('/news', 'FrontNewsController@index')->name('front.news');
Route::get('/news/post', 'FrontNewsPostController@index')->name('front.news.post');
Route::post('/course/payment', 'FrontCoursePostController@payment')->name('front.course.payment');



// admin panel

Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::resource('contact_companies', 'Admin\ContactCompaniesController');
    Route::post('contact_companies_mass_destroy', ['uses' => 'Admin\ContactCompaniesController@massDestroy', 'as' => 'contact_companies.mass_destroy']);
    Route::resource('contacts', 'Admin\ContactsController');
    Route::post('contacts_mass_destroy', ['uses' => 'Admin\ContactsController@massDestroy', 'as' => 'contacts.mass_destroy']);
    Route::resource('courses', 'Admin\CoursesController');
    Route::post('courses_mass_destroy', ['uses' => 'Admin\CoursesController@massDestroy', 'as' => 'courses.mass_destroy']);
    Route::post('courses_restore/{id}', ['uses' => 'Admin\CoursesController@restore', 'as' => 'courses.restore']);
    Route::delete('courses_perma_del/{id}', ['uses' => 'Admin\CoursesController@perma_del', 'as' => 'courses.perma_del']);
    Route::resource('lessons', 'Admin\LessonsController');
    Route::post('lessons_mass_destroy', ['uses' => 'Admin\LessonsController@massDestroy', 'as' => 'lessons.mass_destroy']);
    Route::post('lessons_restore/{id}', ['uses' => 'Admin\LessonsController@restore', 'as' => 'lessons.restore']);
    Route::delete('lessons_perma_del/{id}', ['uses' => 'Admin\LessonsController@perma_del', 'as' => 'lessons.perma_del']);
    Route::resource('questions', 'Admin\QuestionsController');
    Route::post('questions_mass_destroy', ['uses' => 'Admin\QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
    Route::post('questions_restore/{id}', ['uses' => 'Admin\QuestionsController@restore', 'as' => 'questions.restore']);
    Route::delete('questions_perma_del/{id}', ['uses' => 'Admin\QuestionsController@perma_del', 'as' => 'questions.perma_del']);
    Route::resource('question_options', 'Admin\QuestionOptionsController');
    Route::post('question_options_mass_destroy', ['uses' => 'Admin\QuestionOptionsController@massDestroy', 'as' => 'question_options.mass_destroy']);
    Route::post('question_options_restore/{id}', ['uses' => 'Admin\QuestionOptionsController@restore', 'as' => 'question_options.restore']);
    Route::delete('question_options_perma_del/{id}', ['uses' => 'Admin\QuestionOptionsController@perma_del', 'as' => 'question_options.perma_del']);
    Route::resource('tests', 'Admin\TestsController');
    Route::post('tests_mass_destroy', ['uses' => 'Admin\TestsController@massDestroy', 'as' => 'tests.mass_destroy']);
    Route::post('tests_restore/{id}', ['uses' => 'Admin\TestsController@restore', 'as' => 'tests.restore']);
    Route::delete('tests_perma_del/{id}', ['uses' => 'Admin\TestsController@perma_del', 'as' => 'tests.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');


    Route::resource('contacts', 'Admin\ContactsController');
    Route::post('contacts_mass_destroy', ['uses' => 'Admin\ContactsController@massDestroy', 'as' => 'contacts.mass_destroy']);
    Route::post('contacts_restore/{id}', ['uses' => 'Admin\ContactsController@restore', 'as' => 'contacts.restore']);
    Route::delete('contacts_perma_del/{id}', ['uses' => 'Admin\ContactsController@perma_del', 'as' => 'contacts.perma_del']);
    Route::resource('titles', 'Admin\TitlesController');
    Route::post('titles_mass_destroy', ['uses' => 'Admin\TitlesController@massDestroy', 'as' => 'titles.mass_destroy']);
    Route::post('titles_restore/{id}', ['uses' => 'Admin\TitlesController@restore', 'as' => 'titles.restore']);
    Route::delete('titles_perma_del/{id}', ['uses' => 'Admin\TitlesController@perma_del', 'as' => 'titles.perma_del']);

    Route::resource('commentstudents', 'Admin\CommentstudentsController');
    Route::post('commentstudents_mass_destroy', ['uses' => 'Admin\CommentstudentsController@massDestroy', 'as' => 'commentstudents.mass_destroy']);
    Route::post('commentstudents_restore/{id}', ['uses' => 'Admin\CommentstudentsController@restore', 'as' => 'commentstudents.restore']);
    Route::delete('commentstudents_perma_del/{id}', ['uses' => 'Admin\CommentstudentsController@perma_del', 'as' => 'commentstudents.perma_del']);
    Route::resource('news', 'Admin\NewsController');
    Route::post('news_mass_destroy', ['uses' => 'Admin\NewsController@massDestroy', 'as' => 'news.mass_destroy']);
    Route::post('news_restore/{id}', ['uses' => 'Admin\NewsController@restore', 'as' => 'news.restore']);
    Route::delete('news_perma_del/{id}', ['uses' => 'Admin\NewsController@perma_del', 'as' => 'news.perma_del']);
    Route::resource('tags', 'Admin\TagsController');
    Route::post('tags_mass_destroy', ['uses' => 'Admin\TagsController@massDestroy', 'as' => 'tags.mass_destroy']);
    Route::post('tags_restore/{id}', ['uses' => 'Admin\TagsController@restore', 'as' => 'tags.restore']);
    Route::delete('tags_perma_del/{id}', ['uses' => 'Admin\TagsController@perma_del', 'as' => 'tags.perma_del']);
    Route::resource('titlefooters', 'Admin\TitlefootersController');
    Route::post('titlefooters_mass_destroy', ['uses' => 'Admin\TitlefootersController@massDestroy', 'as' => 'titlefooters.mass_destroy']);
    Route::post('titlefooters_restore/{id}', ['uses' => 'Admin\TitlefootersController@restore', 'as' => 'titlefooters.restore']);
    Route::delete('titlefooters_perma_del/{id}', ['uses' => 'Admin\TitlefootersController@perma_del', 'as' => 'titlefooters.perma_del']);


    Route::resource('header_indices', 'Admin\HeaderIndicesController');
    Route::post('header_indices_mass_destroy', ['uses' => 'Admin\HeaderIndicesController@massDestroy', 'as' => 'header_indices.mass_destroy']);
    Route::post('header_indices_restore/{id}', ['uses' => 'Admin\HeaderIndicesController@restore', 'as' => 'header_indices.restore']);
    Route::delete('header_indices_perma_del/{id}', ['uses' => 'Admin\HeaderIndicesController@perma_del', 'as' => 'header_indices.perma_del']);
    Route::resource('services', 'Admin\ServicesController');
    Route::post('services_mass_destroy', ['uses' => 'Admin\ServicesController@massDestroy', 'as' => 'services.mass_destroy']);
    Route::post('services_restore/{id}', ['uses' => 'Admin\ServicesController@restore', 'as' => 'services.restore']);
    Route::delete('services_perma_del/{id}', ['uses' => 'Admin\ServicesController@perma_del', 'as' => 'services.perma_del']);
    Route::resource('registers', 'Admin\RegistersController');
    Route::post('registers_mass_destroy', ['uses' => 'Admin\RegistersController@massDestroy', 'as' => 'registers.mass_destroy']);
    Route::post('registers_restore/{id}', ['uses' => 'Admin\RegistersController@restore', 'as' => 'registers.restore']);
    Route::delete('registers_perma_del/{id}', ['uses' => 'Admin\RegistersController@perma_del', 'as' => 'registers.perma_del']);
    Route::resource('qoutes', 'Admin\QoutesController');
    Route::post('qoutes_mass_destroy', ['uses' => 'Admin\QoutesController@massDestroy', 'as' => 'qoutes.mass_destroy']);
    Route::post('qoutes_restore/{id}', ['uses' => 'Admin\QoutesController@restore', 'as' => 'qoutes.restore']);
    Route::delete('qoutes_perma_del/{id}', ['uses' => 'Admin\QoutesController@perma_del', 'as' => 'qoutes.perma_del']);



 
});
