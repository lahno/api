<?php

namespace App\Http\Controllers\Api;

use App\Model\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use msonowal\LaravelTinify\Facades\Tinify;

class PostController extends Controller
{
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
            return response()->json(['success' => 'false', 'massage' => 'нет обязательных данных!'], 200);
        }
        return response()->json(['success' => 'true', 'data' => $contact], 200);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        return response()->json(['success' => 'true', 'massage' => 'removed'], 200);
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
