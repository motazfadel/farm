<?php

namespace App\Http\Controllers;
use App\User;
use App\Invoice;
use App\Money;
use App\Typeclass;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function create_invoice()
    {
        return view('admin.pages.service.create');
    }

    public function save_invoice(Request $request)
    {   
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
        $all_class_subtotal = [];
        if($request->subtotal!=null){
        foreach($request->subtotal as $subtotal_count)
        {
         array_push($all_class_subtotal,$subtotal_count);
        }
        }
        // 5
         $all_class_type = [];
         if($request->type !=null){
         foreach($request->type as $type_count)
         {
          array_push($all_class_type,$type_count);
         }
         }
       $Invoice=new Invoice;
       $Invoice->name =implode(',', $all_class);
       $Invoice->quantity =implode(',', $all_class_quantity);
       $Invoice->price =implode(',', $all_class_price);
       $Invoice->subtotal =implode(',', $all_class_subtotal);
       $Invoice->type =implode(',', $all_class_type);
       $Invoice->total=$request->input('total');
       $Invoice->user_id=$request->input('user_id');
       $Invoice->user_name=$request->input('user_name');
       $Invoice->save();
        // dd($all_class_type);
       for($i = 0; $i < count($all_class_price); $i++){
        $Invoice_type=new Typeclass;
        $Invoice_type->invoices_id =$Invoice->id;
       
        $Invoice_type->total=$request->input('total');
        $Invoice_type->user_id = $request->input('user_id');;
        $Invoice_type->type = $all_class_type[$i];
        $Invoice_type->name = $all_class[$i];
        $Invoice_type->quantity = $all_class_quantity[$i];
        $Invoice_type->price = $all_class_price[$i];
        $Invoice_type->subtotal = $all_class_subtotal[$i];
        $Invoice_type->save();
         }
      
         return redirect()->route('create_invoice')->withSuccess(__('تم إنشاء الفاتورة بنجاح'));
    //    Session::flash('success', 'تم إنشاء الفاتورة بنجاح',array('timeout' => 3000));
    //    return view('admin.pages.service.create');
    }
    public function receipt_money()
    {
        $user = auth()->user()->id;
        $Money=Money::where('user_id',$user)->get();
        // dd($Money);
        return view('admin.pages.service.information',[
            'Money' => $Money,
        ]);
    }

    public function edit_type($id)
    {
        // dd($id);
        $user = auth()->user()->id;
        $type_pament=Money::where('id',$id)->first();

        if($type_pament->type == 1) {
            return redirect()->back()->with('error', 'لقد تم استلام هذه الدفعة سابقا"');
        }

        $type_pament->type = $type_pament->type == 0 ? 1 : 0;
        $type_pament->save();
        $Money=Money::where('user_id',$user)->get();

        return response()->json(['success' => true, 'message' => __('labels.leads.lead_interest_successfully')]);
    }
    
    public function material_delivery()
    {
        $user = auth()->user()->id;
        $Invoices = Typeclass::where('user_id',$user)->get();
        $users=User::where('role_id',3)->get();

        // dd($Invoices);
        return view('admin.pages.service.material_delivery',[
            'Invoices' => $Invoices,
             'users' => $users,
        ]);
    }




    public function material(Request $request,$id)
    {
        // dd($request);
        $type_pament = Typeclass::where('id',$id)->first();
        if($type_pament->type == 1) {
            return redirect()->back()->with('error', 'لقد تم استلام هذه الدفعة سابقا"');
        }
        $type_pament->type = $type_pament->type == 0 ? 1 : 0;
        $type_pament->receiver_id = $request->user;
        $type_pament->type2 = $type_pament->type;
        $type_pament->save();
        return response()->json(['success' => true, 'message' => __('labels.leads.lead_interest_successfully')]);
    }

    public function material_receiver()
    {
        $user = auth()->user()->id;
        $Invoices = Typeclass::where('receiver_id',$user)->get();
        return view('admin.pages.service.material_receiver',[
            'Invoices' => $Invoices,
        ]);
    }

    public function receiver(Request $request,$id)
    {
        // dd($request);
        $user =auth()->user()->id;
        $type_pament = Typeclass::where('id',$id)->first();
        if($type_pament->type2 == 2) {
            return redirect()->back()->with('error', 'لقد تم استلام هذه الدفعة سابقا"');
        }
        $type_pament->type2 = $type_pament->type2 == 1 ? 2 : 1;
        $type_pament->receiver_id = $user;
        // $type_pament->type2 = $type_pament->type;
        $type_pament->save();
        return response()->json(['success' => true, 'message' => __('labels.leads.lead_interest_successfully')]);
    }

    
}
