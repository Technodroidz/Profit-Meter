<?php

namespace App\Http\Controllers\front;
use App\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
   
        return view('plans.index', compact('plans'));
    }
    public function show(Plan $plan, Request $request)
    {
        print_r($request->user()->subscribedToPlan($plan->stripe_plan, 'main')); exit;
        if($request->user()->subscribedToPlan($plan->stripe_plan, 'main')) {
            return redirect()->route('home')->with('success', 'You have already subscribed the plan');
        }
     
        return view('plans.show', compact('plan'));
    }
}
