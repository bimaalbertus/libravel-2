<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Masmerise\Toaster\Toaster;

class BrowserSessions extends Component
{
    public $showDeleteModal = false;
    public $password = '';
    protected $rules = [
        'password' => 'required|string|min:8'
    ];

    public function render()
    {
        return view('livewire.browser-sessions', [
            'sessions' => $this->getSessions(),
        ]);
    }

    public function getSessions()
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::table('sessions')
                ->where('user_id', Auth::user()->id)
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            $agent = new Agent();
            $agent->setUserAgent($session->user_agent);

            return (object) [
                'id' => $session->id,
                'agent' => [
                    'device' => $this->getDeviceType($agent),
                    'platform' => $agent->platform(),
                    'browser' => $agent->browser(),
                ],
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    protected function getDeviceType($agent)
    {
        if ($agent->isTablet()) {
            return $agent->is('iPad') ? 'ipad' : 'tablet';
        }

        if ($agent->isMobile()) {
            return $agent->is('iPhone') ? 'iphone' : 'mobile';
        }

        return 'desktop';
    }

    public function logoutOtherBrowserSessions()
    {
        $this->validate();

        if (!Hash::check($this->password, Auth::user()->password)) {
            Toaster::error(__('auth.password'));
            return;
        }

        if (config('session.driver') === 'database') {
            DB::table('sessions')
                ->where('user_id', Auth::user()->id)
                ->where('id', '!=', session()->getId())
                ->delete();
        }

        $this->showDeleteModal = false;
        $this->password = '';
        $this->emit('sessionsUpdated');

        Toaster::success(__('profile.browser_sessions_logout_success_notification'));
    }
}
