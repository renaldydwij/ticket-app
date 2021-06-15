<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*  request()->validate([
            'name' => 'required',
            'email' => 'required',
            'name_customer' => 'required',
            'comment' => 'required',
            'image' => 'required|mimes:jpg,jpeg,bmp,png|max:4096',
        ]);

        $file = $request->file('img');
        $file_name = time(). '.' . $file->getClientOriginalName();
        $file->move(public_path('image'), $file_name);

        return Ticket::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'name_customer' => $request['name_customer'],
            'comment' => $request['comment'],
            'image' => $file_name
        ]); */
        $ticket = new Ticket;

        $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'name_customer' => 'required|string',
            'comment' => 'required',
            'img' => 'mimes:jpg,jpeg,png|max:4096'
            ]);
            
        if ($request->hasFile('img')) {
            
            /* $request->validate([
                'name' => 'required',
                'email' => 'required',
                'name_customer' => 'required',
                'comment' => 'required',
                'img' => 'mimes:jpg,jpeg,png|max:4096'
                ]); */
            $file = $request->file('img');
            $file_name = time(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $file_name);
        }
        $ticket->name = $request->name;
        $ticket->name_customer = $request->name_customer;
        $ticket->email = $request->email;
        $ticket->comment = $request->comment;
        $ticket->image = $file_name;
        $ticket->save();
        if (!$ticket) {
            return response(
                [
                    'status' => false,
                    'message' => 'Data Ticket Gagal Disimpan !',
                    'data' => $ticket,
                ],
                200
            );
        } else {
            return response(
                [
                    'status' => true,
                    'message' => 'Data Ticket Berhasil Disimpan !',
                    'data' => $ticket,
                ],
                200
            );
        }
        
     
           
        /* try{
            if($request->hasFile('img')){
                $request->validate(['img' => 'mimes:jpg,jpeg,png|max:4096']);
                $file = $request->file('img');
                $file_name = time(). '.' . $file->getClientOriginalName();
                $file->move(public_path('image'), $file_name);
                return response()->json([
                    'message'=>'File Uploaded Successfully!'
                ], 200);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>$e->getMessage()
            ]);
        }
        return Ticket::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'name_customer' => $request['name_customer'],
            'comment' => $request['comment'],
            'image' => $request['image']
        ]); */
        /* $this->validate($request, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8'
        ]);
        
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'bio' => $request['bio'],
            'photo' => $request['photo'],
            'password' => Hash::make($request['password']),
        ]); */
    }

















        /* return response()->json([
            'message'=>"ok"
        ]); */
       /*  $data = $request->validate([
            'photo'   => ['mimes:jpg,jpeg,png|max:4096'],
            'name'     => ['required', 'string'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $file = $request->file('photo');
        $name = '/img/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $data['photo'] = $name;

        $ticket = Ticket::create($data);

        if (!$ticket) {
            return response(
                [
                    'status' => false,
                    'message' => 'Data Ticket Gagal Disimpan !',
                    'data' => $ticket,
                ],
                200
            );
        } else {
            return response(
                [
                    'status' => true,
                    'message' => 'Data Ticket Berhasil Disimpan !',
                    'data' => $ticket,
                ],
                200
            );
        } */
       /*  $this->validate($request, [
            'name' => 'required|string|max:50',
            'name_customer' => 'required',
            'email' => 'required|string|email|max:50',
            'comment' => 'required|max:100',
        ]); */

        /* $ticket = new Ticket;
        if ($request->file('photo')) {
            $request->validate(['photo' => 'mimes:jpg,jpeg,png|max:4096']);
            $image = $request->file('photo');
            $path = 'img/';
            $file = $path . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/'), $file);
            $ticket->image = $file;
        }
        $ticket->name = $request->name;
        $ticket->name_customer = $request->name_customer;
        $ticket->email = $request->email;
        $ticket->comment = $request->comment;
        $ticket->photo = $image;
        $ticket->save();
        if (!$ticket) {
            return response(
                [
                    'status' => false,
                    'message' => 'Data Ticket Gagal Disimpan !',
                    'data' => $ticket,
                ],
                200
            );
        } else {
            return response(
                [
                    'status' => true,
                    'message' => 'Data Ticket Berhasil Disimpan !',
                    'data' => $ticket,
                ],
                200
            );
        } */

        /* $pathToFile = $request->file('photo')->store('img', 'public'); */

        /* $fileUpload = new Ticket;
    
            if($request->file()) {
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('photo')->storeAs('img', $file_name, 'profile');
    
                $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
                $fileUpload->path = '/public/' . $file_path;
                $fileUpload->save();
    
                return response()->json(['success'=>'File uploaded successfully.']);
            } */
        
        
        
        /* $fileName = time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file->move(public_path('img'), $fileName); */
              
        
             /*  $file = Ticket::create('photo');
              if ($file !== null) {
                  echo $file->getClientOriginalExtension();  
              } */
        

       /*  return Ticket::create([
            'name' => $request->name,
            'name_customer' => $request->name_customer,
            'email' => $request->email,
            'comment' => $request->comment,
            'photo' => $request->photo
        ]);  */
        
        /* return $pathToFile; */
        /* return response()->json(['success'=>'You have successfully upload file.']); */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ticket::findOrFail($id);
        // show the ticket

        /* if (is_null($ticket)) {
            $response = [
                'success' => false,
                'message' => "Ticket not found",
            ];
            return response()->json($response, 403);
        }
        $response = [
            'success' => true,
            'data' => new Ticket($ticket),
            'message' => 'Post successfully Retrieved'
        ];
        return response()->json($response, 200); */
        /* $ticket->delete();

        return ['message' => 'Ticket Deleted']; */
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
        

        
        /* if ($request->hasFile('img')) {
            $request->validate(['img' => 'mimes:jpg,jpeg,png|max:4096']);
            $file = $request->file('img');
            $file_name = time(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $file_name);
        }
        $ticket->name = $request->name;
        $ticket->name_customer = $request->name_customer;
        $ticket->email = $request->email;
        $ticket->comment = $request->comment;
        $ticket->image = $file_name;
        $ticket->save(); */
        /* if (!$ticket) {
            return response(
                [
                    'status' => false,
                    'message' => 'Data Ticket Gagal Diupdtae !',
                    'data' => $ticket,
                ],
                200
            );
        } else {
            return response(
                [
                    'status' => true,
                    'message' => 'Data Ticket Berhasil Diupdate !',
                    'data' => $ticket,
                ],
                200
            );
        } */
        request()->validate([
            /* 'name' => 'required',
            'email' => 'required',
            'name_customer' => 'required',
            'comment' => 'required',
            'image' => 'required|mimes:jpg,jpeg,bmp,png|max:4096', */
            'name_status' => 'required|string',
            'name_priority' => 'required|string',
            'development' => 'required|string', 
        ]);

        $ticket = Ticket::findOrFail($id);

      /*   $this->validate($request, [
            'name' => 'required|string|max:50',
            'name_customer' => 'required',
            'email' => 'required|string|email|max:50',
            'comment' => 'required|max:100',
            'status' => 'required|string',
            'priority' => 'required|string',
            'development' => 'required|string', 
            'image' => 'required|mimes:jpg,jpeg,bmp,png|max:1024', 
        ]); */

        $ticket->update($request->all()); 
        return ['message' => 'Updated the user info'];

       /*  if (!$ticket) {
            return response(
                [
                    'status' => false,
                    'message' => 'Data Ticket Gagal Diupdtae !',
                    'data' => $ticket,
                ],
                200
            );
        } else {
            return response(
                [
                    'status' => true,
                    'message' => 'Data Ticket Berhasil Diupdate !',
                    'data' => $ticket,
                ],
                200
            );
        } */

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $ticket = Ticket::findOrFail($id);
        // delete the ticket

        $ticket->delete();

        return ['message' => 'Ticket Deleted'];
    }
}
