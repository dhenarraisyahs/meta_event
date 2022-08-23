<?php

namespace App\Http\Controllers;

use App\Models\Location;
// use App\Http\Controllers\DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
 

class LocationController extends Controller
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
        $locations = Location::all();
        return view('location.index')->with([
            'locations' => $locations
        ]);
    }

    public function data(Request $request)
    {
        // dd('masuk fungsi');
        if ($request->ajax()) {
            $data = Location::all();
            // dd($data);
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.url('/location/print_qr/'.$row->id).'" target="_blank"  class="btn btn-success btn-sm">Print QR</a>';

                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editRecord">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteRecord">Hapus</a>';

                    // $btn = $btn . '<a href="' . route('program.show', $row->id) . '" class="view btn btn-warning btn-sm mx-2">Undi Hadiah</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function statistic(Request $request)
    {
        if ($request->ajax()) {
             // dd('masuk fungsi');
            $data = DB::select("SELECT a.name, undangan, hadir  FROM (
                SELECT locations.id, locations.name, COUNT(DISTINCT(attendances.participant_id))  hadir
                FROM locations
                LEFT JOIN attendances ON locations.id = attendances.location_id
                GROUP BY locations.id
            ) a
            JOIN (
                SELECT locations.id, locations.name, COUNT(participants.id) undangan
                FROM locations
                LEFT JOIN participants ON locations.id = participants.location_id
                GROUP BY locations.id
            ) b ON a.id = b.id
            ");
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
        Location::updateOrCreate(
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
        $location = Location::find($id);
        return response()->json($location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        return response()->json($location);
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
        
        Location::find($id)->delete();

        return response()->json(['success' => 'Data deleted!']);
    }

    public function print_qr($id)
    {
        $location = Location::find($id);
        $url = url('/check_in_form/'.$id);

        $pdf = PDF::loadview('location.print_qr',['location'=>$location, 'url'=>$url]);
    	return $pdf->download('location-qr-pdf');
    }
}
