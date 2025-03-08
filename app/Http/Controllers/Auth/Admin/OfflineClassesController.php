<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfflineClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfflineClassesController extends Controller
{
    public function createOfflinClass()
    {
        return view("auth.admin.offline-classes.create-offline-classes");
    }

    public function offlinClassStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $offlineData = [
                'course_title' => $request->course_title,
                'class_title' => $request->class_title,
                'class_type' => $request->class_type,
                'date' => $request->date,
                'time' => $request->time,
                'venue' => $request->venue,
                'coordinator' => $request->coordinator,
                'fee_type' => $request->fee_type,
                'currency' => $request->currency,
                'discount_price' => $request->discount_price,
                'description' => $request->descriptions,
            ];

            if ($request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                $offlineData['cover_image'] = $file->store('offline-class/cover-image', 'public');
            }

            $dbResponse = OfflineClass::create($offlineData);
            if ($dbResponse) {
                DB::commit();
                return redirect()->back()->with('success', 'Offline Class created successfully');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function createdOfflinClasses()
    {
        $offlineClasses = OfflineClass::all();
        return view('auth.admin.offline-classes.created-offline-classes', compact('offlineClasses'));
    }

    public function deleteOfflineClass($id)
    {
        $dbResponse = OfflineClass::where('id', $id)->delete();

        if ($dbResponse) {

            return redirect()->back()->with('success', 'Offline Class deleted successfully');
        }
        return redirect()->back()->with('error', 'Internal Server Error');
    }

    public function updateOfflineClass(Request $request)
    {
        try {
            DB::beginTransaction();

            $offlineData = [
                'id' => $request->id,
                'course_title' => $request->course_title,
                'class_title' => $request->class_title,
                'class_type' => $request->class_type,
                'date' => $request->date,
                'time' => $request->time,
                'venue' => $request->venue,
                'coordinator' => $request->coordinator,
                'fee_type' => $request->fee_type,
                'currency' => $request->currency,
                'discount_price' => $request->discount_price,
                'description' => $request->descriptions,
            ];

            if ($request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                $offlineData['cover_image'] = $file->store('offline-class/cover-image', 'public');
            }

            $updateResponse = OfflineClass::where('id', $offlineData['id'])->update($offlineData);

            if ($updateResponse) {
                DB::commit();
                return redirect()->back()->with('success', 'Offline Class updated successfully');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to update Offline Class');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
