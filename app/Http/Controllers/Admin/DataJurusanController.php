<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataJurusanController extends Controller
{
    // resource controller for managing 'jurusan' data

    public function index()
    {
        // Logic to display a list of jurusan
    }
    public function create()
    {
        // Logic to show form for creating a new jurusan
    }
    public function store(Request $request)
    {
        // Logic to store a new jurusan
    }
    public function show($id)
    {
        // Logic to display a specific jurusan
    }
    public function edit($id)
    {

        // Logic to show form for editing a specific jurusan
    }
    public function update(Request $request, $id)
    {
        // Logic to update a specific jurusan
    }
    public function destroy($id)
    {
        // Logic to delete a specific jurusan
    }

}
