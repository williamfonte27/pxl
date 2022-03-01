<?php

namespace App\Jobs;

use App\Http\Controllers\FileUploadController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class FileUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    private $dataFile;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $dataFile)
    {
        $this->dataFile = $dataFile;
    }

    /**
     * Function that execute the import of the json file to the database
     *
     * @return void
     */
    public function handle()
    {
        $dados = file_get_contents(
            storage_path(
                "app\\$this->dataFile"
            )
        );
        $users = json_decode($dados, true);
        foreach ($users as $user) {

            $dateOfBirthFormated = FileUploadController::getDateFormated($user['date_of_birth']);
            $validateUserAge = FileUploadController::validateAge($dateOfBirthFormated);

            if (!$validateUserAge) {
                continue;
            }

            $lineFormated = [
                'name' => $user['name'],
                'address' => $user['address'],
                'checked' => $user['checked'],
                'description' => $user['description'],
                'interest' => $user['interest'],
                'date_of_birth' => $dateOfBirthFormated,
                'email' => $user['email'],
                'account' => $user['account'],
                'credit_card_type' => $user['credit_card']['type'],
                'credit_card_number' => $user['credit_card']['number'],
                'credit_card_name' => $user['credit_card']['name'],
                'credit_card_expirationDate' => $user['credit_card']['expirationDate'],
                'file_name' => basename($this->dataFile)
            ];

            $chunk[] = $lineFormated;

            if (count($chunk) >= 1000) {
                $insertData = \App\Models\User::insert($chunk);
                $chunk = [];
            }

        }

        if (isset($chunk)) {
            $insertData = \App\Models\User::insert($chunk);
            $chunk = [];
        }

        if (isset($insertData)) {
            unlink(storage_path("app\\$this->dataFile"));
        }
    }
}
