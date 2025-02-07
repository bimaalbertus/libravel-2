<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return view('pages.account.settings', ['sessions' => []]);
        }

        $sessions = DB::table('sessions')
            ->where('user_id', Auth::id())
            ->orderBy('last_activity', 'desc')
            ->get();

        $agent = new Agent();

        $sessions = collect($sessions)->map(function ($session) use ($agent, $request) {
            $agent->setUserAgent($session->user_agent);

            return (object) [
                'agent' => [
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                    'device' => $this->getDeviceType($agent),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === $request->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });

        return view('pages.account.settings', [
            'sessions' => $sessions
        ]);
    }

    private function getDeviceType(Agent $agent)
    {
        if ($agent->isPhone()) {
            if ($agent->is('iPhone')) {
                return 'iphone';
            }
            return 'mobile';
        }
        if ($agent->isTablet()) {
            if ($agent->is('iPad')) {
                return 'ipad';
            }
            return 'tablet';
        }
        return 'desktop';
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => __('auth.password')]);
        }

        DB::table('sessions')->where('user_id', $user->id)
            ->where('id', '!=', $request->session()->getId())
            ->delete();

        return back()->with('success', __('profile.browser_sessions_logout_success_notification'));
    }
}
