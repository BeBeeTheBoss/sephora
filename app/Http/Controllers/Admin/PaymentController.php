<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function __construct(protected Payment $model) {}

    public function index()
    {
        $payments = $this->model->get();
        return Inertia::render('Admin/Payment/Index', ['payments' => $payments]);
    }

    public function create()
    {
        return Inertia::render('Admin/Payment/Create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $this->model->create($data);
        return to_route('payments.index');
    }

    public function edit($id)
    {
        $payment = $this->model->find($id);
        return Inertia::render('Admin/Payment/Edit', ['payment' => $payment]);
    }

    public function update(Request $request)
    {
        $payment = $this->model->find($request->id);
        if ($request->name) {
            $data = $request->validate([
                'name' => 'required'
            ]);
            $payment->update($data);
        }
        return to_route('payments.index');
    }

    public function toggleSwitch(Request $request){
        $payment = $this->model->find($request->id);
        $request->is_active = $request->is_active ? 1 : 0;
        $isActive = $request->is_active;
        $payment->update([
            'is_active' => $isActive
        ]);
        return back();

    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return back();
    }
}
