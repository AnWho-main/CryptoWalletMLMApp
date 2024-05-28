<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\member\ClubStartup;
use App\Models\member\ClubSilver;
use App\Models\member\SupportTicket;
use App\Models\member\SupportChat;
use App\Models\member\MemberProfile;
use App\Models\member\ClientPayout;
use App\Models\member\ClientProfile;
use App\Models\member\ClientTransactions;
use App\Models\Site\CmsOrganizeProfileModel;
Use Session;
use App\Services\HelperService;

class AppHelper
{
    public function __construct()
    {
        $this->helperService = new HelperService();
    }

    // My total Team {return the array of all levelwise downline members}
    public function getAllTeam($tabName, $colClient, $colParent, $parentArray){
    return $this->helperService->getFullTeam($tabName, $colClient, $colParent, $parentArray);}

    //  Get level wise clients ID  
    public function getNthLevelChildsLimited($tabName,$colClient,$colParent,$levelLimit = 1, $parentArray, $level = 1){
    return $this->helperService->getNthLevelChilds($tabName,$colClient,$colParent,$levelLimit, $parentArray, $level);}

    // For finding the all downline members 
    public function explorer($clubTable,$id,$parent_id){
    return $this->helperService->downlineExplorer($clubTable,$id,$parent_id);}

    // For finding upline members
    public function uplineSponsor($userID, $colName, $tabName, $limit, $package, $sponsorArray, $level){
    return $this->helperService->uplineSponsorMembers($userID, $colName, $tabName, $limit, $package, $sponsorArray, $level);}

    // For inserting all transactions data
    public function transactionEntry($userID,$userIDRef,$client_id,$client_id_from, $totCommission, $package, $level, $incomeType,$wallet_type,$amount_type,$walletCol,$trans_msg,$dtt,$timestamp){
     return $this->helperService->transactionEntryUpdate($userID,$userIDRef,$client_id,$client_id_from, $totCommission, $package, $level, $incomeType,$wallet_type,$amount_type,$walletCol,$trans_msg,$dtt,$timestamp);
    }

    // For finding company details    
    public function orgProfile()
    {   
        $profileData =  CmsOrganizeProfileModel::get();
        $orgdata = array();
        foreach($profileData as $pd){
            $key = $pd->input_label;  
            $value = $pd->input_text;
            $orgdata[$key] = $value;
        }
        return $orgdata;
    }

    //  For finding login client details 
    public function userData($ucid){
        $udata = MemberProfile::where('client_id',$ucid)->first();      
            return $udata;
    }
     
    // for makeing address in short order
    function shortAddress($address){
        $from = $address;
        $start = substr($from, 0, 4); $end = substr($from, -3); 
        return $start.'....'.$end;
        } 

     // For chat support o
    function chatInteration(){
        $chats = SupportChat::where('status', 1)
        ->get();
        return $chats;
        }

    // For counting ticket messages
    public function availTic($statusKey){
        $at = SupportTicket::where('parent',0)->where('ticket_status',$statusKey)->where('replied_by_username',Session::get('loginID'))->count();
        return $at;
    } 

     public static function instance()
     {
         return new AppHelper();
     }
}