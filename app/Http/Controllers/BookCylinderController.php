<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\AvailableCylinderSupplier;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;


class BookCylinderController extends Controller
{
    /**
     * Display the registration view.
     */
    public function index()
    {
        $suppliers = User::select('id','name')->get(); 
        return Inertia::render('BookCylinder', [
            'suppliers' => $suppliers,
        ]);
    }

    public function supplier()
    {
        $suppliers = User::select('id','name')->get(); 
        return $suppliers;
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function book(Request $request): RedirectResponse
    {
        $stock = AvailableCylinderSupplier::where('user_id', $request->supplier_name)->first();

        if (!$stock) {
            return redirect()->back()->withErrors(['supplier_name' => 'Supplier not found']);
        }

        switch ($request->cylinder_option) {
            case '5':
                if ($stock->getAttribute('5ltr') == 0) {
                    return redirect()->back()->withErrors(['cylinder_option' => '5 ltr cylinder is out of stock']);
                }
                break;
            case '10':
                if ($stock->getAttribute('10ltr') == 0) {
                    return redirect()->back()->withErrors(['cylinder_option' => '10 ltr cylinder is out of stock']);
                }
                break;
            case '15':
                if ($stock->getAttribute('15ltr') == 0) {
                    return redirect()->back()->withErrors(['cylinder_option' => '15 ltr cylinder is out of stock']);
                }
                break;
        }

        $booking = Booking::create([
        'supplier' => $request->supplier_name,
        'name' => $request->name,
        'gender' => $request->gender,
        'age' => $request->age,
        'status' => 'processing',
        'aadhar_card_number' => $request->aadhar_card_number,
        'identity_proof' => $request->identity_proof,
        'address' => $request->address,
        'state' => $request->state,
        'city' => $request->city,
        'phone_number' => $request->phone_number,
        'covid_status' => $request->covid_status,
        'date_of_positive' => $request->date_of_positive,
        'cylinder_option' => $request->cylinder_option,
    ]);

      if ($booking) {
            $stock = AvailableCylinderSupplier::where('user_id', $request->supplier_name)->first();
            if ($stock) {
                switch ($request->cylinder_option) {
                    case '5':
                        $stock->decrement('5ltr');
                        break;
                    case '10':
                        $stock->decrement('10ltr');
                        break;
                    case '15':
                        $stock->decrement('15ltr');
                        break;
                }
            } else {
                return redirect()->back()->withErrors(['supplier_name' => 'Supplier not found']);
            }
        }     
    return redirect()->back('/');
    }

     public function dashboard()
    {
        $userId = Auth::id();
        $bookings = Booking::where('supplier', $userId)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Dashboard', [
            'bookings' => $bookings,
        ]);
    }

public function changeStatus(Request $request)
{
    $id = $request->id;
    $status = $request->status;
    $booking = Booking::findOrFail($id);
    $booking->status = $status;
    $booking->save();

    return response()->json(['success' => true]);
}



    public function dashboardData(Request $request)
    {
        $cylinderOption = $request->input('cylinderOption');
        $state = $request->input('state');

        $query = Booking::query();

        if ($cylinderOption) {
            $query->where('cylinder_option', $cylinderOption);
        }

        if ($state) {
            $query->where('state', $state);
        }

        $bookings = $query->get();

        return $bookings;
    }



    public function getStateCounts()
    {
        $stateCounts = DB::table('users')
            ->join('available_cylinders', 'users.id', '=', 'available_cylinders.user_id')
            ->select('users.state', DB::raw('SUM(available_cylinders.`5ltr`) as `5ltr_count`'), DB::raw('SUM(available_cylinders.`10ltr`) as `10ltr_count`'), DB::raw('SUM(available_cylinders.`15ltr`) as `15ltr_count`'))
            ->groupBy('users.state')
            ->get();

        return response()->json($stateCounts);
    }
}
