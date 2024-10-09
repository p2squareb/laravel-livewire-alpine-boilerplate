<?php

use App\Livewire\Admin\Board\BoardCommentList;
use App\Livewire\Admin\Board\BoardCreate;
use App\Livewire\Admin\Board\BoardList;
use App\Livewire\Admin\Board\BoardReportList;
use App\Livewire\Admin\Board\BoardUpdate;
use App\Livewire\Admin\Board\BoardWriteList;
use App\Livewire\Admin\Inquiry\InquiryList;
use App\Livewire\Admin\Inquiry\InquiryRead;
use App\Livewire\Admin\Point\PointList;
use App\Livewire\Admin\Point\PointSet;
use App\Livewire\Admin\System\Basic;
use App\Livewire\Admin\System\External;
use App\Livewire\Admin\System\PolicyTerms;
use App\Livewire\Admin\User\UserDormantList;
use App\Livewire\Admin\User\UserGroupList;
use App\Livewire\Admin\User\UserList;
use App\Livewire\Admin\User\UserProhibitList;
use App\Livewire\Admin\User\UserRead;
use App\Livewire\Admin\User\UserWithdrawalList;
use App\Livewire\Board\WriteCreate;
use App\Livewire\Board\WriteDelete;
use App\Livewire\Board\WriteList;
use App\Livewire\Board\WritePassword;
use App\Livewire\Board\WriteRead;
use App\Livewire\Board\WriteUpdate;
use App\Livewire\File\FileControl;
use App\Livewire\Home\HomeIndex;
use App\Livewire\Home\SitePolicy;
use App\Livewire\Mypage\LoginRecordList;
use App\Livewire\Mypage\MyComment;
use App\Livewire\Mypage\MyInquiryCreate;
use App\Livewire\Mypage\MyInquiryList;
use App\Livewire\Mypage\MyInquiryRead;
use App\Livewire\Mypage\MyNotification;
use App\Livewire\Mypage\MyOverview;
use App\Livewire\Mypage\MyPoint;
use App\Livewire\Mypage\MyRate;
use App\Livewire\Mypage\MyReport;
use App\Livewire\Mypage\MyWrite;
use App\Livewire\Mypage\UserInfo;
use Illuminate\Support\Facades\Route;
use App\Actions\Fortify\SendPasswordResetLink;

Route::post('/forgot-password', [SendPasswordResetLink::class, 'send'])->name('password.email');

Route::group(['middleware' => ['web']], function() {
    Route::get('/', HomeIndex::class)->name('home');
    Route::get('/site-policy/{id}', SitePolicy::class)->name('site-policy');

    /** 메인 */

    /** 게시판 */
    Route::group(['prefix' => '/bbs/{tableId}', 'middleware' => 'board-auth-check:status'], function()
    {
        Route::get('/password/{writeId}/{access}', WritePassword::class)->name('write.password.check');
        Route::get('/list', WriteList::class)->name('write.list');
        Route::get('/create', WriteCreate::class)->name('write.create')->middleware('board-auth-check:write');
        Route::get('/read/{writeId}', WriteRead::class)->name('write.read')->middleware('board-auth-check:read');
        Route::get('/update/{writeId}', WriteUpdate::class)->name('write.update')->middleware('board-auth-check:update');
        Route::get('/delete/{writeId}', WriteDelete::class)->name('write.delete');
    });

    /** 마이페이지 */
    Route::group(['prefix' => '/mypage', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified']], function()
    {
        Route::get('/overview', MyOverview::class)->name('mypage.overview');
        Route::get('/userinfo', UserInfo::class)->name('mypage.userinfo');
        Route::get('/login-record/list', LoginRecordList::class)->name('mypage.login-record.list');
        Route::get('/write/list', MyWrite::class)->name('mypage.write.list');
        Route::get('/comment/list', MyComment::class)->name('mypage.comment.list');
        Route::get('/rate/list', MyRate::class)->name('mypage.rate.list');
        Route::get('/report/list', MyReport::class)->name('mypage.report.list');
        Route::get('/point/list', MyPoint::class)->name('mypage.point.list');
        Route::get('/notification/list', MyNotification::class)->name('mypage.notification.list');
        Route::get('/inquiry/list', MyInquiryList::class)->name('mypage.inquiry.list');
        Route::get('/inquiry/create', MyInquiryCreate::class)->name('mypage.inquiry.create');
        Route::get('/inquiry/read/{inquiryId}', MyInquiryRead::class)->name('mypage.inquiry.read');
    });

    /** 파일 */
    Route::group(['prefix' => '/file'], function()
    {
        Route::any('/upload/ckeditor', [FileControl::class, 'uploadCkEditor'])->name('file.upload.ckeditor');
        Route::delete('/delete/ckeditor', [FileControl::class, 'deleteCkEditor'])->name('file.delete.ckeditor');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin']], function() {
    Route::get('/', Basic::class)->name('admin.index');
    Route::get('/dashboard', Basic::class)->name('admin.dashboard');

    /** 시스템 설정 */
    Route::get('/system/basic', Basic::class)->name('admin.system.basic');
    Route::get('/system/external', External::class)->name('admin.system.external');
    Route::get('/system/policy-terms', PolicyTerms::class)->name('admin.system.policy-terms');

    /** 회원 */
    Route::get('/user/list', UserList::class)->name('admin.user.list');
    Route::get('/user/read/{userId}', UserRead::class)->name('admin.user.read');
    Route::get('/user/group-list', UserGroupList::class)->name('admin.user.group-list');
    Route::get('/user/prohibit-list', UserProhibitList::class)->name('admin.user.prohibit-list');
    Route::get('/user/dormant-list', UserDormantList::class)->name('admin.user.dormant-list');
    Route::get('/user/withdrawal-list', UserWithdrawalList::class)->name('admin.user.withdrawal-list');

    /** 포인트 */
    Route::get('/point/set', PointSet::class)->name('admin.point.set');
    Route::get('/point/list', PointList::class)->name('admin.point.list');

    /** 게시판 */
    Route::get('/board/list', BoardList::class)->name('admin.board.list');
    Route::get('/board/create', BoardCreate::class)->name('admin.board.create');
    Route::get('/board/update/{boardId}', BoardUpdate::class)->name('admin.board.update');
    Route::get('/board/write/list', BoardWriteList::class)->name('admin.board.write.list');
    Route::get('/board/comment/list', BoardCommentList::class)->name('admin.board.comment.list');
    Route::get('/board/report/list', BoardReportList::class)->name('admin.board.report.list');

    /** 1:1문의 */
    Route::get('/inquiry/list', InquiryList::class)->name('admin.inquiry.list');
    Route::get('/inquiry/read/{inquiryId}', InquiryRead::class)->name('admin.inquiry.read');
});
