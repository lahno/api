<?php

namespace App\Http\Controllers\Api;

use App\Events\onAddContactEvent;
use App\Model\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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

        $columns = ['id', 'firstname', 'phone', 'email'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Contact::select('*')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('firstname', 'like', '%' . $searchValue . '%')
                    ->orWhere('phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $Users = $query->paginate($length);

        return ['data' => $Users, 'draw' => $request->input('draw')];
    }


    /*--------------------------
     *  Вспомогательные методы
     * -------------------------*/

    public function getArrayNotNull($request)
    {
        $data = [];
        $data_soc_url = [];

        // получаем модель из БД
        if ($request->phone){
            $contact_db = Contact::where('phone', $request->phone)->first();
        }elseif ($request->email){
            $contact_db = Contact::where('email', $request->email)->first();
        }else{
            return false;
        }

        // Проходим цикл и записываем в массив только не пустые значения
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
            if($key == 'soc'){
                if ($item == 'facebook'){
                    $url = 'https://www.facebook.com/';
                }elseif ($item == 'vk'){
                    $url = 'https://vk.com/';
                }else{
                    $url = null;
                }
                $data_soc_url[0] = $url;
                continue;
            }
            if($key == 'soc_id'){
                $data_soc_url[1] = $item;
                continue;
            }
            $data[$key] = $item;
        }

        ksort($data_soc_url); // сортируем по ключу
        $data['soc_url'] = implode($data_soc_url); // добавляем скленное значение в массив

        return $data;
    }

}
