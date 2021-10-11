<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use DB;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //write a query to filter
        $clients = DB::table('clients');

        if($request->name){
            $clients->where('name', 'like', '%'.$request->name.'%');
        }

        if($request->phone){
            $clients->orWhere('phone', 'like', '%'.$request->phone.'%');
        }

        if($request->address){
            $clients->orWhere('address', 'like', '%'.$request->address.'%');
        }

        return $clients->get();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:clients|max:100',
            'phone' => 'required|max:20',
            'address' => 'required',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
          ]);
    
          return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
      return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {

        $request->validate([
            'name' => 'required|unique:clients|max:100',
            'phone' => 'required|max:20',
            'address' => 'required',
        ]);
        
        $client->update($request->only(['name', 'phone', 'address']));

      return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(null, 204);
    }
}
