<?php

/**
 * 学习路由
 */

// 队列分发-发送邮件
Route::get('queue/email', 'QueueController@sendEmail');

// 事件分发-发送邮件
Route::get('event/email', 'EventController@index');

// 集合函数
Route::get('collection/index', 'CollectionController@index');

// github webHook 自动发布代码
Route::post('github/release', 'GithubController@release');

// 队列
Route::get('queues/index', 'QueueController@index');

Route::get('queues/projects/{project}', function(\App\Models\Project $project){

    return view('project.show', compact('project'));
});

Route::get('queues/projects/{project}/tasks', function(\App\Models\Project $project){
    $tasks = $project->tasks->pluck('body');
    return $tasks;
});

Route::post('queues/projects/{project}/tasks', function(\App\Models\Project $project){
    $task = $project->tasks()->forceCreate([
            'body' => request('body'),
            'project_id' => $project->id,
        ]);
    broadcast(new \App\Events\TaskEvent($task))->toOthers();
});


// vue-resource测试接口
Route::resource('tasks', 'TaskController');

// 分片上传文件
Route::post('sliceUpload', 'FileController@sliceUpload');
Route::post('queueUpload', 'FileController@queueUpload');
























