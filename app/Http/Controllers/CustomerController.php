<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', [
            'items' => $customers,
            'title' => 'Customers',
            'resourceName' => 'customers'
        ]);
    }

    public function create()
    {
        return view('customers.create', [
            'title' => 'Create Customer',
            'resourceName' => 'customers'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255'
        ]);

        Customer::create($request->only('name', 'phone', 'email'));

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'item' => $customer,
            'title' => 'Edit Customer',
            'resourceName' => 'customers'
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255'
        ]);

        $customer->update($request->only('name', 'phone', 'email'));

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }
}
