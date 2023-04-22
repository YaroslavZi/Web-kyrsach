<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function getPage()
    {
        $title = 'Вход';

        return view('login', compact('title'));

    }
    public function load(Request $request)
    {

            $title = 'Админ панель';

            return view('adminpanel', compact('title'));

    }


    public function getColumns(Request $request)
    {
        // $query =  DB::select('SELECT column_name  FROM information_schema.columns  WHERE  table_name = ?', [$request->id]);
        $query =  Schema::getColumnListing($request->id);



        return $query;
    }

    public function getData(Request $request, $db)
    {

        $title = ucfirst($db);

        $query =   DB::table($db)->orderBy('id')->paginate(30);

        $columns =  Schema::getColumnListing($db);

        return view('viewdb', compact('query',  'columns', 'title'));

    }

    public function getUpdateData(Request $request)
    {

        $query =  DB::table( $request->db)->find($request->id);

        return $query;

    }

    public function adminAction(Request $request)
    {


        if($request->action == 'create') {
            DB::table($request->db)->insert([
                array_combine($request->input_header, $request->input_data)
            ]);
        }
        else if ($request->action == 'update') {
             DB::table($request->db)
            ->where('id', $request->update_id)
            ->update(array_combine($request->input_header, $request->input_data)
        );
        }
        else if ($request->action == 'remove') {
            DB::table($request->db)->where('id', $request->remove_id )->delete();

        }


    }

    public function editCarousel(Request $request){
        Log::debug($request);
        $fileName = time() . '.' . $request->file->getClientOriginalName();
        $request->file->move(public_path('imgs'), $fileName);

        // файлы выше сохраняются в папку, теперь нужно добавить их в бд, а в карусель пихать последнии 3-5 записи

        // Carousel::create([
        //     'imgs' => 'London to Paris',
        // ]);
    }


    public function signup(Request $request)
    {
         $user = User::create(['name' => 'Admin',
       'email' => 'admin@mysite.com',
        'password' =>bcrypt('qwerty228'),
        'role' => true
        ]);

    }

    public function login(LoginRequest $request )
    {


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Аутентификация успешна...

            return redirect('/');
        }

        else {
            return redirect('/adminlogin');
        }
    }

    public function logOut()
    {
        Session::flush();

        Auth::logout();

        return redirect('adminlogin');
    }




    /**
     * Handle response after user authenticated
     *
     * @param Request $request
     * @param Auth $user
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }



    public function uploadFiles(Request $request){
        $fileName = $request->file->getClientOriginalName();
        $request->file->move(public_path('imgs'), $fileName);

    }
}
