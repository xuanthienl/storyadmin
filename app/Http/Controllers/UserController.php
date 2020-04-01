<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\SendMail;
// use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //LOGIN
    public function login() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function postlogin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->where('password', $request->password)->first();
        if($user){
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return back()->with('thongbao', 'Bạn đã nhập sai Username hoặc Password!');
        
        // CÁCH Auth::attempt NÀY CHỈ DÙNG ĐƯỢC KHI PASSWORD ĐƯỢC MÃ HÓA BẰNG HÀM bcrypt()
        // $credentials = $request->only('username', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect()->route('dashboard');
        // }
    }

    //LOGOUT OUT
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    //REGISTER
    public function register() {
        return view('register');
    }

    public function postregister(Request $request) {
        $request->validate(
            [
            'username' => 'required|alpha_dash|regex:/^[a-zA-Z0-9_]+$/u|max:50|min:5|unique:tbl_users',
            // alpha_dash ĐỂ BẮT BUỘC username PHẢI KO CÓ KHOẢNG TRẮNG
            // regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/ ĐỂ LẠI BỎ NHỮNG KÝ TỰ KHÔNG HỢP LỆ
            'email' => 'required|email:rfc,dns|max:100|unique:tbl_users',
            // email:rfc,dns ĐỂ BẮT BUỘC Ô email PHẢI LÀ 1 EMAIL HỢP LỆ
            'password' => 'required'
            ],
            [
                'required' => ':attribute không được để trống.',
                'alpha_dash'=> ':attribute không được có khoảng trắng.',
                'min' => ':attribute Không được nhỏ hơn :min',
                'email' => ':attribute phải là một Email hợp lệ.',
                'regex' => ':attribute định dạng không hợp lệ.',
                'max' => ':attribute Không được lớn hơn :max',
                'integer' => ':attribute Chỉ được nhập số',
                'unique' => ':attribute đã tồn tại ! Vui lòng chọn một :attribute khác ^^.',
            ], 
            [
                'username' => 'Username',
                'email' => 'Email',
                'password' => 'Password'
            ]
        );

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('login');
    }

    //CRUD USER
    public function index() {
        $user = User::withTrashed()->paginate(10);
        return view('user.index_user', ['users'=>$user]);
    }
    public function destroy($id) {
        User::destroy($id);
        return redirect()->route('user.index');
    }
    public function edit($id) {
        $user = User::where('id', $id)->first();
        return view('user.edit_user', ['user' => $user]);
    }
    public function update(Request $request, $id) {
        

        $user = User::find($id);

        //HOẠT ĐỘNG:
        // - LẦN 1: NẾU VÀO EDIT MÀ KO CHỈNH SỬA GÌ CẢ NHƯNG LẠI CLICK VÀO NÚT BUTTON (update) -> THÌ TRỞ LẠI TRANG user.index MÀ KHÔNG LÀM GÌ CẢ, KO update
        // - LẦN 2: KHI DỮ LIỆU BỊ THAY ĐỔI:
        //  + NẾU RỖNG: Ô INPUT ĐÓ BỊ XÓA VALUE ĐI, TỨC LÀ BỊ RỖNG --> THÌ CŨNG KO UPDATE HAY LÀM GÌ Ở Ô ĐÓ CẢ
        //  + NẾU KHÔNG RỖNG: KIỂM TRA XEM DỮ LIỆU CÓ HỢP LỆ KO
    
        if(isset($_POST['submit']) && $request->username === $user->username && $request->email === $user->email) {
            return redirect()->route('user.index');
        }
        else {

            //KIỂM TRA USERNAME
            if(empty($request->username)) {
                
            } 
            elseif($request->username != $user->username) {
            //     $request->validate(
            //         [
            //         'username' => 'unique:tbl_users'
            //         ],
            //         [
            //             'unique' => ':attribute đã tồn tại. Vui lòng chọn một :attribute khác !'
            //         ],
            //         [
            //             'username' => 'Username'
            //         ]
            //     );
            //     $user->username = $request->username;
            // } 
            // else {
                $request->validate(
                    [
                    'username' => 'alpha_dash|max:50|min:5|regex:/^[a-zA-Z0-9_]+$/u|unique:tbl_users',
                    // alpha_dash ĐỂ BẮT BUỘC username PHẢI KO CÓ KHOẢNG TRẮNG
                    // regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/ ĐỂ LẠI BỎ NHỮNG KÝ TỰ KHÔNG HỢP LỆ
                    ],
                    [
                        'alpha_dash'=> ':attribute không được có khoảng trắng.',
                        'min' => ':attribute Không được nhỏ hơn :min',
                        'email' => ':attribute phải là một Email hợp lệ.',
                        'regex' => ':attribute định dạng không hợp lệ.',
                        'max' => ':attribute Không được lớn hơn :max',
                        'integer' => ':attribute Chỉ được nhập số',
                        'unique' => ':attribute đã tồn tại. Vui lòng chọn một :attribute khác !',
                    ], 
                    [
                        'username' => 'Username',
                        'email' => 'Email',
                    ]
                );

                $user->username = $request->username;
            }
            
            //KIỂM TRA EMAIL
            if(empty($request->email)) {
            }
            elseif($request->email != $user->email) {
            //     $request->validate(
            //         [
            //             'email' => 'unique:tbl_users'
            //         ],
            //         [
            //             'unique' => ':attribute đã tồn tại. Vui lòng chọn một :attribute khác !'
            //         ],
            //         [
            //             'email' => 'Email'
            //         ]
            //     );
            //     $user->email = $request->email;
            // }
            // else {
                $request->validate(
                    [
                    'email' => 'email:rfc,dns|max:100|unique:tbl_users',
                    // email:rfc,dns ĐỂ BẮT BUỘC Ô email PHẢI LÀ 1 EMAIL HỢP LỆ
                    ],
                    [
                        'alpha_dash'=> ':attribute không được có khoảng trắng.',
                        'min' => ':attribute không được nhỏ hơn :min',
                        'email' => ':attribute phải là một Email hợp lệ.',
                        'regex' => ':attribute định dạng không hợp lệ.',
                        'max' => ':attribute không được lớn hơn :max',
                        'integer' => ':attribute chỉ được nhập số',
                        'unique' => ':attribute đã tồn tại. Vui lòng chọn một :attribute khác !',
                    ], 
                    [
                        'username' => 'Username',
                        'email' => 'Email',
                    ]
                );

                $user->email = $request->email;
            }
            //KIỂM TRA NẾU INPUT RỖNG THÌ KO LÀM GÌ, INPUT KO RỖNG THÌ LƯU GIÁ TRỊ ĐÓ
            $user->update();
            return redirect()->route('user.index');
        }
    }
    public function restore($id) {
        User::where('id', $id)->restore();
        return redirect()->route('user.index');
    }
    public function forcedelete($id) {
        User::where('id', $id)->forceDelete();
        return redirect()->route('user.index');        
    }

    //EDIT PROFILE (EDIT THÔNG TIN CÁ NHÂN ĐANG ĐĂNG NHẬP)
    public function edit_profile() {
        $user = Auth::user();
        return view('user.edit_profile', ['user'=>$user]);
    }
    //UPDATE PROFILE
    public function update_profile(Request $request) {
        $user = Auth::user();

        $mail = $user->email;

        $request->validate(
            [
            'username' => 'alpha_dash|max:50|min:5|regex:/^[a-zA-Z0-9_]+$/u',
            'email' => 'email:rfc,dns|max:100',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
            ]
            // XEM thêm: 'c_password' => 'required|same:password
            ],
            [
                'alpha_dash'=> ':attribute không được có khoảng trắng.',
                'required' => ':attribute không được để trống',
                'min' => ':attribute không được nhỏ hơn :min',
                'email' => ':attribute phải là một Email hợp lệ.',
                'regex' => ':attribute định dạng không hợp lệ.',
                'regex:/[a-z]/' => ':attribute phải có ít nhất một chữ thường',
                'regex:/[A-Z]/' => ':attribute phải có ít nhất một chữ viết hoa',
                'regex:/[0-9]/' => ':attribute phải có ít nhất một số',
                'max' => ':attribute không được lớn hơn :max',
                'integer' => ':attribute chỉ được nhập số',
                'unique' => ':attribute đã tồn tại. Vui lòng chọn một :attribute khác !',
                'confirmed' => ':attribute không khớp.'
            ], 
            [
                'username' => 'Username',
                'email' => 'Email',
                'password' => 'Password'
            ]
        );

        if(Auth::user()->email == $request->email && Auth::user()->password == $request->password && Auth::user()->username == $request->username) {
            $request->session()->flash('done', 'The information is a duplicate of your account. If you need to change, go back and fill out another information!');
            return redirect()->route('dashboard');
        }
        else {

        $user->password = $request->password;

        //EMAIL
        if(Auth::user()->email == $request->email) {

        }
        elseif(isset($request->email) && strlen($request->email) > 0) {
            $request->validate(
                [
                    'email' => 'unique:tbl_users',
                ],
                [
                    'unique' => ':attribute đã tồn tại. Vui lòng chọn một :attribute khác !',
                ], 
                [
                    'email' => 'Email',
                ]
            );
            $user->email = $request->email;
        }
        // elseif(empty($request->email)) {
        //     $user->email = Auth::user()->email;
        // }
        else {
            $user->email = $request->email;
        }

        //USERNAME
        if(Auth::user()->username == $request->username) {

        }
        elseif(isset($request->username) && strlen($request->username) > 0) {
            $request->validate(
                [
                    'username' => 'unique:tbl_users',
                ],
                [
                    'unique' => ':attribute đã tồn tại. Vui lòng chọn một :attribute khác !',
                ], 
                [
                    'username' => 'Username',
                ]
            );
            $user->username = $request->username;
        }
        // elseif(empty($request->username)) {
        //     $user->username = Auth::user()->username;
        // }
        else {
            $user->username = $request->username;
        }
        $request->session()->flash('updateprofile', 'Your information has just been changed!');
        $user->save();

        Mail::to($user->email)->send(new SendMail($user->username, $user->email, $user->password, $mail));
        }
        // CHẠY php artisan config:cache trong env khi cấu hình tk gửi mail xong
        return redirect()->route('dashboard');
    }
}    
