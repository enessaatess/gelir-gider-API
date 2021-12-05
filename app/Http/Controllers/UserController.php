<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function register()
    {
        return view('register');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'surname' => $data['surname'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function createCategory(Request $request){
        $request->validate([
            'name' => 'required',
            'category_select' => 'required',
        ]);
        $userId = Auth::id(); 
        
        $category = new Category();
        $category->name = $request->name;
        $category->category_select = $request->category_select;
        $category->user_id = $userId;
        $category->save();
        
        return redirect('category');
    }
    public function viewCategory(){
        return view('register');
    }

    public function viewTransaction(){

        $userId = Auth::id(); 
        $currency = Currency::all();
        $categories = Category::where('user_id', $userId)->get();
        return view('register', compact('currency','categories'));
    }

    public function createTransaction(Request $request){

        $request->validate([
            'total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'date' => 'required|date',
        ]);

        $userId = Auth::id(); 
        
        $transaction = new Transaction();
        $transaction->total = $request->total;
        $transaction->transaction_date = $request->date;
        $transaction->description = $request->description;
        $transaction->user_id = $userId;
        $transaction->currency_id = $request->currency;
        $transaction->category_id = $request->category;
        $transaction->save();

        return redirect('transaction');

    }

    public function edit($id) {
        $userId = Auth::id();
        
        $transaction = Transaction::where('id', $id)->where('user_id', $userId)->get();
        
        if($userId == $transaction->user_id) {
            return "burada";
        }
        else {
            return "else de";
        }
        $currency = Currency::all();
        $categories = Category::where('user_id', $userId)->get();

        return view('transaction', compact('transaction','currency','categories'));
    }

    public function update($id) {

        $transaction = Transaction::find($id);
        $userId = Auth::id();

        $transaction->total = $request->total;
        $transaction->transaction_date = $request->date;
        $transaction->description = $request->description;
        $transaction->user_id = $userId;
        $transaction->currency_id = $request->currency;
        $transaction->category_id = $request->category;
        $transaction->update();

        return redirect('transaction');
    }

    public function destroy($id) {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect('/transaction');
    }
}
