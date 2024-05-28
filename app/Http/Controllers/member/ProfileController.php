<?php
namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Session;
use App\Services\ProfileService;

class ProfileController extends Controller
{  

    public function __construct()
    {
        $this->ProfileService = new ProfileService();
    }
    
    public function showProfile(){
        return view("/".config('app.member_folder')."/profile/show", $this->ProfileService->ShowProfileData());  
     }

     public function editprofile(){
        return view("/".config('app.member_folder')."/profile/edit", $this->ProfileService->EditProfileData());  
     }

     public function Profile(Request $request){
              return $this->ProfileService->UpdateProfileData($request);
    }

}
