<?php

namespace App\Http\Controllers\Admin;
use App\House;
use App\Extra;
use Carbon\Carbon;
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
        'description' => 'required|string',
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
        $housesPromo = House::where('status', 1)->get();
        $sponsoredHouses = [];
        foreach ($houses as $house) {
            foreach ($house->sponsors as $sponsor) {
                
                $now = Carbon::now();
                

                $expiring_date = $sponsor->pivot->created_at->addHours($sponsor->duration);
                // $someTime = Carbon::createFromFormat('H:i:s', '18:15:10');
                // // add time
                // $someTime1 = $someTime->addHours(10)->addMinutes(15)->addSeconds(20)->toTimeString();
                    // get hours different
                    //dd($someTime->diffInHours($someTime1));
                if ($now < $expiring_date && !in_array($house, $sponsoredHouses)) {
                    $sponsoredHouses[] = $house;       
                }
            }
        }
        return view('admin.houses.index', compact('houses','sponsoredHouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extras = Extra::all();

        
        return view('admin.houses.create', compact('extras'));
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
        // dd($extras);
        $extras = $data['extras'];
        if (!empty($extras)) {
            $newHouse->extras()->attach($extras);
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
        $data = House::limit(4)->get();
        $extras = Extra::all();
        if (empty($house) || $house->user_id != Auth::user()->id) {
            abort('404');
        }
        
        return view('admin.houses.show', compact('data', 'house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        if (empty($house) || $house->user_id != Auth::user()->id) {
            abort('404');
        }
        
        $extras = Extra::all();
        $data = [
            'house'=> $house,
            'extras' => $extras
            
        ];

        return view('admin.houses.edit', $data);
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
        
        $data['img_path'] = Storage::disk('public')->put('images', $data['img_path']);
        
        $request->validate($this->validationHouse);
        $house->update($data);
        $updated = $house->update($data);
        
        if (!$updated) {
            return redirect()->back();
        }
        $extras = $data['extras'];
        if(!empty($extras)) {
            $house->extras()->sync($extras);
        }
        
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
        
        $house->extras()->detach();
        $house->delete();
        return redirect()->route('admin.houses.index');
    }


    ///Prova Pagamento
    public function showSponsor($id){
        $house = House::where("id",$id)->first();

        return view("admin.sponsor",compact("house"));
    }

    public function pay(Request $request){
        $house = House::where("id", $request->id)->first();
        $house->sponsors()->detach();
        $house->sponsors()->attach($request->payment);
        return redirect()->route("admin.houses.index");
    }






}
