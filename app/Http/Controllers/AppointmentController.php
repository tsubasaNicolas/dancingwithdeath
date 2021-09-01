<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Class AppointmentController
 * @package App\Http\Controllers
 */
class AppointmentController extends Controller
{
  
    public function index()
    {
        $appointments = Appointment::paginate();

        return view('appointment.index', compact('appointments'))
            ->with('i', (request()->input('page', 1) - 1) * $appointments->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appointment = new Appointment();
        return view('appointment.create', compact('appointment'));
    }

 
    public function store(Request $request)
    {
        request()->validate(Appointment::$rules);

        $appointment = Appointment::create($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully.')->with('register', 'Yes');
    }


    public function show($id)
    {
        $appointment = Appointment::find($id);

        return view('appointment.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::find($id);

        return view('appointment.edit', compact('appointment'));
    }

   
   
    public function update(Request $request, Appointment $appointment)
    {
        request()->validate(Appointment::$rules);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully');
    }


    public function destroy($id)
    {
       // $appointment = Appointment::find($id)->delete();
                DB::table('appointments')->whereId(request('appointmentId'))->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully')->with('delete', 'Yes');
    }
}
