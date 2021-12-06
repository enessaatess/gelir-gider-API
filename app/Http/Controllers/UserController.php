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
            return ["status" => "success"];
        }
  
        return ["status" => "failed"];
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
         
        return ["status" => "success"];
    }

    public function userInfo()
    {
        if(Auth::check())
        {
            return ["status" => "success","user" => Auth::user()];
        }else{
            return ["status" => "rejected", "user" => false];
        }
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
  
        return ["status" => "success"];
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
        
        return ["status" => "success"];
    }
    public function viewCategory(){
        return Category::where('user_id', Auth::id())->get();
    }

    public function viewTransaction(){

        $currency = Transaction::where('user_id', Auth::id())->with("category","currency")->get();
        return $currency;
    }

    public function currency(){

        return Currency::all();
    }

    public function createTransaction(Request $request){

        $request->validate([
            'total' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'transaction_date' => 'required|date',
        ]);

        $userId = Auth::id(); 
        
        $transaction = new Transaction();
        $transaction->total = $request->total;
        $transaction->transaction_date = (new \Carbon\Carbon($request->transaction_date))->format("Y-m-d");
        $transaction->description = $request->description;
        $transaction->user_id = $userId;
        $transaction->currency_id = $request->currency_id;
        $transaction->category_id = $request->category_id;
        $transaction->save();

        return ["status" => "success"];

    }
    public function edit($id) {
        $userId = Auth::id();
        
        $transaction = Transaction::where('id', $id)->where('user_id', $userId)->get();
      
        $currency = Currency::all();
        $categories = Category::where('user_id', $userId)->get();
      
        return view('transaction', compact('transaction','currency','categories'));
      }
      
      public function updateTransaction(Request $request) {
      
        $transaction = Transaction::find($request->id);

        $transaction->total = $request->total;
        $transaction->transaction_date = (new \Carbon\Carbon($request->transaction_date))->format("Y-m-d");
        $transaction->description = $request->description;
        $transaction->user_id = $userId;
        $transaction->currency_id = $request->currency;
        $transaction->category_id = $request->category;
        $transaction->update();
      
        return ["status" => "success"];
      }
      
      public function destroy(Request $request) {
        $transaction = Transaction::findOrFail($request->id);
        $transaction->delete();
      
        return ["status" => "success"];
      }
      public function viewPriceDetails(Request $request) {

        $userId = Auth::id();

        $startdate = (new \Carbon\Carbon($request->startdate))->format("Y-m-d");
        $enddate = (new \Carbon\Carbon($request->enddate))->format("Y-m-d");

        $selectDate = Transaction::whereBetween('transaction_date', [$startdate, $enddate])->where('user_id',$userId)->get();
        $gelir = 0;
        $gider = 0;
        foreach($selectDate as $date){
            $categories = Category::where('user_id', $userId)->where('id', $date->category_id)->get();
            foreach($categories as $category){
                $currencies = Currency::where('id', $date->currency_id)->get();
                if($category->category_select == "gelir"){
                    foreach($currencies as $currency){
                        $gelir += ($date->total)*($currency->price);
                    }
                } else {
                    foreach($currencies as $currency){
                        $gider += ($date->total)*($currency->price);
                    }
                }
            }
            
        }
        $total = $gelir - $gider;

        return ["result" => $total];
    }
}
