<?php

namespace App\Http\Controllers;


use App\Code;
use Ctct\ConstantContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDO;


class MailController extends Controller
{
    protected $cc;
    protected $pdo;


    public function __construct()
    {
        try {
            $this->cc = new ConstantContact(env('API_KEY'));
            $this->pdo = new PDO('mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
        } catch (\Exception $exception) {
            return response()->json(['data' => $exception->getMessage()], 500);
        }
    }

    public function version()
    {
        return response()->json(['data' => 'v1.0']);
    }

    public function parseCodes(Request $request)
    {
        $start = microtime(true);
        $counter = 0;
        $file = $request->file('codes');
        $insertData = [];

        //TODO needs to check Eloquent performance


        foreach($this->readFile($file, $counter) as $line) {

            $insertData[] = $line;
            if($counter % 1000 == 1) {
                $stmt = $this->pdo->prepare("INSERT INTO codes (code) VALUES ('" . implode("'), ('", $insertData) . "')");
                $stmt->execute();

                $insertData = [];
            }

            $counter++;
        }
        $time_elapsed_secs = microtime(true) - $start;
        return response()->json(['data' => 'Success, ' . $counter . ' codes was imported. Spent: ' . $time_elapsed_secs . ' seconds']);
    }

    public function parseEmails()
    {
        $this->readEmail();

    }

    public function campaignStart()
    {

    }

    //TODO move to helper
    protected function readFile($file, $counter)
    {
        try {
            $fp = $file->openFile();

            while (($line = $fp->getCurrentLine()) !== false)
                yield rtrim($line, "\r\n");
        } catch (\Exception $exception) {
//            Log::error($exception->getMessage() . '| counter:' . $counter);
        }
    }

    protected function readEmail($next = null)
    {
        try {
            $params = ['limit' => 2];
            if($next)
                $params['next'] = $next;

            while (true)
            {
                $result = $this->cc->contactService->getContacts(env('ACCESS_TOKEN'), $params);

//                $emails = [];
//
//                foreach ($result->results as $result) {
//                    $emails[] = $result->email_addresses;
//                }

                dd($result->results);
//                $stmt = $this->pdo->prepare("INSERT INTO emails (email) VALUES ('" . implode("'), ('", $insertData) . "')");
//                $stmt->execute();
            }

        } catch (\Exception $exception) {
//            Log::error($exception->getMessage() . '| counter:' . $counter);
        }
    }
}
