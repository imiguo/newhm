<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PackagesController extends Controller
{
    public function index()
    {
        $packages = Package::get();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'unit' => 'in:1,2,3',
            'days' => 'integer',
            'commission_rate' => 'numeric',
            'status' => 'in:0,1',
            'once' => 'in:0,1',
            'description' => 'nullable',
        ]);
        Package::create($request->all());
        Flash::success('package create successfully');
        return redirect('packages');
    }

    public function show($id)
    {
        return view('packages.show');
    }

    public function edit($id)
    {
        $package = Package::where('id', $id)->first();
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);
        $package->update($request->all());
        Flash::success('package update successfully');
        return redirect('packages');
    }

    public function destroy($id)
    {
        Package::where('id', $id)->delete();
        Flash::success('package delete successfully');
        return redirect('packages');
    }
}