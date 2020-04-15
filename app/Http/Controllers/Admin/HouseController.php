<?php

namespace App\Http\Controllers\Admin;
use App\House;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class HouseController extends Controller
{

    private $validationHouse = [   
        'room_number' => 'required|numeric',
        'bed' => 'required|numeric',
        'bathroom' => 'required|numeric',
        'mq' => 'required|numeric',
        'address' => 'required|string',
        'img_path' => 'image|nullable',
        'status' => 'required|boolean'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();
        return view('admin.houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.houses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUser = Auth::user()->id;

        $request->validate($this->validationHouse);

        // $request->validate([
        //     'room_number' => 'required|numeric',
        //     'bed' => 'required|numeric',
        //     'bathroom' => 'required|numeric',
        //     'mq' => 'required|numeric',
        //     'address' => 'required|string',
        //     'img_path' => 'image',
        //     'status' => 'required|boolean'
        // ]);

        $data = $request->all();

        $newHouse = new House;

        $path = Storage::disk('public')->put('images', $data['img_path']);

        $newHouse->fill($data);
        $newHouse->user_id = $idUser;
        $newHouse->img_path = $path;
        $saved = $newHouse->save();
        if (!$saved) {
            return redirect()->back();
        }

        return redirect()->route('admin.houses.show', $newHouse);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        if (empty($house)) {
            abort('404');
        }
        return view('admin.houses.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        if (empty($house)) {
            abort('404');
        }

        return view('admin.houses.edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        $data = $request->all();
        $request->validate($this->validationHouse);
        $house->update($data);

        return redirect()->route('admin.houses.show', $house);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        if (empty($house) || $house->user_id != Auth::id()) {
            abort('404');
        }

        // $house->extra_service()->detach();
        $house->delete();
        return redirect()->route('admin.houses.index');
    }
}
