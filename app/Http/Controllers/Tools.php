<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
class Tools extends Controller
{
    # CURL
    public static function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }


    /**
     * 文件上传
     */
    public function file_upload(Request $request)
    {
        $file = "";     // 文件

        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            exit('上传文件为空！');
        }

        $file = $request->file('file');

        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }

        $newFileName = md5(time().rand(0,10000)).'.'.$file->getClientOriginalExtension();
        $imgbox = "uploadfiles/".date("Ymd",time())."/";
        if(!file_exists($imgbox)){
            // 创建目录，并设置权限
            mkdir($imgbox,0777, true);
        }

        $savePath = $imgbox.$newFileName;
        $bytes = Storage::put(
            $savePath,
            file_get_contents($file->getRealPath())
        );

        if(!Storage::exists($savePath)){
            exit('保存文件失败！');
        }

        // echo json_encode(['url'=>$savePath,'filename'=>$savePath]);
        echo $savePath;

    }

    public function test()
    {
        // dd("oj8k");
        echo "oj8k";
    }



}
