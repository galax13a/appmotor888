<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    //
    public function __invoke(){
        return 'home reports ';
    }

    public function index() {

        return 'Reportes';
    }
    public function reportes() {
        return 'mmmmmm';
    }
}
