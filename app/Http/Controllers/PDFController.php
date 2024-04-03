<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $order = Order::find($id);
        $pdf = new Dompdf();
        $pdf->loadHtml(view('pdf.pdf',compact('order')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        return $pdf->stream('Order.pdf', ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline']);
    }
}
