<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index', [
            'pageTitle' => 'Respo QR Codes - Vehicle Alerts',
            'metaDescription' => 'Vehicle Alerts VA provides a fast and reliable way to Report any Incident or Get notified about your parked vehicle in Real Time',
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'pageTitle' => 'About Us - Respo QR Codes',
            'metaDescription' => 'Welcome to RespoQRCodes – a brand presenting Inferlogic Consultancy Services Pvt Ltd',
        ]);
    }

    public function shop()
    {
        return view('pages.shop', [
            'pageTitle' => 'Shop - Respo QR Codes',
            'metaDescription' => 'Purchase RespoQR Codes for your vehicle',
        ]);
    }

    public function howItWorks()
    {
        return view('pages.how-it-works', [
            'pageTitle' => 'How It Works - Respo QR Codes',
            'metaDescription' => 'Learn how RespoQR Codes work for vehicle alerts',
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'pageTitle' => 'Contact Us - Respo QR Codes',
            'metaDescription' => 'Get in touch with Respo QR Codes team',
        ]);
    }

    public function faq()
    {
        return view('pages.faq', [
            'pageTitle' => 'FAQ - Respo QR Codes',
            'metaDescription' => 'Frequently Asked Questions about Respo QR Codes',
        ]);
    }
}
