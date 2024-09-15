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
        return Inertia::render('Admin/Payment/Index');
    }

    public function create()
    {
        $payments = $this->model->all();
        return Inertia::render('Admin/Payment/Create', ['payments' => $payments]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $this->model->create($data);
        return redirect()->route('payments.index');
    }
}
