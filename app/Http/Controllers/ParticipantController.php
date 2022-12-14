<?php

namespace App\Http\Controllers;

use App\Models\Participant;
// use App\Http\Controllers\DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ParticipantController extends Controller
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
        $participants = Participant::all();
        return view('participant.index')->with([
            'participants' => $participants
        ]);
    }

    public function data(Request $request)
    {
        // dd('masuk fungsi');
        if ($request->ajax()) {
            $data = Participant::all();
            // dd($data);
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editRecord">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteRecord">Hapus</a>';

                    // $btn = $btn . '<a href="' . route('program.show', $row->id) . '" class="view btn btn-warning btn-sm mx-2">Undi Hadiah</a>';
                    return $btn;
                })
                ->editColumn('location', function ($row) {
                    return $row->location->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function statistic(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->location_id)) {
                $data = DB::select("SELECT a.title, undangan, hadir  FROM (
                    SELECT title, COUNT(DISTINCT(attendances.participant_id))  hadir
                    FROM participants
                    LEFT JOIN attendances ON participants.id = attendances.participant_id
                    WHERE participants.location_id = ?
                    GROUP BY participants.title
                ) a
                JOIN (
                    SELECT title, COUNT(participants.id) undangan
                    FROM participants
                    WHERE location_id = ?
                    GROUP BY participants.title
                ) b ON a.title = b.title", [$request->location_id, $request->location_id]);
            } else {
                $data = DB::select("SELECT a.title, undangan, hadir  FROM (
                    SELECT title, COUNT(DISTINCT(attendances.participant_id))  hadir
                    FROM participants
                    LEFT JOIN attendances ON participants.id = attendances.participant_id
                    GROUP BY participants.title
                ) a
                JOIN (
                    SELECT title, COUNT(participants.id) undangan
                    FROM participants
                    GROUP BY participants.title
                ) b ON a.title = b.title");
            }
           
            // dd($data);
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return $row->undangan - $row->hadir;
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
        Participant::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'event_id' => 1,
                'name' => $request->name
            ]
        );

        return response()->json(['success' => 'Data saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $participant = Participant::find($id);
        return response()->json($participant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $participant = Participant::find($id);
        return response()->json($participant);
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
        
        Participant::find($id)->delete();

        return response()->json(['success' => 'Data deleted!']);
    }
}
