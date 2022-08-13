<?php

namespace App\Http\Controllers;

use App\Models\Participant;
// use App\Http\Controllers\DataTables;
use Yajra\DataTables\Contracts\DataTable;
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
        $this->middleware('auth');
    }
    
    public function index()
    {
        $participants = Participant::all();
        return view('Participant.index')->with([
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
