<?php

namespace App\Http\Middleware;

use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoardAuthCheck
{
    use BoardConfig;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $access): Response
    {
        $baseLevel = 0;
        if(auth()->check()) {
            $baseLevel = auth()->user()->group_level;
        }

        $tableId = $request->segment(2);
        $board = $this->getBoard($tableId);

        if ($access === 'status') {
            if ($board->status === 0) {
                if(!auth()->check() || auth()->user()->group_level < 11) {
                    abort(404);
                }
            }
        } else if ($access === 'write') {
            if (!auth()->user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }

            if($baseLevel < $board->write_level) {
                return response()->view('errors.access-denied', [
                    'type' => 'warning',
                    'next' => 'redirect',
                    'link' => route('write.list', ['tableId' => $tableId]),
                    'message' => '접근 권한이 없습니다.',
                ]);
            }
        } else if ($access === 'read') {
            $writeId = $request->segment(4);
            $write = BoardWrite::where('id', $writeId)->where('is_delete', 0)->first();
            if (is_null($write) && auth()->user()->group_level < 11) {
                return response()->view('errors.access-denied', [
                    'type' => 'warning',
                    'next' => 'redirect',
                    'link' => route('write.list', ['tableId' => $tableId]),
                    'message' => '존재하지 않는 글입니다.',
                ]);
            }
        } else if ($access === 'update') {
            if (!auth()->user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }

            $writeId = $request->segment(4);
            $write = BoardWrite::where('id', $writeId)->first();

            if (!session()->has(session()->getId() . 'write-' . $tableId . '-' . $writeId)) {
                if (is_null($write->user_id)) {
                    return redirect()->route('write.password.check', ['tableId' => $tableId, 'writeId' => $writeId, 'access' => 'update']);
                }else{
                    if (auth()->user()->group_level >= 11){
                        return $next($request);
                    }elseif (auth()->guest() || $write->user_id !== auth()->user()->id) {
                        abort(403);
                    }
                }
            }
        }

        return $next($request);
    }
}
