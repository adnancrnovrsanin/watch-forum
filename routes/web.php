<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', fn () => to_route('topics.index'));

Route::resource('topics', TopicController::class)
    ->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);

Route::post('topics/{topic}/follow', [TopicController::class, 'follow'])->name('topics.follow');
Route::delete('topics/{topic}/unfollow', [TopicController::class, 'unfollow'])->name('topics.unfollow');

Route::get('conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');

Route::post('topic/{topic}/conversations', [ConversationController::class, 'store'])->name('topic.conversations.store');

Route::get('user/topics', [UserController::class, 'myTopics'])->name('user.topics');
Route::get('user/conversations', [UserController::class, 'myConversations'])->name('user.conversations');

Route::resource('conversations', ConversationController::class)
    ->only(['edit', 'update', 'destroy']);

Route::resource('conversation.comments', CommentController::class)
    ->only(['store']);

Route::resource('comment.replies', ReplyController::class)
    ->only(['store', 'edit', 'update']);

Route::post('comments/{comment}/vote', [CommentController::class, 'vote'])->name('comments.vote');

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login_form'])->name('auth.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register_form'])->name('auth.create');
    Route::post('register', [AuthController::class, 'register']);
    Route::delete('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('login', fn () => to_route('auth.login'))->name('login');
Route::get('register', fn () => to_route('auth.create'))->name('register');

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('admin/approve', [AdminController::class, 'approve'])->name('admin.approve');
Route::post('admin/reject', [AdminController::class, 'reject'])->name('admin.reject');
Route::get('admin/topic-requests', [AdminController::class, 'topicRequests'])->name('admin.topic-requests');
Route::post('admin/approve-topic', [AdminController::class, 'approveTopic'])->name('admin.approve-topic');
Route::post('admin/reject-topic', [AdminController::class, 'rejectTopic'])->name('admin.reject-topic');
