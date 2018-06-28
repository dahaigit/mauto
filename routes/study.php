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
























