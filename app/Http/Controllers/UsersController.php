<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['store', 'index', 'profile'],
        ]);
    }

    public function index()
    {
        $users = User::orderBy('solved', 'desc')->orderBy('submit', 'ASC')->paginate(20);

        return response()->json($users);
    }

    public function profile(Request $request, string $username = '')
    {
        if ($request->wantsJson()) {
            $user = Auth::User();
            
            if (!empty($username)) {
                $user = User::where('username', $username)->get()->first();
            }

            if (!$user) {
                abort(404);
            }


            $user->topics;
            return response()->json($user);
        } else {
            abort(404);
        }
    }

    public function store(UserRequest $request)
    {
        $this->validate($request, ['username' => 'required|max:50|unique:users',]);

        $user = User::create([
            'username' => $request->username,
            'nickname' => $request->nickname,
            'school' => $request->school,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'last_login_ip' => $request->ip(),
            'avatar' => $this->regenerate_avatar($request->nickname),
        ]);

        $this->sendEmailConfirmationTo($user);
        Auth::login($user);
        
        return response()->json(['message' => 'Register success.'], 200);
    }

    public function update(User $user, UserRequest $request, ImageUploadHandler $uploader)
    {
        if (Auth::user()->id != $user->id) {
            abort(403);
        }

        $data = [];
        $data['nickname'] = $request->nickname;
        $data['school'] = $request->school;
        
        if ($request->email) {
            $user->activation_token = Str::random(10);
            $user->activated = false;
            $data['email'] = $request->email;
        }

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->avatar) {
            $data['avatar'] = $request->avatar;
        }

        if ($request->regenerate_avatar == 'true') {
            $data['avatar'] = $this->regenerate_avatar($request->nickname);
        }


        $user->update($data);
        if($request->email){
            $this->sendEmailConfirmationTo($user);
        }
        Auth::login($user);
        

        return response()->json('Update user profile success.');
    }

    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id) {
            abort(403);
        }

        $user->delete();

        return response()->json("Delete user success.");
    }

    function regenerate_avatar(string $nickname)
    {
        $avatar_path = '/uploads/images/avatars/' . uniqid() . '.png';
        \Avatar::create($nickname)->setShape('square')->setDimension(200, 200)->setFontSize(99)
            ->save(public_path() . $avatar_path);
        return $avatar_path;
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'acm@cugb.edu.cn';
        $name = 'ACM';
        $to = $user->email;
        $subject = "感谢注册 CUGBOJ！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        return redirect('');
    }
}
