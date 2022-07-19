<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function generateOfferPDF($id)
    {
        $data = Offer::where('id', $id)->firstOrFail();
        // share data to view
        view()->share('employee',$data);
        $pdf = PDF::loadView('pdfs.offer', $data);
        // download PDF file with download method
        return $pdf->stream('ANG-'.$data->offer_number.'.pdf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function generateInvoicePDF()
    {
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('pdfs.offer', $data);
        return $pdf->download('itsolutionstuff.pdf');
    }
}
