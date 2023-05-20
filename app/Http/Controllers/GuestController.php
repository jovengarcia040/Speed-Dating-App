<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Eloquent\Builder as QBuilder;
use Session;
// mdoels
use App\Models\Event;
use App\Models\Guest;
use App\Models\Couple;

class GuestController extends Controller
{
    //
    public function index ()
    {
        if(Session::get('guest')) {
            $event = Event::with(['guests' => function (QBuilder $query) {
                $query->where('gender', '!=', Session::get('guest')->gender);
            }])->where('date', date('Y-m-d'))->first();

            $couples = Couple::with(['male', 'female'])
                ->where('event_id', $event->id)
                ->where(strtolower(Session::get('guest')->gender) === 'male' ? 'male_gid' : 'female_gid', Session::get('guest')->id)
                ->where(strtolower(Session::get('guest')->gender) === 'male' ? 'male_invite' : 'female_invite', true)
                ->get();
            $guestsArr = Guest::where('event_id', $event->id)->where('gender', '!=', Session::get('guest')->gender)->where('id', '!=', Session::get('guest')->id)->get();
            $guests = $guestsArr;
            // if(count($couples)) {
            //     $guests = [];
            //     foreach($guestsArr as $guest) {
            //         foreach($couples as $couple) {
            //             if($guest->id !== $couple[strtolower(Session::get('guest')->gender) === 'male' ? 'female_gid' : 'male_gid']) {
            //                 array_push($guests, $guest);
            //             }
            //         }
            //     }
            // }
            return view('client.index')->with(['event' => $event, 'guests' => $guests, 'couples' => $couples]);
        } else {
            return view('client.login');
        }
    }

    public function getGuestEventData() {
        if(Session::get('guest')) {
            $event = Event::with(['guests' => function (QBuilder $query) {
                $query->where('gender', '!=', Session::get('guest')->gender);
            }])->where('date', date('Y-m-d'))->first();

            $couples = Couple::with(['male', 'female'])
                ->where('event_id', $event->id)
                ->where(strtolower(Session::get('guest')->gender) === 'male' ? 'male_gid' : 'female_gid', Session::get('guest')->id)
                ->where(strtolower(Session::get('guest')->gender) === 'male' ? 'male_invite' : 'female_invite', true)
                ->get();
            $guestsArr = Guest::where('event_id', $event->id)->where('gender', '!=', Session::get('guest')->gender)->where('id', '!=', Session::get('guest')->id)->get();
            $guests = $guestsArr;
            // if(count($couples)) {
            //     $guests = [];
            //     foreach($guestsArr as $guest) {
            //         foreach($couples as $couple) {
            //             if($guest->id !== $couple[strtolower(Session::get('guest')->gender) === 'male' ? 'female_gid' : 'male_gid']) {
            //                 array_push($guests, $guest);
            //             }
            //         }
            //     }
            // }

            $data['event'] = $event;
            $data['guests'] = $guests;
            $data['couples'] = $couples;
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'success'
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => '',
                'message' => 'Session was timeout.'
            ], 500);
        }
    }

    public function login (Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'phone' => ['required'],
        ]);

        $guest = Guest::whereHas('event', function(Builder $query) {
                $query->where('date', date('Y-m-d'));
            })
            ->where('email', $request->email)
            ->where('phone', $request->phone)
            ->first();
        if($guest) {
            Session::put('guest', $guest);
            return redirect('/client');
        }

        return back()->withErrors([
            'email' => 'The provided email do not match our records.',
            'phone' => 'The provided phone do not match our records.',
        ]);
    }

    public function logout ()
    {
        Session::flush();
        return redirect('/client');
    }

    public function invite (Request $request)
    {
        $request->validate([
            'guest_id' => ['required'],
            'event_id' => ['required'],
        ]);

        if(Session::get('guest')) {
            $ggd = strtolower(Session::get('guest')->gender);
            // 
            if($ggd === 'male') {
                $frdInvite = Couple::where('event_id', $request->event_id)->where('male_gid', Session::get('guest')->id)->where('female_gid', $request->guest_id)->first();
                if($frdInvite) {
                    $frdInvite->male_invite = true;
                    $frdInvite->is_matched = ($frdInvite->male_invite && $frdInvite->female_invite);
                    $frdInvite->save();
                } else {
                    Couple::create([
                        'event_id' => $request->event_id,
                        'male_gid' => Session::get('guest')->id,
                        'male_invite' => true,
                        'female_gid' => $request->guest_id
                    ]);
                }
            } else { // Female
                $frdInvite = Couple::where('event_id', $request->event_id)->where('female_gid', Session::get('guest')->id)->where('male_gid', $request->guest_id)->first();
                if($frdInvite) {
                    $frdInvite->female_invite = true;
                    $frdInvite->is_matched = ($frdInvite->male_invite && $frdInvite->female_invite);
                    $frdInvite->save();
                } else {
                    Couple::create([
                        'event_id' => $request->event_id,
                        'male_gid' => $request->guest_id,
                        'female_gid' => Session::get('guest')->id,
                        'female_invite' => true
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'success'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Session was timeout.'
        ], 200);
    }

    public function inviteDel ($id)
    {
        if(Session::get('guest')) {
            $couple = Couple::find($id);
            if($couple->is_matched) {
                $couple->is_matched = false;
                if(strtolower(Session::get('guest')->gender) === 'male') {
                    $couple->male_invite = false;
                } else {
                    $couple->female_invite = false;
                }
                $couple->save();
            } else {
                $couple->delete();
            }

            return response()->json([
                'success' => true,
                'message' => 'success'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Session was timeout.'
        ], 200);
    }
}
