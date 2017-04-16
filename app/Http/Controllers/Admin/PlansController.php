<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Plan;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function create($packageId)
    {
        $package = Package::findOrFail($packageId);
        return view('plans.create', compact('package'));
    }

    public function store(Request $request, $packageId)
    {
        Package::findOrFail($packageId);
        $this->validate($request, [
            'name' => 'required|max:60',
            'min' => 'integer',
            'max' => 'integer',
            'percent' => 'numeric',
            'status' => 'in:0,1',
        ]);
        $data = array_merge($request->all(), [
            'package_id' => $packageId,
        ]);
        Plan::create($data);
        Flash::success('plan create successfully');
        return redirect('packages');
    }

    public function edit($packageId, $planId)
    {
        $plan = Plan::findOrFail($planId);
        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, $packageId, $planId)
    {
        $plan = Plan::findOrFail($planId);
        $this->validate($request, [
            'name' => 'required|max:60',
            'min' => 'integer',
            'max' => 'integer',
            'percent' => 'numeric',
            'status' => 'in:0,1',
        ]);
        $plan->update($request->except('package_id'));
        Flash::success('plan update successfully');
        return redirect('packages');
    }

    public function destroy($packageId, $planId)
    {
        Plan::where('id', $planId)->delete();
        Flash::success('plan delete successfully');
        return 'success';
    }
}