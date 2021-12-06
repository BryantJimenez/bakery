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
        $customers=User::with(['roles'])->role(['Cliente'])->orderBy('id', 'DESC')->get();
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
            $customer->assignRole('Cliente');

            // Move image to users folder and extract name
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $customer->slug, '/admins/img/users/');
                $customer->fill(['photo' => $photo])->save();
            }

            SendEmailRegister::dispatch($customer->slug);
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El cliente ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('customers.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $customer) {
        if (is_null($customer['roles']->where('name', 'Cliente')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'El usuario no es un cliente', 'msg' => 'Este usuario no es un cliente, tiene un rol diferente.']);
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
        if (is_null($customer['roles']->where('name', 'Cliente')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'El usuario no es un cliente', 'msg' => 'Este usuario no es un cliente, tiene un rol diferente.']);
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
        if (is_null($customer['roles']->where('name', 'Cliente')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'El usuario no es un cliente', 'msg' => 'Este usuario no es un cliente, tiene un rol diferente.']);
        }

        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'state' => request('state'));
        $customer->fill($data)->save();

        if ($customer) {
            $customer->syncRoles(['Cliente']);

            // Move image to users folder and extract name
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $photo=store_files($file, $customer->slug, '/admins/img/users/');
                $customer->fill(['photo' => $photo])->save();
            }

            return redirect()->route('customers.edit', ['customer' => $customer->slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido editado exitosamente.']);
        } else {
            return redirect()->route('customers.edit', ['customer' => $customer->slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        if (is_null($customer['roles']->where('name', 'Cliente')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'El usuario no es un cliente', 'msg' => 'Este usuario no es un cliente, tiene un rol diferente.']);
        }

        $customer->delete();
        if ($customer) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El cliente ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Cliente')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'El usuario no es un cliente', 'msg' => 'Este usuario no es un cliente, tiene un rol diferente.']);
        }

        $customer->fill(['state' => "0"])->save();
        if ($customer) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, User $customer) {
        if (is_null($customer['roles']->where('name', 'Cliente')->first())) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'El usuario no es un cliente', 'msg' => 'Este usuario no es un cliente, tiene un rol diferente.']);
        }
        
        $customer->fill(['state' => "1"])->save();
        if ($customer) {
            return redirect()->route('customers.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El cliente ha sido activado exitosamente.']);
        } else {
            return redirect()->route('customers.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
