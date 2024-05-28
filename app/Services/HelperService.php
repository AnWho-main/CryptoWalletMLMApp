<?php

namespace App\Services;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\V1\BaseController;
use App\Models\member\MemberProfile;
use App\Models\member\ClientPayout;
use App\Models\member\ClientProfile;
use App\Models\member\ClientTransactions;
use Log;
use Exception;
use Carbon\Carbon;

class HelperService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }

      // My total Team {return the array of all levelwise downline members}
      public function getFullTeam($tabName, $colClient, $colParent, $parentArray)
      {
            DB::statement("SET SESSION group_concat_max_len = 1000000");
  
            $modelName = 'App\\Models\\member\\'.$tabName;

         $rows = $modelName::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
                ->whereIn($colParent, $parentArray)
                ->get()
                ->pluck('Ids')
                ->first();
    
            if (!empty($rows)) {
                $trimmed = trim($rows, "'");
                $childArray = explode("','", $trimmed);
    
                if (!empty($childArray)) {
                    $descendants = $this->getFullTeam($tabName, $colClient, $colParent, $childArray);
                    $parentArray = array_merge($parentArray, $descendants);
                }
            }
            return $parentArray;
       }
  
        //  Get level wise clients ID  
        public function getNthLevelChilds($tabName,$colClient,$colParent,$levelLimit = 1, $parentArray, $level = 1)
        {
            DB::statement("SET SESSION group_concat_max_len = 1000000");

            $modelName = 'App\\Models\\member\\'.$tabName;
            $rows = $modelName::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
            ->whereIn($colParent, $parentArray)
            ->get()
            ->pluck('Ids')
            ->first();
            
            if(!empty($rows) && $level<$levelLimit){
                $trimmed = trim($rows,"'");
                $parentArray= explode("','",$trimmed);
                if(!empty($parentArray)){
                    $rows = $this->getNthLevelChilds($tabName,$colClient,$colParent,$levelLimit, $parentArray, $level+1);
                }else{
                    $rows = array();
                }
            }
            return $rows;
        }

        // For finding the all downline members 
        public function downlineExplorer($clubTable,$id,$parent_id)
        {
            $clubTab = 'App\\Models\\member\\'.$clubTable;
    
            $rsdClub = $clubTab::where('parent_id',$id)->get();
    
            foreach($rsdClub as $rsClub)
            {
                $parent_id=$rsClub->parent_id;
                $clientID = $rsClub->client_id;
                if($id!=0){
                    $rsClientDet = MemberProfile::where('id',$clientID)->first();
                    
                    if(!empty($rsClientDet)){
                        $clientName = $clientID." - ".$rsClientDet->m_name;
                        }else{
                        $clientName = $clientID;
                    }
                echo "mytree.add('$clientID', '$parent_id', '$clientName', 'networkExplorer?client_id=$clientID&club=$clubTable&search=');";     
                  $this->downlineExplorer($clubTable,$clientID, $parent_id);
                }
            }
        }

        // For finding upline members
        public function uplineSponsorMembers($userID, $colName, $tabName, $limit, $package, $sponsorArray, $level){
    
            $modelName = 'App\\Models\\member\\'.$tabName;
            $rowSpId = $modelName::select('parent_id', 'current_package')
            ->where($colName, '=', $userID)
            ->first();
        
            $sponsor = $rowSpId->parent_id;
            if($sponsor != 0 && count($sponsorArray)<$limit){
                         
               $rowSponsor =  $modelName::select('current_package','activation_status')
               ->where($colName,$sponsor)
               ->first();
                if($rowSponsor->activation_status == 1 && $rowSponsor->current_package >= $package){ 
                $sponsorArray[$sponsor] = array($level => $rowSponsor->current_package);
                }
                $level++;
                return $this->uplineSponsorMembers($sponsor, $colName, $tabName, $limit, $package, $sponsorArray,$level);
            }else{
                return $sponsorArray;
            }
        }

        // For inserting all transactions data
        public function transactionEntryUpdate($userID,$userIDRef,$client_id,$client_id_from, $totCommission, $package, $level, $incomeType,$wallet_type,$amount_type,$walletCol,$trans_msg,$dtt,$timestamp){

        
            $tds = 0;
            $admin = 0;
            $final = $totCommission - $tds - $admin;

             try {
                    \DB::beginTransaction();

                $payStatus = 1;         
                $insert_client_payout =  ClientPayout::insertGetId([
                "income_type" => $incomeType,
                "user_id" => $userID,
                "ref_user_id" => $userIDRef,
                "total_commission" => $totCommission,
                "payable_income" => $final,
                "paid_level" => $level,
                "pay_status" =>  $payStatus,
                "payout_date" => $dtt,
                "created_at" => $timestamp
            ]);
         
            $lastIdPayout = $insert_client_payout;

            if($amount_type == "Credit"){
                $sign = '+'; }
            if($amount_type == "Debit"){
                $sign = '-';}
        
            $update_client_profile_account = ClientProfile::where('id', $userID)
           ->update([$walletCol => DB::raw("$walletCol $sign $totCommission"),
            ]);
               
            $insert_client_transactions = ClientTransactions::insert([
                "user_id" => $userID,
                "client_id"=>$client_id,
                "user_id_from"=>$userIDRef,
                "client_id_from"=>$client_id_from,
                "wallet_type" => $wallet_type,
                "amount" => $final,
                "package" => $package,
                "level"=>$level,
                "amount_type" => $amount_type,
                "ref_id" => $lastIdPayout,
                "message" => $trans_msg,
                "created_at" => $timestamp
            ]);

            \DB::commit();

            } catch (Exception $e) {
                \DB::rollBack();
                $except['status']           = false;
                $except['error'][]          = 'Exception Error...';
                $except['message']          = $e;
                $exception                  = new BaseController();
                $exception                  = $exception->throwExceptionError($except, 500);
            }
    }

}
