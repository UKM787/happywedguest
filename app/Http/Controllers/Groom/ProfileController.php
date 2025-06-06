<?php

namespace App\Http\Controllers\Groom;

use Exception;
use App\Models\Host\Home;
use App\Models\Host\Office;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use App\Models\Host\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ProfileController extends Controller
{

    use ImageUpload;

    public function __construct()
    {
        //$this->middleware('auth:groom');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()  {

        if (Auth::guard('host')->check()) {
            $groom= auth()->guard('host')->user();
            $groomID = $groom->id;
            $profile = $groom->profile;
            if(isset($groom->profile)){
                $cexists =1;
                $exists = 0;
                $oexists = 0;
                if(isset($groom->home)){
                    $exists = 1;               
                }
                if(isset($groom->office)){
                    $oexists = 1;               
                }
                return view('groom.profile.index', compact('groom', 'profile', 'groomID', 'exists', 'cexists', 'oexists')) ;
            }elseif($groom->home){
                $exists = 1;
                $cexists = 0;
                $oexists = 0;
                if(isset($groom->office)){
                    $oexists = 1;               
                }
                return view('groom.profile.index', compact('groom', 'profile', 'groomID', 'exists', 'cexists', 'oexists')) ;
            }else{
                $exists = 0;
                $cexists = 0;
                $oexists = 0;
                if(isset($groom->office)){
                    $oexists = 1;               
                }
                return view('groom.profile.index', compact('groom', 'profile', 'groomID', 'exists', 'cexists', 'oexists')) ;
            }


        } else {
            return redirect()->route('login')
                ->with([
                    'status' => 'failure',
                    'message' =>  'Login to create your profile'
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Profile $currentProfile)  {
        
       
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Profile $profile)    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)   {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Profile $profile, Request $request)  {
        
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
     * Validatating the form data.
     *
     * @param  App\Models\Guest\GuestProfile
     * @return \Illuminate\Http\Response
     */

    /**
     * Storing and updating the guest_image
     *
     * @param  App\Models\Guest\GuestProfile
     * @return \Illuminate\Http\Response
     */

}
