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
        dd($request->all());
        $data = $request->validate([
            'name' => 'required'
        ]);

        $this->model->find($request->id)->update($data);
        return to_route('payments.index');
    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return back();
    }
}
