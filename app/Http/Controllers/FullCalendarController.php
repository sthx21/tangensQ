<?php

namespace App\Http\Controllers;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Event;

class FullCalendarController extends Controller
{
    /**
     * Write code on Method
     *
     *
     */
    public function index(Request $request)

    {

        return view('calendar');
    }

    public function getWorkshopEvents(Request $request)
    {
            $data = \DB::table('events')
                ->where('type', '=', 'workshop')
                ->where('booked', '=', 0)
                ->whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get();
            return response()->json($data);

    }
    public function getBookedWorkshopEvents(Request $request)
    {
        $data = \DB::table('events')
            ->where('type', '=', 'workshop')
            ->where('booked', '=', 1)
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();
        return response()->json($data);

    }
    public function getInHouseEvents(Request $request)
    {
        $data = \DB::table('events')
            ->where('type', '=', 'inhouse')
            ->where('booked', '=', 0)
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();
        return response()->json($data);
    }
    public function getBookedInHouseEvents(Request $request)
    {
        $data = \DB::table('events')
            ->where('type', '=', 'inhouse')
            ->where('booked', '=', true)
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();
        return response()->json($data);
    }
    public function getWebExEvents(Request $request)
    {
        $data = \DB::table('events')
            ->where('type', '=', 'webex')
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();
        return response()->json($data);

    }
    public function getTrainerInHouseEvents(Request $request)
    {
        $trainer = Trainer::whereId($request->trainerId)->with('events')->first();
        $data = $trainer->events()
            ->whereType('Inhouse')
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();

        return response()->json($data);

    }
    public function getTrainerWorkshopEvents(Request $request)
    {
        $trainer = Trainer::whereId($request->trainerId)->with('events')->first();
        $data = $trainer->events()
            ->whereType('workshop')
            ->whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();

        return response()->json($data);

    }
    /**
     * Write code on Method
     *
     * @return JsonResponse()
     */
    public function editEvents(Request $request)
    {

        switch ($request->type) {

            case 'create':
                dd($request);
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
                break;
            case 'update':
                dd($request);
                $start = Carbon::create($request->start);
                $end = Carbon::create($request->end);
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $start,
                    'end' => $end,
                ]);
                return response()->json($event);
                break;
            case 'delete':
                $event = Event::find($request->id)->delete();
                return response()->json($event);
                break;
            default:
                # code...
                break;
        }
    }
}
