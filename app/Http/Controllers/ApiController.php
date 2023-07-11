<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Money;
use App\Invoice;
use App\Typeclass;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoecdetaelsResource;

class ApiController extends Controller
{   
    // تسجيل الدخول
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
            'role_id' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ], 400);
        }
        $user = User::where('email',$request->email)->where('role_id',$request->role_id)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'success' => false,
                'message' => 'information not correct.'
            ], 400);
        }
        if($user->role_id == 0 || $user->role_id == 1){
            $token = $user->createToken('myapptoken')->accessToken;
            $response = [
                'success' => true,
                'message' => "User logged in successfully.",
                "data" => array(
                    'token' =>  $token,
                    'details' => $user,
                    'boss' => "boss"
                )
            ];
            return response($response, 201);
        }else if($user->role_id == 2){
            $token = $user->createToken('myapptoken')->accessToken;
            $response = [
                'success' => true,
                'message' => "User logged in successfully.",
                "data" => array(
                    'token' =>  $token,
                    'details' => $user,
                    'Officer' => "Officer"
                )
            ];
            return response($response, 201);
        }
         else if($user->role_id == 3){
            $token = $user->createToken('myapptoken')->accessToken;
            $response = [
                'success' => true,
                'message' => "User logged in successfully.",
                "data" => array(
                    'token' =>  $token,
                    'details' => $user,
                    'material' => "material"
                )
            ];
            return response($response, 201);
        }
        else{
            $response = [
                'error' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
    //إضافة موظف
    public function add_employee(Request $request){
        $user = Auth::guard('api')->user();
        if($user->role_id == 0 || $user->role_id == 1){
        $validator = Validator::make($request->all(), [
            'name'=>['required','string'],
            'email'=>['required','email', Rule::unique('users','email')],
            'password'=>['string','min:6'],
            'role_id'=>['required'],
            'date_birth'=>['required'],
            'date_employment'=>['required'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ], 400);
        }
        $user=new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=Hash::make($request['password']);
        $user->role_id=$request->input('role_id');
        $user->date_birth=$request->input('date_birth');
        $user->date_employment=$request->input('date_employment');
        $user->save();
        $response = [
            'success' => true,
            'message' => "The employee has been added successfully.",
            "data" => $user,
       
        ];
        return response($response, 201);
        }else{
            $response = [
                'success' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
    //تعديل موظف
    public function edit_employee(Request $request){
        $user = Auth::guard('api')->user();
        if($user->role_id == 0 || $user->role_id == 1){
        $edit_employee = User::findOrFail($request->input('id'));
        $edit_employee->update([
            'name' =>$request->name ? $request->name : $edit_employee->name,
            'email' =>$request->email ? $request->email : $edit_employee->email,
            'password' =>$request->password ? $request->password : $edit_employee->password,
            'role_id' =>$request->role_id ? $request->role_id : $edit_employee->role_id,
            'date_birth' =>$request->date_birth ? $request->date_birth : $edit_employee->date_birth,
            'date_employment' =>$request->date_employment ? $request->date_employment : $edit_employee->date_employment,
        ]);
        $response = [
            'success' => true,
            'message' => "The employee has been updat successfully.",
            "data" => $edit_employee,
            
        ];
        return response($response, 201);
        }else{
            $response = [
                'success' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
     //حذف موظف
     public function delet_employee(Request $request){
        $user = Auth::guard('api')->user();
        if($user->role_id == 0 || $user->role_id == 1){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ], 400);
        }
        $edit_employee = User::findOrFail($request->input('id'));
        $edit_employee->delete();
        $response = [
            'success' => true,
            'message' => "The employee has been delet successfully.",
        ];
        return response($response, 201);
        }else{
            $response = [
                'error' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
    // عرض كل الموظفين
    public function view_staff()
    {
        $user = Auth::guard('api')->user();
        if($user->role_id == 0 || $user->role_id == 1){
        $view_staff = User::all();
        $response = [
            'success' => true,
            'message' => "All employees have been successfully displayed.",
            'data' => $view_staff,
        ];
        return response($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
    // إضافة دفعة مالية
    public function add_new_pyment(Request $request) {
        $user = Auth::guard('api')->user();

        if($user->role_id == 0 || $user->role_id == 1){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'money' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ], 400);
        }
        $save_payment=new Money;
        $save_payment->user_id=$request->input('user_id');
        $save_payment->money=$request->input('money');
        $save_payment->save();
        $response = [
            'success' => true,
            'message' => "Payment has been added successfully.",
            'data' => $save_payment,
        ];
        return response($response, 200);
    } else{    
        $response = [
            'error' => false,
            'message' => "You do not have the permissions to perform this operation",
        ];
        return response($response, 400);
    }      
    }

    public function view_reports(Request $request) {
        $user = Auth::guard('api')->user();
        if($user->role_id == 0 || $user->role_id == 1){
        $Invoices = Invoice::get();
        if($Invoices->isEmpty()){
            $response = [
                'error' => false,
                'message' => "no Invoices.",
                'data' => [],

            ];
            return response($response, 400);
        }else{
            $Invoices = Typeclass::get();
            // dd($Invoices);
            $response = [
                'success' => true,
                'message' => "The reports have been displayed successfully.",
                'data' => InvoiceResource::make($Invoices),

            ];
            return response($response, 200);
        }
    }
    }

    public function invoice_details(Request $request) {
        $user = Auth::guard('api')->user();
        if($user->role_id == 0 || $user->role_id == 1){
        $Invoices = Typeclass::find($request->id);
        if($Invoices){
            $Invoices = Typeclass::find($request->id);
            $response = [
                'success' => true,
                'message' => "The reports have been displayed successfully.",
                'data' => InvoecdetaelsResource::make($Invoices),
            ];
            return response($response, 200);
        }else{
            $response = [
                'error' => false,
                'message' => "no Invoices.",
                'data' => [],
            ];
            return response($response, 400);
        }
        }
    }


    //مدير المشتريات
    public function View_money_transfers()
    {
        $user = Auth::guard('api')->user();
        if($user->role_id == 2){
        $user = Auth::guard('api')->user()->id;
        $Money=Money::where('user_id',$user)->get();
        // dd($Money);
        $response = [
            'success' => true,
            'message' => "The Receipt of money have been displayed successfully.",
            'data' => $Money,
        ];
        return response($response, 200);
    }else{
            $response = [
                'error' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
    //تغيير الحالة
    public function edit_type1(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user->role_id == 2){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ], 400);
        }
        $user = Auth::guard('api')->user()->id;
        $Money=Money::where('id',$request->id)->first();
        // dd($Money);
        if($Money->type == 0){
        $Money->update([
            'type' => 1,
        ]);
        $response = [
            'success' => true,
            'message' => "Transfer status modified successfully.",
            'data' => $Money,
        ];
        return response($response, 200);
        }else{
        $response = [
            'error' => false,
            'message' => "This payment has already been received.",
        ];
        return response($response, 400);
        }
        }else{
            $response = [
                'error' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }

    //عرض الاصناف
    public function Show_items(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user->role_id == 2){
        $type_pament = Typeclass::where('user_id',$user->id)->get();
        $response = [
            'success' => true,
            'message' => "The list of items has been displayed successfully..!",
            'data' => $type_pament,
        ];
        return response($response, 200);
        }else{
            $response = [
                'error' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }

     //تغيير حالة الصنف
     public function edit_type_class(Request $request)
     {  $validator = Validator::make($request->all(), [
        'receiver_id'=>['required'],
        'id'=>['required'],
    ]);
    if ($validator->fails()) {
        return response()->json([
            'error' => false,
            'message' => 'Please see errors parameter for all errors.',
            'errors' => $validator->errors()
        ], 400);
    }
         $user = Auth::guard('api')->user();
         if($user->role_id == 2){
         $user = Auth::guard('api')->user()->id;
         $Money=Typeclass::where('id',$request->id)->first();
         // dd($Money);
         if($Money->type == 0){
         $Money->update([
             'type' => 1,
             'receiver_id' =>$request->receiver_id,
             'type2'=> 1,
         ]);
         $response = [
             'success' => true,
             'message' => "This item has already been delivered..!",
             'data' => $Money,
         ];
         return response($response, 200);
         }else{
         $response = [
             'error' => false,
             'message' => "This payment has already been received.",
         ];
         return response($response, 400);
         }
         }else{
             $response = [
                 'error' => false,
                 'message' => "You do not have the permissions to perform this operation",
             ];
             return response($response, 400);
         }
     }
     
     public function creat_invoice(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ], 400);
        }
         $user = Auth::guard('api')->user();
         if($user->role_id == 2){

        // 1
        $all_class = [];
        if($request->name!=null){
        foreach($request->name as $name_class)
        {
         array_push($all_class,$name_class);
        }
        }
        // 2
        $all_class_quantity = [];
        if($request->quantity!=null){
        foreach($request->quantity as $quantity_count)
        {
         array_push($all_class_quantity,$quantity_count);
        }
        }
        // 3
        $all_class_price = [];
        if($request->price!=null){
        foreach($request->price as $price_count)
        {
         array_push($all_class_price,$price_count);
        }
        }

        // 4
        $subtotal = 0;
        for ($i = 0; $i < count($all_class); $i++) {
          $subtotal += $all_class_quantity[$i] * $all_class_price[$i];
        }

       $Invoice=new Invoice;
       $Invoice->name =implode(',', $all_class);
       $Invoice->quantity =implode(',', $all_class_quantity);
       $Invoice->price =implode(',', $all_class_price);
       $Invoice->subtotal = $subtotal;
       $Invoice->total = $subtotal;
       $Invoice->type = 0;
       $Invoice->user_id= Auth::guard('api')->user()->id;
       $Invoice->user_name= Auth::guard('api')->user()->name;
       $Invoice->save();

       for($i = 0; $i < count($all_class); $i++){
        $Invoice_type=new Typeclass;
        $Invoice_type->invoices_id =$Invoice->id;
        $Invoice_type->total=$subtotal;
        $Invoice_type->user_id = Auth::guard('api')->user()->id;
        $Invoice_type->type = 0;
        $Invoice_type->name = $all_class[$i];
        $Invoice_type->quantity = $all_class_quantity[$i];
        $Invoice_type->price = $all_class_price[$i];
        $Invoice_type->subtotal = $subtotal;
        $Invoice_type->save();
         }
         $response = [
             'success' => true,
             'message' => "The list of items has been displayed successfully..!",
             'data' => $Invoice,
         ];
         return response($response, 200);
         }else{
             $response = [
                 'error' => false,
                 'message' => "You do not have the permissions to perform this operation",
             ];
             return response($response, 400);
         }
     }


    //مستلم مواد  3 // 
    public function View_products(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user->role_id == 3){
        $type_pament = Typeclass::where('receiver_id',$user->id)->get();
        $response = [
            'success' => true,
            'message' => "The list of items has been displayed successfully..!",
            'data' => $type_pament,
        ];
        return response($response, 200);
        }else{
            $response = [
                'error' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
    //تغيير حالة الصنف
    public function edit_type_products(Request $request)
    { 
        $user = Auth::guard('api')->user();
        if($user->role_id == 3){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ], 400);
        }
        $user = Auth::guard('api')->user()->id;
        $Money=Typeclass::where('id',$request->id)->first();
        // dd($Money);
        if($Money->type2 == 1){
        $Money->update([
            'type2'=> 2,
        ]);
        $response = [
            'success' => true,
            'message' => "This item has already been delivered..!",
            'data' => $Money,
        ];
        return response($response, 200);
        }else{
        $response = [
            'error' => false,
            'message' => "This payment has already been received.",
        ];
        return response($response, 400);
        }
        }else{
            $response = [
                'error' => false,
                'message' => "You do not have the permissions to perform this operation",
            ];
            return response($response, 400);
        }
    }
    //general
    public function logout_employee() {
        $user=Auth::guard('api')->user()->token()->revoke();
        return response()->json(['message' => 'User successfully signed out']);
    }

    public function dd(Request $request){
        dd(1);
    }

}
