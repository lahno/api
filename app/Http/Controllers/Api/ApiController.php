<?php

namespace App\Http\Controllers\Api;

use App\Model\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use msonowal\LaravelTinify\Facades\Tinify;

class ApiController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getStringLat($string){
        $arStrES = array("ае","уе","ое","ые","ие","эе","яе","юе","ёе","ее","ье","ъе","ый","ий");
        $arStrOS = array("аё","уё","оё","ыё","иё","эё","яё","юё","ёё","её","ьё","ъё","ый","ий");
        $arStrRS = array("а$","у$","о$","ы$","и$","э$","я$","ю$","ё$","е$","ь$","ъ$","@","@");

        $replace = array("А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
            "Е"=>"Ye","е"=>"e","Ё"=>"Ye","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i",
            "Й"=>"Y","й"=>"y","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n",
            "О"=>"O","о"=>"o","П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t",
            "У"=>"U","у"=>"u","Ф"=>"F","ф"=>"f","Х"=>"Kh","х"=>"kh","Ц"=>"Ts","ц"=>"ts","Ч"=>"Ch","ч"=>"ch",
            "Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch","щ"=>"shch","Ъ"=>"","ъ"=>"","Ы"=>"Y","ы"=>"y","Ь"=>"","ь"=>"",
            "Э"=>"E","э"=>"e","Ю"=>"Yu","ю"=>"yu","Я"=>"Ya","я"=>"ya","@"=>"y","$"=>"ye");

        $string = str_replace($arStrES, $arStrRS, $string);
        $string = str_replace($arStrOS, $arStrRS, $string);

        return iconv("UTF-8","UTF-8//IGNORE",strtr($string,$replace));
    }

    public function getArrayNotNull($request)
    {
        $data = [];
        $data_soc_url = [];

        // получаем модель из БД
        if ($request->phone){
            $phone = str_replace(['+','(',')','-', ' '], "", $request->phone);
            $contact_db = Contact::where('phone', $phone)->first();
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
                $img = Image::make($item)->resize(100, 100);
                $img->save($path, 100); // качество 100/100, по умолчанию 90
                $data[$key] = $file_name;
                continue;
            }
            if($key == 'phone'){
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
                $data[$key] = $item;
                $data_soc_url[0] = $url;
                continue;
            }
            if($key == 'soc_id'){
                $data[$key] = $item;
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
