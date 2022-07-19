<?php

namespace App\Http\Controllers;


use App\Models\Webex;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Invoice;
//TODO use App\Http\Requests\StoreInvoiceRequest;
//TODO use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Offer;
use App\Models\Company;
use App\Models\Client;
use App\Models\Workshop;
use Carbon\Carbon;
use DB;
use DataTables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\MailController as Mailer;
use JetBrains\PhpStorm\NoReturn;
use Barryvdh\DomPDF\Facade as PDF;


class AccountingController extends Controller
{

    public function generatePdf($data)
    {
//        dd($data);
        $pdf = PDF::loadView('livewire.offers.show-offer', $data);
//        $pdf->download('ANG-'.$data->offer_number.'pdf');

        return PDF::loadView('livewire.offers.show-offer', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
   public function index(): View
    {


        return view('accounting.show-offers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function offers(): View
    {

        return view('accounting.show-offers');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function createOffer()
    {
        return view('accounting.create-offer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->input();
        if (($attributes['invoice_recipient']['title']) != null) {
            $client = new  Client();
            $client->fill($attributes['invoice_recipient'])->save();
        }
        else{
//            $attributes['invoice_recipient'] = Company::findOrFail($request->input('company_id'))->id;
            $attributes['invoice_recipient'] = Client::findOrFail($request->input('client_id'))->id;
        }
        $total = [];
        foreach ($attributes['positions'] as $pos => $val){
            //Discount to percentage
            $discountInPercentage = (100-$val['discount'])/100;
            $amount = $val['quantity'] * ($val['unit_price']*$discountInPercentage);
            $attributes['positions'][$pos]['amount'] = $amount;
            //Collect and sum amounts  for the Order/Invoice
            $total[] = $amount;
        }
        $attributes['total'] = array_sum($total);
            if (!empty($attributes['invoice'])) {
            ///Invoices
            $invoice = $this->createInvoice($attributes, $attributes['positions']);
                if (!empty($client)) {
                    $invoice->clients()->attach($client);
                }
            }
            ///offers
            $offer = $this->createOffer($attributes, $attributes['positions']);
            if (isset($client)) {
                $offer->clients()->attach($client);
            }
            $offer->companies()->attach($request->input('company_id'));
            $offer->clients()->attach($request->input('client_id'));

        return redirect()->route('accounting')
            ->with('success', trans('accounting.success.create'));
    }
    /**
     * Display the specified resource.
     *
     * @return View
     */
    public function showOffer($slug)
    {
//        $offer = Offer::with('companies')->where('offer_number', $slug)->get();

        return view('accounting.show-offer',compact('slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function editOffer($slug):View
    {
//        $offer = Offer::with('companies', 'companies.clients', 'user')->where('slug', $slug)->first();
//        dd($offer);


        return view('accounting.edit-offer',compact('slug'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {

        return redirect()->route('roles.index')
            ->with('success', trans('roles.success.update'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        return redirect()->route('roles.index')
            ->with('success', trans('roles.success.delete'));
    }

    /**
     * Create An Invoice
     *
     * @return Response
     */
    public function createInvoice($attributes, $positions)
    {
        $invoice = new Invoice($attributes);
        $invoice->invoice_number = 2120001;
        $invoice->due_date = Carbon::today()->addDays($attributes['due_date'])->format('d.m.Y');
        $latest_invoice = Invoice::latest()->get();
        if (count($latest_invoice) > 0){
            $invoice->invoice_number = $latest_invoice[0]->invoice_number +1;
        }
        $invoice->positions = $positions;

        $invoice->save();
//     TODO   $invoice->attach()->company;
//     TODO   $offerToPDF = new PDF::make($invoice)
        return $invoice;
    }


}
