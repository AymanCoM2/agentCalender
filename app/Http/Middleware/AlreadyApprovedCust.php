<?php

namespace App\Http\Middleware;

use App\Models\CustMonthApproval;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AlreadyApprovedCust
{
    public function handle(Request $request, Closure $next): Response
    {
        $currentYear = date('Y');
        $currentMonthNumber =  date('m');
        $userId = Auth::user()->id;
        $approvalObject  = CustMonthApproval::where('month', $currentMonthNumber)
            ->where('year', $currentYear)
            ->where('user_id', $userId)
            ->first();
        if ($approvalObject) {
            if ($approvalObject->isApproved) {
                return redirect()->route('rep-home');
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
