<?php

namespace App\Http\Controllers\provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {

      

    }

    public function get_activate_phone(){
  
               
               
                     
        if(!auth("provider")->check() ){
            return redirect("/login");
        }
        
        
         
         
        if (auth("provider")-> user()  -> phoneactivated == "1"){

            return redirect("/resturant/dashboard");
        }
        
        
       
        
        $data['title'] = "تأكيد رقم الهاتف";
        $data['class'] = "page-template password recovery";
        
        
        return view("Provider.pages.activate-phone", $data);
        
    }

    public function post_activate_phone(Request $request){

       // App()->setLocale("ar");
        $rules = [

            "code"    => "required",

        ];

        $messages = [
            "required"    => trans("messages.required"),
        ];

        $this->validate($request, $rules , $messages);

        $code = $request->input("code");

           
        $hash = json_decode(auth('provider')->user()->activate_phone_hash);
        //if (\Carbon\Carbon::now()->gt(Carbon::createFromTimestamp($hash->expiry))) {
        //    return redirect()->back()->with("error", trans("messages.register.active.expire"));
        //}

        if($hash->code != $code){
            return redirect()->back()->with("error", trans("messages.register.active.notMatch"));
        }

        DB::table("providers")
                ->where("id", auth('provider')->id())
                ->update([
                    "phoneactivated" => "1",
                    "activate_phone_hash" => ""
                ]);


         return redirect("/restaurant/complete-profile/map");

    }

    public function resend_activate_code(){
        
                      
        if(!auth("provider")->check() ){
            return redirect("/login");
        }
        
        
         
        if (auth("provider")-> user()  -> phoneactivated  == "1"){

            return redirect("/resturant/dashboard");
        }

 

        $resendCode = Session::get("resend_code");
        
        if($resendCode){
            if($resendCode > 3){
                return redirect("/restaurant/activate-phone")->with("error", "تم ارسال رقم التفعيل من قبل");
            }else{
                Session::put("resend_code", ($resendCode + 1));
            }
        }else{
            // add the number
            Session::put("resend_code", 1);
        }
        $code  = (new \App\Http\Controllers\Apis\User\GeneralController())->generate_random_number(4);
        
        $hash = json_encode([
            'code' => $code,
            'type' => 'phone-activation',
            'expiry' => \Carbon\Carbon::now()->addDays(1)->timestamp,
        ]);

        $user = DB::table("providers")
                ->where("id",auth("provider") ->id())
                ->update([
                    "activate_phone_hash" => $hash
                ]);
                
                

        $message = "رقم الدخول الخاص بك هو :- " .$code ;
        $res = (new \App\Http\Controllers\Apis\User\SmsController())->send($message ,auth("provider")-> user()  -> phone);
        return redirect("/restaurant/activate-phone")->with("success", "تم ارسال رقم تفعيل جديد على رقم الهاتف");
    }

}
