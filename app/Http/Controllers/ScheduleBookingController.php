<?php

namespace App\Http\Controllers;

use App\Models\ScheduleBookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mail;

class ScheduleBookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = ScheduleBookings::get();
        return view("schedule_bookings", compact("bookings"));
    }

    public function schedule_bookings_graph(Request $request)
    {
        return view('schedule_bookings_graph');
    }


    public function count(){
        $count = ScheduleBookings::select('booking_date', DB::raw('count(*) as count'))
             ->groupBy('booking_date')
             ->get();
             $data['data']= $count;
            return $data;
    }

    public function destroy($id)
    {
        $data = ScheduleBookings::find($id);
        $data->delete();
        return redirect("schedule_bookings")->withSuccess('Schedule Booking deleted successfully');
    }

    public function clearTestBookings(Request $request){
        ScheduleBookings::where('email','like','%@mprglobalsolutions.com')->delete();
        return redirect("schedule_bookings")->withSuccess('Test Bookings deleted successfully');
    }

}