<main>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">회원</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">구분</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">지급/차감</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">금액</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">지금/차감일</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">사유</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">주체</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">등록자</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($points as $point)
                            <tr wire:key="{{$point->id}}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="flex items-center p-4 space-x-3 whitespace-nowrap">
                                    @if ($point->user->profile_photo_path)
                                        <img class="w-8 h-8 rounded-full" src="/storage/profiles/{{ $point->user->profile_photo_path }}" alt="{{ $point->user->nickname }}'s avatar">
                                    @else
                                        <svg class="w-8 h-8 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                        </svg>
                                    @endif
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $point->user->nickname }}</div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $point->user->email }}</div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($point->point_item === 'join')
                                        회원가입
                                    @elseif ($point->point_item === 'login')
                                        로그인
                                    @elseif ($point->point_item === 'write')
                                        게시글 작성
                                    @elseif ($point->point_item === 'write_comment')
                                        댓글 추가
                                    @elseif ($point->point_item === 'write_up')
                                        게시글 추천
                                    @elseif ($point->point_item === 'write_down')
                                        게시글 비추천
                                    @elseif ($point->point_item === 'comment')
                                        댓글 작성
                                    @elseif ($point->point_item === 'comment_up')
                                        댓글 추천
                                    @elseif ($point->point_item === 'comment_down')
                                        댓글 비추천
                                    @elseif ($point->point_item === 'admin')
                                        관리자 지금/차감
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($point->point_type === 'P')
                                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-200 dark:text-green-900">지급</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-200 dark:text-red-900">차감</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $point->amount }}pt</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($point->created_at, 3) }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $point->reason }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($point->to_user_id === $point->from_user_id)
                                        본인
                                    @else
                                        {{ $point->sender->nickname }}<br>{{ $point->sender->email }}
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $point->processed_by }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

