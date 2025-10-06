<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\StoreDonationRequest;
use App\Models\Donation;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceItem;

class DonationController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey(config('services.xendit.secret_key'));
    }

    public function create(User $user)
    {
        return view('donations.create', compact('user'));
    }

    public function store(StoreDonationRequest $request)
    {
        DB::beginTransaction();

        try {
            $donation = Donation::query()->create($request->validated());

            $invoiceItem = new InvoiceItem([
                'name' => 'Donation',
                'price' => $request->amount,
                'quantity' => 1
            ]);

            $createInvoice = new CreateInvoiceRequest([
                'external_id' => 'donation-' . $donation->id,
                'payer_email' => $request->email,
                'amount' => $request->amount,
                'items' => [$invoiceItem],
                'invoice_duration' => 24,
                'success_redirect_url' => route('donations.success', ['donation' => $donation])
            ]);

            $invoiceApi = new InvoiceApi();
            $generateInvoice = $invoiceApi->createInvoice($createInvoice);

            $payment = Payment::query()->create([
                'donation_id' => $donation->id,
                'payment_id' => $generateInvoice['id'],
                'payment_method' => 'xendit',
                'status' => 'pending',
                'payment_url' => $generateInvoice['invoice_url']
            ]);

            DB::commit();

            return redirect($payment->payment_url);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $th->getMessage();
        }
    }

    public function success(Donation $donation)
    {
        return $donation->id . ' is success';
    }
}
