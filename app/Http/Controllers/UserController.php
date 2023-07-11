<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Money;
use App\Invoice;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/login');

        // return view('admin.pages.user.index', $data);
    }

    public function userindex()
    {
        $users = User::all();

        $data = [
            'users' => $users,
        ];

        return view('admin.pages.user.index', $data);
    }
     public function user_list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            $search = $request->get('search');
            $searchValue = $search['value'] ?? null;
            $active = $request->get('is_active');

            $data->when(isset($searchValue), function ($query) use ($searchValue) {
                return $query->where('role_id' ,'<>', 0)
                    ->where(function($query)  use ($searchValue){
                        return $query->where('name', 'LIKE', '%' . $searchValue . '%')
                                    ->orWhere('email', 'LIKE', '%' . $searchValue . '%');
                });
                    
            });
            $data->where('role_id' ,"<>", 0);
            try {
                return datatables($data)
                ->addColumn('user_role', function (User $data) {
                    return $data->role->name;
                })
                  ->addColumn('action', function ($item) {
                        return '<div class="activity-icon">
                                    <ul style="list-style: none">
                                        <li><a id="delete" onclick="" data-user="' . $item->id . '" data-url="' . route('delete_user') . '" class=""><i class="mdi mdi-trash-can"></i></a></li>
                                        <li><a  href="' . route('edituser', $item->id) . '" class=""><i class="mdi mdi-grease-pencil"></i></a></li>
                                     </ul>
                                </div>';
                    })->rawColumns(['image','is_active', 'action'])->make(true);
            } catch (\Exception $e) {
                return new GeneralException($e);
            }
        }
        return view('admin.pages.user.index');
    }

    public function delete_user(Request $request)
    {
        $user=User::where('id',$request->id)->first();
        $user->delete();
        session()->flash('success', 'User has been deleted successfully!');
    }

    public function adduser(User $user)
    {
        $data = [
            'user' => $user,
        ];
        return view('admin.pages.user.adduser', $data);
    }

    public function newuser(Request $request)
    {
        $this->validate($request, [
            'name'=>['required','string'],
            'email'=>['required','email', Rule::unique('users','email')],
            'password'=>['string','min:6'],
        ]);
       
        $user=new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=Hash::make($request['password']);
        $user->role_id=$request->input('role_id');
        $user->date_birth=$request->input('date_birth');
        $user->date_employment=$request->input('date_employment');
        $user->save();
        return view('admin.pages.user.index');
    }

    public function edituser($id)
    {
        $user=User::find($id);
        // dd($user);
        return view('admin.pages.user.edit',[
            'user' => $user,
        ]);
    }
    public function updateuser($id,Request $request)
    { 
        $user=User::find($id);
        $this->validate($request, [
            'name'=>['required','string'],
            'email'=>['required','email',Rule::unique('users','email')->ignore($id, 'id')],
            'password'=>['string','min:6'],
        ]);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request['password']),
            'role_id' => $request->input('role_id'),
            'date_birth' => $request->input('date_birth'),
            'date_employment' => $request->input('date_employment'),
        ]);
       return view('admin.pages.user.index');
    }

    public function add_pyment(Request $request)
    { 
        $users=User::where('role_id',2)->get();
    
       
       return view('admin.pages.user.add_payment',[
        'users' => $users,
    ]);
    }
    public function save_payment(Request $request)
    { 
        $this->validate($request, [
            'user_id'=>['required'],
            'money'=>['required'],
 
        ]);
       
        $save_payment=new Money;
        $save_payment->user_id=$request->input('user_id');
        $save_payment->money=$request->input('money');
        $save_payment->save();
        return view('admin.pages.user.save_payment');
    }

    public function list(Request $request)
    { 
       
        $users=User::where('role_id',2)->get();
        $Invoices=Invoice::get();
        //  dd($Invoice);
        return view('admin.pages.user.list',[
            'Invoices' => $Invoices,
        ]);
    }

    public function invoice_information($id)
    { 
        $all_Invoice = Invoice::find($id);
        if ($all_Invoice) {
            $Invoices_name = explode(',', $all_Invoice->name);
            $Invoices_quantity = explode(',', $all_Invoice->quantity);
            $Invoices_price = explode(',', $all_Invoice->price);
            $Invoices_subtotal = explode(',', $all_Invoice->subtotal);
            return view('admin.pages.user.information', [
                'Invoices_name' => $Invoices_name,
                'Invoices_quantity' => $Invoices_quantity,
                'Invoices_price' => $Invoices_price,
                'Invoices_subtotal' => $Invoices_subtotal,
            ]);
        } else {
            'الفاتورة غير موجودة';
        }
    }
}
