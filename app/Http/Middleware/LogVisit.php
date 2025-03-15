<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Jenssegers\Agent\Agent;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent();

        if (!$agent->isRobot()) {
            $visitorId = $request->cookie('visitor_id');

            if (!$visitorId) {
                $visitorId = Uuid::uuid4()->toString();
                Cookie::queue('visitor_id', $visitorId, 60 * 24 * 30);
            }

            $lastVisit = Session::get('last_visit_' . $visitorId);
            $now = Carbon::now();
            $visitInterval = config('visitor.visit_interval', 5);

            if (!$lastVisit || $now->diffInMinutes($lastVisit) > $visitInterval) {
                Visitor::updateOrCreate(
                    [
                        'visitor_id' => $visitorId,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                    ],
                    [
                        'visited_at' => $now,
                        'url' => $request->fullUrl(),
                    ]
                );
                Session::put('last_visit_' . $visitorId, $now);
            }
        }

        return $next($request);
    }
}
