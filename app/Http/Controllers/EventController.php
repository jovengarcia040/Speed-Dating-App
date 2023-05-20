<?php

namespace App\Http\Controllers;

use App\Mail\MatchingMsg;
// mdoels
use App\Models\Couple;
use App\Models\Event;
use App\Models\Guest;
// Mail
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index')->with('events', $events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'date' => ['required'],
            'guest_list' => ['required'],
        ]);

        $guest_list = $request->guest_list;
        
        if(count(Event::where('date', $request->date)->get())){
            return response()->json([
                'success'=>false,
                'message'=>'Event was already created on same Date'
            ],202);
        } else {
            $event = Event::create([
                'name' => $request->name,
                'date' => $request->date,
            ]);
            foreach ($guest_list as $guest) {
                Guest::create([
                    'event_id' => $event->id,
                    'first_name' => $guest['first_name'],
                    'last_name' => $guest['last_name'],
                    'gender' => $guest['gender'],
                    'email' => $guest['email'],
                    'phone' => $guest['phone'],
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Event was created successfully!',
            ], 201);
            
        }
        
    }

    public function show($id)
    {
        $event = Event::with('guests')->find($id);
        $couples = Couple::with(['male', 'female'])->where('event_id', $id)->where('is_matched', true)->get();
        // var_dump($couples);die();
        return view('admin.event.detail')->with(['event' => $event, 'couples' => $couples]);
    }

    public function deleteAll($id)
    {
        $couples = Couple::where('event_id', $id)->get();
        foreach ($couples as $couple) {
            Couple::find($couple->id)->delete();
        }

        $guests = Guest::where('event_id', $id)->get();
        foreach ($guests as $guest) {
            Guest::find($guest->id)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'success',
        ], 201);
    }

    public function getGuestInfo($event_id, $guest_id)
    {
        $guest = Guest::find($guest_id);

        return response()->json([
            'success' => true,
            'data' => $guest,
            'message' => 'success',
        ], 201);
    }

    public function storeGuest(Request $request, $event_id)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
        ]);

        $event = Event::find($event_id);

        if ($event) {
            $guest = Guest::create([
                'event_id' => $event_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return response()->json([
                'success' => true,
                'data' => $guest,
                'message' => 'success',
            ], 201);
        }

        return response()->json([
            'success' => false,
            'data' => $event,
            'message' => 'failed',
        ], 500);
    }

    public function updateGuest(Request $request, $event_id, $guest_id)
    {
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
        ]);
        $guest = Guest::find($guest_id);
        if ($guest) {
            $guest->first_name = $request->first_name;
            $guest->last_name = $request->last_name;
            $guest->gender = $request->gender;
            $guest->email = $request->email;
            $guest->phone = $request->phone;
            $guest->save();

            return response()->json([
                'success' => true,
                'data' => $guest,
                'message' => 'success',
            ], 201);
        }

        return response()->json([
            'success' => false,
            'data' => $guest,
            'message' => 'failed',
        ], 500);
    }

    public function deleteGuest($event_id, $guest_id)
    {
        $couplesM = Couple::where('event_id', $event_id)->where('male_gid', $guest_id)->get();
        foreach ($couplesM as $couple) {
            Couple::find($couple->id)->delete();
        }
        $couplesF = Couple::where('event_id', $event_id)->where('female_gid', $guest_id)->get();
        foreach ($couplesF as $couple) {
            Couple::find($couple->id)->delete();
        }
        Guest::find($guest_id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'success',
        ], 201);
    }

    public function deleteCouple($event_id, $couple_id)
    {
        $couple = Couple::find($couple_id);
        $couple->delete();

        return response()->json([
            'success' => true,
            'message' => 'success',
        ], 201);
    }

    public function sendMatchAll($event_id)
    {
        $couples = Couple::where('event_id', $event_id)->where('is_matched', true)->get();
        foreach ($couples as $couple) {
            $this->sendMailtoCouple($couple);
        }

        return response()->json([
            'success' => true,
            'data' => $couple,
            'message' => 'success',
        ], 201);
    }

    public function sendMatch($couple_id)
    {
        $couple = Couple::with(['male', 'female'])->find($couple_id);

        if ($couple) {
            $this->sendMailtoCouple($couple);
            return response()->json([
                'success' => true,
                'data' => $couple,
                'message' => 'success',
            ], 201);
        }

        return response()->json([
            'success' => false,
            'data' => $couple,
            'message' => 'failed',
        ], 500);
    }

    private function sendMailtoCouple($couple)
    {
        $male_email = $couple->male->email;
        $female_email = $couple->female->email;
        Mail::to($female_email)->send(new MatchingMsg($couple->female, $couple->male, $male_email));
        Mail::to($male_email)->send(new MatchingMsg($couple->female, $couple->male, $female_email));
    }
    public function deleteEvent()
    {
        $event = Event::find($_POST['id']);
        if ($event->delete()) {
            return response()->json([
                'success' => true,
            ],200);
        } else {return response()->json([
            'success' => false,
        ],500);}
    }
}
