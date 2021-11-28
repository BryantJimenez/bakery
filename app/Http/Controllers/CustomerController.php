<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailRegister;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $customers=User::with(['roles'])->role(['Customer'])->orderBy('id', 'DESC')->get();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request) {
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'email' => request('email'), 'password' => Hash::make(request('password')));
        $customer=User::create($data);

        if ($customer) {
            $customer->assignRole('Customer');

            // Move image to users folder and extract name
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $customer->slug, '/admins/img/users/');
                $customer->fill(['photo' => $photo])->save();
            }

            SendEmailRegister::dispatch($customer->slug);
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful registration', 'msg' => 'The user has been successfully registered.']);
        } else {
            return redirect()->route('customers.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed registration', 'msg' => 'An error occurred during the process, please try again.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'User is not a customer', 'msg' => 'This user is not a customer, he has a different role.']);
        }
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'User is not a customer', 'msg' => 'This user is not a customer, he has a different role.']);
        }
        return view('admin.customers.edit', compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'User is not a customer', 'msg' => 'This user is not a customer, he has a different role.']);
        }

        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'state' => request('state'));
        $customer->fill($data)->save();

        if ($customer) {
            $customer->syncRoles(['Customer']);

            // Move image to users folder and extract name
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $customer->slug, '/admins/img/users/');
                $customer->fill(['photo' => $photo])->save();
            }

            return redirect()->route('customers.edit', ['customer' => $customer->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The customer has been edited successfully.']);
        } else {
            return redirect()->route('customers.edit', ['customer' => $customer->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $customer)
    {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'User is not a customer', 'msg' => 'This user is not a customer, he has a different role.']);
        }

        $customer->delete();
        if ($customer) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful removal', 'msg' => 'The customer has been successfully removed.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed deletion', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function deactivate(Request $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'User is not a customer', 'msg' => 'This user is not a customer, he has a different role.']);
        }

        $customer->fill(['state' => "0"])->save();
        if ($customer) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The customer has been successfully deactivated.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }

    public function activate(Request $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Customer')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'User is not a customer', 'msg' => 'This user is not a customer, he has a different role.']);
        }
        
        $customer->fill(['state' => "1"])->save();
        if ($customer) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Successful editing', 'msg' => 'The customer has been successfully activated.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Failed edit', 'msg' => 'An error occurred during the process, please try again.']);
        }
    }
}
