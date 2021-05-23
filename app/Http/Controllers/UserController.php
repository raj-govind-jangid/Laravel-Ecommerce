<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Session;
use Illuminate\Support\Str;
use Mail;

class UserController extends Controller
{
    public function loginuser(Request $request)
    {
        $user = User::where(['user_email'=>$request->email])->first();
        if($user && Hash::check($request->password, $user->user_password)){
            $request->session()->put('user',$user);
            return redirect('/login');
        }
        else{
            session()->put('fail',"Email or Password is incorrect");
            return redirect('/login');
        }
    }

    public function registeruser(Request $request)
    {
        if(!User::where(['user_email'=>$request->email])->first())
        {
            $password = Str::random(10);
            $userin = new User;
            $userin->user_name = $request->name;
            $userin->user_email = $request->email;
            $userin->user_phoneno = $request->phoneno;
            $userin->user_password = Hash::make($password);
            $userin->user_type = "User";
            $save = $userin->save();

            if($save){
                $data = ['email'=>$request->email,'password'=>$password];
                $user['to'] = $request->email;
                Mail::send('mail.createaccount',$data,function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Your Account Credentials');
                });
                session()->put('success',"We have send the password to your email account");
                return redirect('/login');
            }

            else{
                session()->put('fail',"Something Went Wrong");
                return redirect('/register');
            }

        }

        else{
            session()->put('fail',"Email Already Exists");
            return redirect('/register');
        }

    }

    public function logout(){
        $useremail = session()->get('user')['user_email'];
        Cache::pull(".$useremail.");
        Session::forget('user');
        return redirect('login');
    }

    public function forgetpassword(Request $request){
        if($user = User::where(['user_email'=>$request->email])->first()){
            $forgetemail = $request->email;
            $resetcode = rand(100000,999999);
            $resetcodetime = date('Y-m-d h:i:s',strtotime('15 minutes'));
            $user->update(['resetcode'=>$resetcode, 'resetcodetime'=>$resetcodetime]);
            $data = ['resetcode'=>$resetcode];
            $user['to'] = $request->email;
            Mail::send('mail.forgetpassword',$data,function($messages) use ($user){
            $messages->to($user['to']);
            $messages->subject('Your One Time Password to change password');
            });
            session()->put('success',"We have send OTP To your Email Id");
            return view('user.changepassword',['forgetemail'=>$forgetemail]);
        }
        else{
            session()->put('fail',"Email ID not Found");
            return redirect('/forgetpassword');
        }
    }

    public function changepassword(Request $request){
        $forgetemail = $request->forgetemail;
        $user = User::where(['user_email'=>$forgetemail])->first();
        if($request->verifyotp == $user['resetcode']){
            $currenttime = date('Y-m-d h:i:s',strtotime('now'));

            if($user['resetcodetime'] > $currenttime){
                $user->update(['user_password'=> Hash::make($request->password)]);
                session()->put('success',"Password have Changed Successfully");
                return redirect('/login');
            }

            else{
                session()->put('fail',"Please Entry Valid OTP");
                return view('user.changepassword',['forgetemail'=>$forgetemail]);
            }
        }

        else{
            session()->put('fail',"Please Entry Valid OTP");
            return view('user.changepassword',['forgetemail'=>$forgetemail]);
        }
    }

    public function profile(){
        $user = User::where(['user_id'=>session()->get('user')['user_id']])->first();
        return view('user.profile',['user'=>$user]);
    }

    public function updateprofile(Request $request){
        $user = User::where(['user_id'=>session()->get('user')['user_id']])->first();
        $oldemail = $user['user_email'];
        $newemail = $request->email;
        $checkemail = User::whereIn('user_email', array($oldemail, $newemail))->get()->count();
        if($user['user_email'] == $request->email){
            $user->update([
                'user_name'=> $request->name,
                'user_email'=> $request->email,
                'user_phoneno'=> $request->number
            ]);
            session()->put('success',"Profile Updated Successfully");
            return redirect('profile');
        }
        elseif($checkemail == 1){
            $verifycode = rand(100000,999999);
            $verifycodetime = date('Y-m-d h:i:s',strtotime('15 minutes'));
            $user->update(['verifycode'=>$verifycode, 'verifycodetime'=>$verifycodetime]);
            $data = ['verifycode'=>$verifycode];
            $user['to'] = $newemail;
            Mail::send('mail.changeemailaddress',$data,function($messages) use ($user){
            $messages->to($user['to']);
            $messages->subject('Your One Time Password to Verify Email Id');
            });
            session()->put('success',"We have Send OTP To Your New Email Id");
            return view('user.changeemailaddress',['newemail'=>$newemail,'oldemail'=>$oldemail]);
        }
        elseif($checkemail == 2){
            session()->put('fail',"Email Id already exists");
            return redirect('profile');
        }
    }

    public function updateemailaddress(Request $request){
        $oldemail = $request->oldemail;
        $newemail = $request->newemail;
        $user = User::where(['user_email'=>$oldemail])->first();
        echo $user;
        if(Hash::check($request->password, $user->user_password)){
            $currenttime = date('Y-m-d h:i:s',strtotime('now'));

            if($user['verifycode'] == $request->verifyotp && $user['verifycodetime'] > $currenttime){
                $user->update([
                    'user_email'=>$newemail
                ]);
                session()->put('success','Email ID changed Successfully');
                return redirect('profile');
            }

            else{
                session()->put('fail','Verify Code is Invalid');
                return view('user.changeemailaddress',['newemail'=>$newemail,'oldemail'=>$oldemail]);
            }
        }

        else{
            session()->put('fail','Password is Invalid');
            return view('user.changeemailaddress',['newemail'=>$newemail,'oldemail'=>$oldemail]);
        }

    }

    public function changeuserpassword(){
        $email = session()->get('user')['user_email'];
        return view('user.changeuserpassword',['email'=>$email]);
    }

    public function updateuserpassword(Request $request){
        $user = User::where(['user_email'=>$request->email])->first();
        if(Hash::check($request->oldpassword, $user->user_password)){

            if($request->password == $request->confirmpassword){
                $user->update(['user_password'=>Hash::make($request->password)]);
                session()->put('success',"Password Change Successfully");
                Session::forget('user');
                return redirect('/login');
            }

            else{
                session()->put('fail',"Password Don't Match Correctly");
                return redirect()->back();
            }
        }

        else{
            session()->put('fail',"Please Enter Your Old Password Correctly");
            return redirect()->back();
        }
    }

    public function onlineuser(){
        if(session()->get('user')){
            $useremail = session()->get('user')['user_email'];
            Cache::put(".$useremail.",1,60);
        }
    }

    static function userstatus($useremail){
        if(Cache::get(".$useremail.")){
           return "<span style='color: green;'>Online</span>";
        }
        else{
           return "<span style='color: red;'>Offline</span>";
        }
    }

}
