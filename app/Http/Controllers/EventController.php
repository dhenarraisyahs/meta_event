<?php

namespace App\Http\Controllers;

use App\Models\Event;
// use App\Http\Controllers\DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Http\Request;

class EventController extends Controller
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
        $events = Event::all();
        return view('event.index')->with([
            'events' => $events
        ]);
    }

    public function data(Request $request)
    {
        // dd('masuk fungsi');
        if ($request->ajax()) {
            $data = Event::all();
            // dd($data);
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editRecord">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteRecord">Hapus</a>';

                    // $btn = $btn . '<a href="' . route('program.show', $row->id) . '" class="view btn btn-warning btn-sm mx-2">Undi Hadiah</a>';
                    return $btn;
                })
                ->editColumn('is_active', function ($row) {

                    $types = array("-" => "-", "1" => "Aktif", "0" => "Tidak Aktif");
                    $stat = $row->is_active == null ? '-' : $row->is_active;
                    // $field = '<span class="badge '. $arr_badge[$status] .'">'. $conditions[$status] .'</span>';
                    $field = $types[$stat];
                    return $field;
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
        Event::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name,
                'date' => $request->date,
                'is_active' => $request->is_active
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
