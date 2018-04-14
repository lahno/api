<?php

namespace App\Http\Controllers\Api;

use App\Events\onAddContactEvent;
use App\Model\Contact;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use msonowal\LaravelTinify\Facades\Tinify;

class PostController extends Controller
{
    public function __construct(Request $request)
    {
        Log::info('Post request: '.implode(", ", $request->all()).PHP_EOL.'IP: '.$request->ip());
    }

    public function contacts(Request $request)
    {
        if ($request->phone){
            $contact = Contact::updateOrCreate(
                ['phone' => $request->phone],
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
        Log::info('Created contact: '.implode(", ", $request->all()).PHP_EOL.'IP: '.$request->ip());
        return response()->json(['success' => 'true', 'data' => $contact], 200);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        // если в модель есть файл и есть этот файл на диске
        if (!empty($contact->photo) && file_exists(public_path('file_download/photo_users/'.$contact->photo))){
            // удаляем этот файл
            unlink(public_path('file_download/photo_users/'.$contact->photo));
        }
        Log::info("Removed contact complete");
        return redirect()->back()->with("status", "Removed contact");
    }

    public function get_contacts(){
        return Contact::all();
    }


    /*--------------------------
     *  Вспомогательные методы
     * -------------------------*/

    public function getArrayNotNull($request)
    {
        $data = [];
        // получаем модель из БД
        if ($request->phone){
            $contact_db = Contact::where('phone', $request->phone)->first();
        }elseif ($request->email){
            $contact_db = Contact::where('email', $request->email)->first();
        }else{
            return false;
        }
        foreach ($request->all() as $key => $item){
            if ($item == null) continue; // если нет значения - пропускаем
            if ($key == 'photo'){
                // если есть модель с файлом и есть этот файл на диске
                if (!empty($contact_db->photo) && file_exists(public_path('file_download/photo_users/'.$contact_db->photo))){
                    // удаляем этот файл
                    unlink(public_path('file_download/photo_users/'.$contact_db->photo));
                }
                $file_name = uniqid(Carbon::now()->format('YmdGi')).'.jpg';
                $path = public_path('file_download/photo_users/'.$file_name);
                // сжимаем и сохраняем файл
                $source = Tinify::fromUrl($item);
                $source->toFile($path);
                $data[$key] = $file_name;
                continue;
            }
            if ($key == 'photo_soc'){
                // если есть модель с файлом и есть этот файл на диске
                if (!empty($contact_db->photo_soc) && file_exists(public_path('file_download/photo_users/'.$contact_db->photo_soc))){
                    // удаляем этот файл
                    unlink(public_path('file_download/photo_users/'.$contact_db->photo_soc));
                }
                $file_name = uniqid(Carbon::now()->format('YmdGi')).'.jpg';
                $path = public_path('file_download/photo_users/'.$file_name);
                // сжимаем и сохраняем файл
                $source = Tinify::fromUrl($item);
                $source->toFile($path);
                $data[$key] = $file_name;
                continue;
            }
            if($key == 'phone'){
                $phone = str_replace(['+','(',')','-', ' '], "", $item);
                $data[$key] = $phone;
                continue;
            }
            $data[$key] = $item;
        }
        return $data;
    }

}
