<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Relationship;
use Auth;
use App\Services\DataService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = User::orderBy('id', 'asc')->get();
            $state= 200;
            return response()->json(['data' => $data, 'state' => $state]);
    }


    public function getUserListWithStatus($id){
        
            $dataserve = new DataService;
            $data = $dataserve->getUserList($id);
            $state= 200;
            return response()->json(['data' => $data, 'state' => $state]);
    }

    /**
     * create user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input['password']);
        $user->latitude = $request->input('latitude');
        $user->longitude = $request->input('longitude');
        $user->save();
        $data = "Succefully updated ".$user->id;
        $state= 200;
        return response()->json(['data' => $data, 'state' => $state]);
    }


    /**
     * login Registered users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        $email = $request->input('email');
        $password = $request->input['password'];
        $remember =1;
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
        $dataserve = new DataService;
        $userInfo  = $dataserve->getUserPoint(Auth::user()->id);
            // Authentication passed...
            $data = $userInfo;
            $state= 200;
            return response()->json(['data' => $data, 'state' => $state]);
        }
        return response()->json(['data' => $data, 'state' => $state]);
    }

    /**
     * logout Registered users
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
            Auth::logout();
            $data = "Succefully logged out ";
            $state= 200;
            return response()->json(['data' => $data, 'state' => $state]);
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
        $user = User::find($id);
        $data = $user;
        $state= 200;
        return response()->json(['data' => $data, 'state' => $state]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $data = $user;
        $state= 200;
        return response()->json(['data' => $data, 'state' => $state]);
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
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input['password']);
        $user->latitude = $request->input('latitude');
        $user->longitude = $request->input('longitude');
        $user->save();
        $data = "Succefully updated ".$user->id;
        $state= 200;
        return response()->json(['data' => $data, 'state' => $state]);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendFriendRequest(Request $request, $id)
    {

        $status = 0;
        $relation = new Relationship;
        $friendId = $request->input('friend_id');
        $relation->user_one_id = min($id,$friendId);
        $relation->user_two_id = max($id,$friendId);
        $relation->status = $status;
        $relation->action_user_id   = $id;
        $relation->save();
        $data = "Done";
        $state = 200;
        return response()->json(['data' => $data, 'state' => $state]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function respondFriendRequest(Request $request, $id)
    {
        //
        $status = $request->input('status');
        $relationId = $request->input('request_id');
        Relationship::where('id', '=', $relationId)
            ->update(array('status' =>  $status,'action_user_id' =>  $id));
        $data ='done';
        $state = 200;
        return response()->json(['data' => $data, 'state' => $state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFriendList($id)
    {
        $dataserve = new DataService;
        $userPoint  = $dataserve->getUserPoint($id);
        // print_r($userPoint); die;
        $data = $dataserve->getFriendList($id,$userPoint);
        $state = 200;
        return response()->json(['data' => $data, 'state' => $state]);
    }

}
