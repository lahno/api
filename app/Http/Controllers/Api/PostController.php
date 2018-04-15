<?php

namespace App\Http\Controllers\Api;

use App\Events\onAddContactEvent;
use App\Model\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends ApiController
{
    public function __construct(Request $request)
    {
        Log::info('Post request: '.implode(", ", $request->all()).PHP_EOL.'IP: '.$request->ip());
    }


    public function contacts(Request $request)
    {
        if ($request->phone){
            $contact = Contact::updateOrCreate(
                ['phone' => str_replace(['+','(',')','-', ' '], "", $request->phone)],
                $this->getArrayNotNull($request)
            );
        }elseif ($request->email){
            $contact = Contact::updateOrCreate(
                ['email' => $request->email],
                $this->getArrayNotNull($request)
            );
        }else{
            Log::info('No mandatory data request: '.implode(", ", $request->all()).PHP_EOL.'IP: '.$request->ip());
            return response()->json(['success' => 'false', 'massage' => 'no mandatory data'], 200);
        }
        event(new onAddContactEvent($contact));
        Log::info('Created Contact: '.implode(", ", $request->all()).PHP_EOL.'IP: '.$request->ip());
        return response()->json(['success' => 'true', 'data' => $contact], 200);
    }

    public function delete($contactId)
    {
        $contact = Contact::where('id', $contactId)->first();
        if (isset($contact)){
            // если в модель есть файл и есть этот файл на диске
            if (!empty($contact->photo) && file_exists(public_path('file_download/photo_users/'.$contact->photo))){
                // удаляем этот файл
                unlink(public_path('file_download/photo_users/'.$contact->photo));
            }
            if (!empty($contact->photo_soc) && file_exists(public_path('file_download/photo_users/'.$contact->photo_soc))){
                // удаляем этот файл
                unlink(public_path('file_download/photo_users/'.$contact->photo_soc));
            }
            $contact->delete();
            Log::info("Removed Contact ID: ".$contactId." complete");
            return ["status" => true, "massage" => "Removed contact model"];
        }else{
            return ["status" => false, "massage" => "No find contact model"];
        }

    }

    public function get_contacts(Request $request){

        $columns = ['id', 'firstname', 'phone', 'email', 'city'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Contact::select('*')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('firstname', 'like', '%' . $searchValue . '%')
                    ->orWhere('firstname', 'like', '%' . $this->getStringLat($searchValue) . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $Contacts = $query->paginate($length);

        return ['data' => $Contacts, 'draw' => $request->input('draw')];
    }


    /*--------------------------
     *  Вспомогательные методы
     * -------------------------*/

}
