<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Participant;
// use App\Http\Controllers\DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

    }
    
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendance.index')->with([
            'attendances' => $attendances
        ]);
    }

    public function data(Request $request)
    {
        // dd('masuk fungsi');
        if ($request->ajax()) {

            if (!empty($request->location_id)) {
                $data = DB::select("SELECT c.name, c.title, c.code, b.name location, MIN(date) date
                                FROM attendances a
                                INNER JOIN locations b ON a.location_id = b.id
                                INNER JOIN participants c ON a.participant_id = c.id
                                WHERE a.location_id = ?
                                GROUP BY c.name, c.title, c.code, b.name", [$request->location_id]);
            } else {
                $data = DB::select("SELECT c.name, c.title, c.code, b.name location, MIN(date) date
                                FROM attendances a
                                INNER JOIN locations b ON a.location_id = b.id
                                INNER JOIN participants c ON a.participant_id = c.id
                                GROUP BY c.name, c.title, c.code, b.name");
                            }
           
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('code', function ($row) {
                    return $row->code;
                })
                ->addColumn('location', function ($row) {
                    return $row->location;
                })
                ->addColumn('attendance', function ($row) {
                    return Carbon::parse($row->date)->format('d-m-Y H:i:s');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $participant_id;
        if (!empty($request->participant_code)) {
            $participant = Participant::where('code',$request->participant_code)
                ->where('location_id',$request->location_id)
                ->first();
            if (empty($participant)) {
                return response()->json(['success' => false, 'message' => 'NIK tidak terdaftar di lokasi ini!']);
            }
            $participant_id = $participant->id;
        }

        $is_exist = Attendance::where('participant_id',$participant_id)
                ->first();
        if (!empty($is_exist)) {
            return response()->json(['success' => false, 'message' => 'Anda sudah check in sebelumnya.']);
        }
        $attendance = Attendance::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'event_id' => 1,
                'location_id' => $request->location_id,
                'participant_id' => $participant_id,
                'date' => date('Y-m-d H:i:s'),
            ]
        );

        return response()->json([
            'success' => true, 
            'message' => 'Data save sucessfuly!',
            'result_id' => $attendance->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attendance = Attendance::find($id);
        return response()->json($attendance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendance = Attendance::find($id);
        return response()->json($attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attendance::find($id)->delete();

        return response()->json(['success' => 'Data deleted!']);
    }

    public function check_in_form($location_id)
    {
        return view('attendance.check_in_form')->with([
            'location_id' => $location_id
        ]);
    }

    public function check_in_result($id)
    {
        $attendance = Attendance::find($id);
        return view('attendance.check_in_result')->with([
            'attendance' => $attendance
        ]);
    }

}
