<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    // Profilo utente
    public function index () {
        
        return view('user.index');
    }

    // Annunci utente
    public function profile () {

        $user_announcements = User::find(auth()->user()->id);

        $announcements=Announcement::where('user_id','=',$user_announcements->id)->paginate(8);
       

        return view ('user.profile',['announcements' => $announcements]);
    }

    // Annunci preferiti
    public function wish()
    {
        $user = auth()->user();
    
        $announcements = Announcement::whereHas('favorites', function ($query) use ($user) {
        $query->where('user_id', $user->id);
        })->paginate(8);
    
     return view('user.wish', ['announcements' => $announcements]);
    }


    // Rotta per il recupero password
    public function forgotPassword()
    {
        
        return view('auth.forgot-password');
        
    }

    //rotta google redirect 
    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    //rotta google callback
    public function googleCallback() {

        $googleUser = Socialite::driver('google')->stateless()->user();
        

            $userGoogleId=User::where('google_id',$googleUser->id)->first();
            $userGoogleEmail=User::where('email',$googleUser->email)->first();


           if($userGoogleId){
            Auth::login($userGoogleId);
           }
            elseif($userGoogleEmail){
     

            Auth::login($userGoogleEmail);

            //     session()->flash('message','Sei già registrato con questa mail sul nostro sito');
            //    return redirect('/login');

            }elseif(!$userGoogleId) {
                $user = new User ;

            $user->name=$googleUser->name;
            $user->email=$googleUser->email;
            $user->password= Hash::make(Str::random(50));
            $user->google_id=$googleUser->id;
            $user->google_token=$googleUser->token;
            $user->google_refresh_token=$googleUser->refreshToken;

            $user->save();

            Auth::login($user);
                
                

            }
   
	        return redirect('/nuovo/annuncio');
    
    }

    //rotta per github
    public function githubRedirect() {
        return Socialite::driver('github')->redirect();
    }

    //rotta per redirect github

    public function githubCallback() {

        $githubUser = Socialite::driver('github')->stateless()->user();
        $userGithubId=User::where('github_id',$githubUser->id)->first();
        $userGithubEmail=User::where('email',$githubUser->email)->first();

        if($userGithubId){
            Auth::login($userGithubId);
           }
            elseif($userGithubEmail){
     

            Auth::login($userGithubEmail);

            //     session()->flash('message','Sei già registrato con questa mail sul nostro sito');
            //    return redirect('/login');

            }elseif(!$userGithubId) {
                $user = new User ;

                $user->name=$githubUser->nickname;
                $user->email=$githubUser->email;
                $user->password= Hash::make(Str::random(50));
                $user->github_id=$githubUser->id;
                $user->github_token=$githubUser->token;
                $user->github_refresh_token=$githubUser->refreshToken;
    
                $user->save();
    
                Auth::login($user);
      
    }

        return redirect('/nuovo/annuncio');
     
    
    }
}
