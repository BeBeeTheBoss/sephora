<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        return redirect()->route('payments.index');
    }

    public function edit($id)
    {
        $payment = $this->model->find($id);
        return Inertia::render('Admin/Payment/Edit', ['payment' => $payment]);
    }
}
