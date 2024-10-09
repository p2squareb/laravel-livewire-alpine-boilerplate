<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $table_id 테이블 아이디
 * @property string $table_name 테이블 이름
 * @property int $status 테이블 사용 여부
 * @property int $use_category 카테고리 사용 여부
 * @property string|null $category_list 카테고리 항목 (ex:k-pop,pop,hiphop)
 * @property int|null $write_level 글쓰기 등급
 * @property int $use_comment 댓글 사용 여부
 * @property int $use_rate 추천 사용 여부
 * @property int $use_report 신고 사용 여부
 * @property string|null $skin 스킨
 * @property int|null $article_count 게시글 수
 * @property int|null $comment_count 댓글 수
 * @method static Builder|Board newModelQuery()
 * @method static Builder|Board newQuery()
 * @method static Builder|Board query()
 * @method static Builder|Board whereArticleCount($value)
 * @method static Builder|Board whereCategoryList($value)
 * @method static Builder|Board whereCommentCount($value)
 * @method static Builder|Board whereCreatedAt($value)
 * @method static Builder|Board whereId($value)
 * @method static Builder|Board whereSkin($value)
 * @method static Builder|Board whereStatus($value)
 * @method static Builder|Board whereTableId($value)
 * @method static Builder|Board whereTableName($value)
 * @method static Builder|Board whereUpdatedAt($value)
 * @method static Builder|Board whereUseCategory($value)
 * @method static Builder|Board whereUseComment($value)
 * @method static Builder|Board whereUseRate($value)
 * @method static Builder|Board whereUseReport($value)
 * @method static Builder|Board whereWriteLevel($value)
 * @mixin Eloquent
 */
	class Board extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $board_id boards.id
 * @property string $table_id boards.table_id
 * @property int $write_id writes.id
 * @property int|null $parent_id parent comments.id
 * @property int|null $depth depth
 * @property int $rate_up 추천 수
 * @property int $rate_down 비추천 수
 * @property int|null $user_id users.id
 * @property string|null $writer 작성자
 * @property string $comment 댓글 내용
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제 시간
 * @property int $is_reported 신고 여부
 * @property string $ip 작성자 아이피
 * @property-read Board $board
 * @property-read User|null $user
 * @property-read BoardWrite|null $write
 * @method static Builder|BoardComment newModelQuery()
 * @method static Builder|BoardComment newQuery()
 * @method static Builder|BoardComment query()
 * @method static Builder|BoardComment whereBoardId($value)
 * @method static Builder|BoardComment whereComment($value)
 * @method static Builder|BoardComment whereCreatedAt($value)
 * @method static Builder|BoardComment whereDeletedAt($value)
 * @method static Builder|BoardComment whereDepth($value)
 * @method static Builder|BoardComment whereId($value)
 * @method static Builder|BoardComment whereIp($value)
 * @method static Builder|BoardComment whereIsDelete($value)
 * @method static Builder|BoardComment whereIsReported($value)
 * @method static Builder|BoardComment whereParentId($value)
 * @method static Builder|BoardComment whereRateDown($value)
 * @method static Builder|BoardComment whereRateUp($value)
 * @method static Builder|BoardComment whereTableId($value)
 * @method static Builder|BoardComment whereUpdatedAt($value)
 * @method static Builder|BoardComment whereUserId($value)
 * @method static Builder|BoardComment whereWriteId($value)
 * @method static Builder|BoardComment whereWriter($value)
 * @mixin Eloquent
 */
	class BoardComment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $board_id boards.id
 * @property string $table_id board.table_id
 * @property int|null $write_id writes.id
 * @property int|null $comment_id comments.id
 * @property int|null $user_id users.id
 * @property string $rate 추천 여부
 * @property int|null $target_user_id users.id
 * @property-read Board $board
 * @property-read User|null $user
 * @method static Builder|BoardRate newModelQuery()
 * @method static Builder|BoardRate newQuery()
 * @method static Builder|BoardRate query()
 * @method static Builder|BoardRate whereBoardId($value)
 * @method static Builder|BoardRate whereCommentId($value)
 * @method static Builder|BoardRate whereCreatedAt($value)
 * @method static Builder|BoardRate whereId($value)
 * @method static Builder|BoardRate whereRate($value)
 * @method static Builder|BoardRate whereTableId($value)
 * @method static Builder|BoardRate whereTargetUserId($value)
 * @method static Builder|BoardRate whereUpdatedAt($value)
 * @method static Builder|BoardRate whereUserId($value)
 * @method static Builder|BoardRate whereWriteId($value)
 * @mixin Eloquent
 */
	class BoardRate extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $board_id boards.id
 * @property string $table_id board.table_id
 * @property int|null $write_id writes.id
 * @property int|null $comment_id comments.id
 * @property int|null $user_id users.id
 * @property string|null $field 신고 항목
 * @property int|null $target_user_id users.id
 * @property-read Board $board
 * @property-read BoardComment|null $comment
 * @property-read User|null $user
 * @property-read BoardWrite|null $write
 * @method static Builder|BoardReport newModelQuery()
 * @method static Builder|BoardReport newQuery()
 * @method static Builder|BoardReport query()
 * @method static Builder|BoardReport whereBoardId($value)
 * @method static Builder|BoardReport whereCommentId($value)
 * @method static Builder|BoardReport whereCreatedAt($value)
 * @method static Builder|BoardReport whereField($value)
 * @method static Builder|BoardReport whereId($value)
 * @method static Builder|BoardReport whereTableId($value)
 * @method static Builder|BoardReport whereTargetUserId($value)
 * @method static Builder|BoardReport whereUpdatedAt($value)
 * @method static Builder|BoardReport whereUserId($value)
 * @method static Builder|BoardReport whereWriteId($value)
 * @mixin Eloquent
 */
	class BoardReport extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $board_id tbl.boards.id
 * @property string $table_id 테이블 아이디
 * @property string|null $categories 카테고리
 * @property int $is_notice 공지글 여부
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제일시
 * @property int $is_reported 신고 여부
 * @property string $subject 제목
 * @property string $content 내용
 * @property int $hit 조회수
 * @property int $rate_up 추천 수
 * @property int $rate_down 비추천 수
 * @property int $comment_count 댓글 수
 * @property int|null $user_id 작성자 회원 인덱스
 * @property string|null $password 비밀번호
 * @property string|null $writer 작성자
 * @property int $has_image 본문에 이미지 포함 여부
 * @property int $has_video 본문에 영상 포함 여부
 * @property string $ip 작성자 아이피
 * @property string|null $list_file 목록 첨부파일
 * @property-read Board $board
 * @property-read User|null $user
 * @method static Builder|BoardWrite newModelQuery()
 * @method static Builder|BoardWrite newQuery()
 * @method static Builder|BoardWrite query()
 * @method static Builder|BoardWrite whereBoardId($value)
 * @method static Builder|BoardWrite whereCategories($value)
 * @method static Builder|BoardWrite whereCommentCount($value)
 * @method static Builder|BoardWrite whereContent($value)
 * @method static Builder|BoardWrite whereCreatedAt($value)
 * @method static Builder|BoardWrite whereDeletedAt($value)
 * @method static Builder|BoardWrite whereHasImage($value)
 * @method static Builder|BoardWrite whereHasVideo($value)
 * @method static Builder|BoardWrite whereHit($value)
 * @method static Builder|BoardWrite whereId($value)
 * @method static Builder|BoardWrite whereIp($value)
 * @method static Builder|BoardWrite whereIsDelete($value)
 * @method static Builder|BoardWrite whereIsNotice($value)
 * @method static Builder|BoardWrite whereIsReported($value)
 * @method static Builder|BoardWrite whereListFile($value)
 * @method static Builder|BoardWrite wherePassword($value)
 * @method static Builder|BoardWrite whereRateDown($value)
 * @method static Builder|BoardWrite whereRateUp($value)
 * @method static Builder|BoardWrite whereSubject($value)
 * @method static Builder|BoardWrite whereTableId($value)
 * @method static Builder|BoardWrite whereUpdatedAt($value)
 * @method static Builder|BoardWrite whereUserId($value)
 * @method static Builder|BoardWrite whereWriter($value)
 * @mixin Eloquent
 */
	class BoardWrite extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $table_name 테이블 명
 * @property int $target_id 테이블 ID
 * @property string $file_full_name 파일명
 * @property float $file_size 파일 크기
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제 시간
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFileFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $categories 카테고리
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제일시
 * @property string $subject 제목
 * @property string $content 내용
 * @property int|null $user_id 작성자 회원 인덱스
 * @property string $writer 작성자
 * @property User|null $answer 답변
 * @property int|null $answer_user_id 답변자 회원 인덱스
 * @property string|null $answer_writer 답변자
 * @property string|null $answered_at 답변일시
 * @property int $status 답변상태 0:미답변, 1:답변완료
 * @property string $ip 작성자 아이피
 * @property-read User|null $user
 * @method static Builder|Inquiry newModelQuery()
 * @method static Builder|Inquiry newQuery()
 * @method static Builder|Inquiry query()
 * @method static Builder|Inquiry whereAnswer($value)
 * @method static Builder|Inquiry whereAnswerUserId($value)
 * @method static Builder|Inquiry whereAnswerWriter($value)
 * @method static Builder|Inquiry whereAnsweredAt($value)
 * @method static Builder|Inquiry whereCategories($value)
 * @method static Builder|Inquiry whereContent($value)
 * @method static Builder|Inquiry whereCreatedAt($value)
 * @method static Builder|Inquiry whereDeletedAt($value)
 * @method static Builder|Inquiry whereId($value)
 * @method static Builder|Inquiry whereIp($value)
 * @method static Builder|Inquiry whereIsDelete($value)
 * @method static Builder|Inquiry whereStatus($value)
 * @method static Builder|Inquiry whereSubject($value)
 * @method static Builder|Inquiry whereUpdatedAt($value)
 * @method static Builder|Inquiry whereUserId($value)
 * @method static Builder|Inquiry whereWriter($value)
 * @mixin Eloquent
 */
	class Inquiry extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $category 카테고리
 * @method static Builder|InquiryCategory newModelQuery()
 * @method static Builder|InquiryCategory newQuery()
 * @method static Builder|InquiryCategory query()
 * @method static Builder|InquiryCategory whereCategory($value)
 * @method static Builder|InquiryCategory whereCreatedAt($value)
 * @method static Builder|InquiryCategory whereId($value)
 * @method static Builder|InquiryCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class InquiryCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $social_type
 * @property string $login_at
 * @method static Builder|LoginRecord newModelQuery()
 * @method static Builder|LoginRecord newQuery()
 * @method static Builder|LoginRecord query()
 * @method static Builder|LoginRecord whereCreatedAt($value)
 * @method static Builder|LoginRecord whereId($value)
 * @method static Builder|LoginRecord whereIpAddress($value)
 * @method static Builder|LoginRecord whereLoginAt($value)
 * @method static Builder|LoginRecord whereSocialType($value)
 * @method static Builder|LoginRecord whereUpdatedAt($value)
 * @method static Builder|LoginRecord whereUserAgent($value)
 * @method static Builder|LoginRecord whereUserId($value)
 * @mixin Eloquent
 */
	class LoginRecord extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string $type P:플러스, M:마이너스
 * @property string|null $category 지급/차감 명목
 * @property int $user_id users.id
 * @property string $reason 사유
 * @property int $amount 포인트
 * @property string $processed_by 처리자
 * @property-read \App\Models\User|null $group
 * @method static \Illuminate\Database\Eloquent\Builder|Point newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Point newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Point query()
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereProcessedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Point whereUserId($value)
 */
	class Point extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property string|null $register_ip 등록자 ip
 * @property string|null $register_id 등록자 아이디
 * @property string|null $title 설정 제목
 * @property string|null $content 설정 내용
 * @method static Builder|System newModelQuery()
 * @method static Builder|System newQuery()
 * @method static Builder|System query()
 * @method static Builder|System whereContent($value)
 * @method static Builder|System whereCreatedAt($value)
 * @method static Builder|System whereId($value)
 * @method static Builder|System whereRegisterId($value)
 * @method static Builder|System whereRegisterIp($value)
 * @method static Builder|System whereTitle($value)
 * @mixin Eloquent
 */
	class System extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $status 1:정상, 2:탈퇴, 3:정지, 4:휴면
 * @property string|null $name 이름
 * @property string $nickname 닉네임
 * @property string $email 이메일
 * @property Carbon|null $email_verified_at
 * @property mixed|null $password 비밀번호
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property int $group_level 그룹 레벨
 * @property string|null $cellphone 휴대폰 번호
 * @property int $point 포인트
 * @property string|null $zipcode 우편번호
 * @property string|null $addr1 주소
 * @property string|null $addr2 상세 주소
 * @property string|null $social_type SNS 로그인
 * @property string|null $last_login_at 최근 로그인 시간
 * @property string|null $login_ip 로그인 아이피
 * @property string|null $leaved_at 탈퇴 날짜
 * @property string $mailing_yn 메일 수신 여부
 * @property string $sms_yn SMS 수신 여부
 * @property string|null $profile_photo_path 프로필 이미지
 * @property-read Collection<int, BoardComment> $comments
 * @property-read int|null $comments_count
 * @property-read UserGroup|null $group
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read string $profile_photo_url
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddr1($value)
 * @method static Builder|User whereAddr2($value)
 * @method static Builder|User whereCellphone($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereGroupLevel($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastLoginAt($value)
 * @method static Builder|User whereLeaveCause($value)
 * @method static Builder|User whereLeavedAt($value)
 * @method static Builder|User whereLoginIp($value)
 * @method static Builder|User whereMailingYn($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNickname($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePoint($value)
 * @method static Builder|User whereProfilePhotoPath($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSmsYn($value)
 * @method static Builder|User whereSocialType($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereTwoFactorConfirmedAt($value)
 * @method static Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static Builder|User whereTwoFactorSecret($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereZipcode($value)
 * @mixin Eloquent
 * @property string|null $leave_cause 탈퇴 사유
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id users.id
 * @property int $gubun 1:휴면, 0:휴면 해제
 * @property-read User|null $user
 * @method static Builder|UserDormant newModelQuery()
 * @method static Builder|UserDormant newQuery()
 * @method static Builder|UserDormant query()
 * @method static Builder|UserDormant whereCreatedAt($value)
 * @method static Builder|UserDormant whereGubun($value)
 * @method static Builder|UserDormant whereId($value)
 * @method static Builder|UserDormant whereUpdatedAt($value)
 * @method static Builder|UserDormant whereUserId($value)
 * @mixin \Eloquent
 */
	class UserDormant extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $name 그룹명
 * @property int $level 그룹 레벨
 * @property string|null $comment 메모
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|UserGroup newModelQuery()
 * @method static Builder|UserGroup newQuery()
 * @method static Builder|UserGroup query()
 * @method static Builder|UserGroup whereComment($value)
 * @method static Builder|UserGroup whereCreatedAt($value)
 * @method static Builder|UserGroup whereId($value)
 * @method static Builder|UserGroup whereLevel($value)
 * @method static Builder|UserGroup whereName($value)
 * @method static Builder|UserGroup whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class UserGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id users.id
 * @property int $gubun 1:이용정지, 0:이용정지 해제
 * @property string $period_type 이용정지 기간
 * @property string $until_date 정지 기간 종료일
 * @property string|null $cause 사유
 * @property int $processed_by_user_id 처리 관리자 users.id
 * @property string $processed_by_user_nickname 처리 관리자 users.nickname
 * @property-read User|null $user
 * @method static Builder|UserProhibit newModelQuery()
 * @method static Builder|UserProhibit newQuery()
 * @method static Builder|UserProhibit query()
 * @method static Builder|UserProhibit whereCause($value)
 * @method static Builder|UserProhibit whereCreatedAt($value)
 * @method static Builder|UserProhibit whereGubun($value)
 * @method static Builder|UserProhibit whereId($value)
 * @method static Builder|UserProhibit wherePeriodType($value)
 * @method static Builder|UserProhibit whereProcessedByUserId($value)
 * @method static Builder|UserProhibit whereProcessedByUserNickname($value)
 * @method static Builder|UserProhibit whereUntilDate($value)
 * @method static Builder|UserProhibit whereUpdatedAt($value)
 * @method static Builder|UserProhibit whereUserId($value)
 * @mixin Eloquent
 */
	class UserProhibit extends \Eloquent {}
}

