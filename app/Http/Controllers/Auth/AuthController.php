<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\Mentor;
use Validator;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'edit', 'update', 'picture', 'show']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'picture' => 'default.png',
            'password' => bcrypt($data['password']),
        ]);

        if($data['type'] == "student"){
            $student = Student::create([
                'affiliation' => $data['affiliation'],
                'grade' => $data['grade'],
                'field' => $data['phone'],
                'project_id' => ($data['project_id'] != "" ) ? $data['project_id'] : null,
            ]);
            $student->user()->save($user);
        }else{
            $mentor = Mentor::create([
                'domain' => $data['domain'],
            ]);
            $mentor->user()->save($user);
        }
        return $user;
    }

    public function show(){

    }

    public function edit(){
        return view('profile.edit');
    }

    public function picture(Request $data){
        $filename = '';
        if ($data->hasFile('media')) {
            if ($data->file('media')->isValid()) {
                $dest = 'uploads/img/profile_pics/';
                $ext = $data->file('media')->getClientOriginalExtension();
                $filename = ucfirst(Auth::user()->first_name) . ucfirst(Auth::user()->last_name) . '-' . Carbon::now()->timestamp . '.' . $ext;
                $data->file('media')->move($dest, $filename);

                Auth::user()->picture = $filename;
                Auth::user()->save();
            }
        }
       return redirect('dashboard');

    }

    public function update(Request $data){
        $u = Auth::user();
        $u->update([
            'first_name' => $data->input('first_name'),
            'last_name' => $data->input('last_name'),
            'phone' => $data->input('phone'),
        ]);

        return redirect('dashboard');
    }

}
