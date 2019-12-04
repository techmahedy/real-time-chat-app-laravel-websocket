<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;

class DatatableController extends Controller
{

    public function index() {

        return view('Frontend.datatable.index');

    }

    public function getUsers() {

        return Datatables::of(User::query())->make(true);

    }
}
