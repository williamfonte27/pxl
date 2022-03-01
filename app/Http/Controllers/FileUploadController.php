<?php

namespace App\Http\Controllers;

use App\Jobs\FileUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersModel = new \App\Models\User();
        $allUsers = $usersModel->all();
        return view('imported', compact('allUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            if (!$request->file('fileUploaded')->isValid()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'File is invalid!');
            }

            $extensionaOriginal = $request->file('fileUploaded')->getClientOriginalExtension();

            if ($extensionaOriginal != 'json') {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Extension {$extensionaOriginal} is not supported!");
            }

            $newName = md5(date('YmdHis')) . '.' . $extensionaOriginal;
            $uploadFile = $request->file('fileUploaded')->storeAs('uploads', $newName);
            $processFile = FileUpload::dispatch($uploadFile);

            if ($processFile) {
                return redirect()->back()
                    ->withInput()
                    ->with('success', "The file import process has started!");
            }

            return redirect()->back()
                ->withInput()
                ->with('error', "An error occurred during processing!");


        } catch (\Exception $e) {
            Log::error($e);
            unlink(storage_path("app\\$uploadFile"));
            return redirect()->back()
                ->withInput()
                ->with('error', "An error occurred during processing!");
        }
    }


    /**
     * Function to format the date of birth.
     * @param $dateOriginal
     * @return false|string|null
     */
    public static function getDateFormated($dateOriginal)
    {
        try {

            if (!$dateOriginal) {
                return null;
            }

            $validateDate = strtotime($dateOriginal);

            if (!$validateDate) {
                $dateOriginal = date_create_from_format('d/m/Y', $dateOriginal);
            }

            $dateFormated = Carbon::parse($dateOriginal)->format('Y-m-d');

            return $dateFormated;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }


    /**
     * Function to get user age
     * @param $dateOfBirth
     * @return int
     */
    public static function getAge($dateOfBirth)
    {
        return Carbon::parse($dateOfBirth)->age;
    }

    /**
     * Function that validates if the user's age
     * is between 18 and 65 or if it is null.
     * @param $dateOfBirth
     * @return bool
     */
    public static function validateAge($dateOfBirth)
    {

        if (!$dateOfBirth) {
            return true;
        }

        $userAge = self::getAge($dateOfBirth);
        if ($userAge >= 18 and $userAge <= 65) {
            return true;
        } else {
            return false;
        }

    }


}
