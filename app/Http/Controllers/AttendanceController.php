<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Participant;
// use App\Http\Controllers\DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $attendances = Attendance::all();
        return view('Attendance.index')->with([
            'attendances' => $attendances
        ]);
    }

    public function data(Request $request)
    {
        // dd('masuk fungsi');
        if ($request->ajax()) {
            $data = Attendance::all();
            // dd($data);
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->participant->name;
                })
                ->addColumn('code', function ($row) {
                    return $row->participant->code;
                })
                ->addColumn('location', function ($row) {
                    return $row->location->name;
                })
                ->addColumn('attendance', function ($row) {
                    return $row->hour;
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
        return view('Attendance.check_in_form')->with([
            'location_id' => $location_id
        ]);
    }

    public function check_in_result($id)
    {
        $attendance = Attendance::find($id);
        return view('Attendance.check_in_result')->with([
            'attendance' => $attendance
        ]);
    }

}
