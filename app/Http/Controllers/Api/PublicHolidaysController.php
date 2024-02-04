<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PublicHolidays;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicHolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $checkedHolidays = $request->checkedHolidays;
            $createdHolidays = [];
    
            foreach ($checkedHolidays as $checkedHoliday) {
          
                $holiday = new PublicHolidays();
                $holiday->name = $checkedHoliday['localName'];
                $holiday->date = $checkedHoliday['date'];
                $holiday->save();
                $createdHolidays[] = $holiday;
            }
    
            return response()->json(['message' => 'Holidays created successfully', 'holidays' => $createdHolidays], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create holidays', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PublicHolidays $publicHolidays)
    {
         return response()->json($publicHolidays::all(), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
         $validatedData = $request->validate([
            'name' => 'required|string',
            'date' => 'required|date', 
            'note' => 'nullable|string',
        ]);

         $publicHolidays = PublicHolidays::findOrFail($id);
         $publicHolidays->update($validatedData);

            return response()->json(['message' => 'Public holiday updated successfully', 'holiday' => $publicHolidays], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update public holiday', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublicHolidays $publicHolidays)
    {
        //
    }
}
