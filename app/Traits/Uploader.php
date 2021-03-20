<?php


namespace App\Traits;


use Aws\IVS\IVSClient;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Twilio\Rest\Client;

trait Uploader
{
    public function Upload($File, $Name)
    {
        $client = new S3Client([
            'endpoint' => "https://" . env('WAS_BUCKET') . ".s3." . env('WASABI_DEFAULT_REGION') . ".wasabisys.com/",
            'region' => env('WASABI_DEFAULT_REGION', 'eu-central-1'),
            'version' => 'latest',
            'credentials' => [
                'key' => env('WAS_ACCESS_KEY_ID'),
                'secret' => env('WAS_SECRET_ACCESS_KEY')
            ],
            'use_path_style_endpoint' => true
        ]);

        $result = $client->putObject([
            'Bucket' => env('WAS_BUCKET'),
            'Key' => $Name,
            'SourceFile' => $File,
            'ACL' => 'public-read'
        ]);
       /* $result = $client->putObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $Name,
            'SourceFile' => $File,
            'ACL' => 'public-read'
        ]);*/
        return $result['ObjectURL'];




    }


    public function S3(Request $request, $name)
    {
        $request->validate([
            $name => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        $file_path = \request($name)->getPathName();
        $imageName = bin2hex(random_bytes(32)) .'.'. \Str::lower(\request($name)->getClientOriginalExtension());
        $Url = $this->Upload($file_path, $imageName);
        return $Url;
    }




    public function S3Setting(Request $request, $name)
    {
        $request->validate([
            $name => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $file_path = \request($name)->getPathName();
        $imageName = bin2hex(random_bytes(32)) .'.'. \Str::lower(\request($name)->getClientOriginalExtension());
        $Url = $this->Upload($file_path, $imageName);
        return $Url;
    }


    public function S3Doc(Request $request, $name)
    {

        $request->validate([
            $name => 'required|mimes:pdf|max:20480',
        ]);

        $file_path = \request($name)->getPathName();
        $FileName = bin2hex(random_bytes(32)) .'.pdf' ;
        $Url = $this->Upload($file_path, $FileName);
        return $Url;
    }


    public function S3Hasan(Request $request,$input)
    {
        $request->validate([
            $input => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $originalImage= \request()->file($input);
        $thumbnailImage = Image::make(\request()->file($input));
        $originalPath = public_path().'/images/';
        $thumbnailPath = public_path().'/thumbnails/';
        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $final=$thumbnailImage->save($thumbnailPath.time().".".$originalImage->getClientOriginalExtension());
        $finalPath = $final->dirname."/".$final->basename;
        $finalName = $final->basename;
        $Url = $this->Upload($finalPath, $finalName);
        sleep(1);
        return $Url;
    }



    public function UploadPic(Request $request, $name, $folder, $Mode = 'Profile')
    {
        $request->validate([
            $name => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        if ($Mode == 'Profile') {
            $orginalPath = '/Uploads/' . $folder . '/' . Auth::id() . '/';
            $path = public_path($orginalPath);
        } else {
            $orginalPath = '/Uploads/' . $folder . '/';
            $path = public_path($orginalPath);
        }

        $ImageSecurityCode = rand('10000', '99999');
        $imageNameForMove = bin2hex(random_bytes(32)) . '.jpg';

        $imageName = $imageNameForMove . '?SecurityCode=' . $ImageSecurityCode;
        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
        \request($name)->move($path, $imageNameForMove);

        return $orginalPath . $imageName;
    }

    public function UploadVideo(Request $request, $name, $folder)
    {
        $orginalPath = '/Uploads/' . $folder . '/';
        $path = public_path($orginalPath);

        $imageName = bin2hex(random_bytes(32)) . '.mp4';
        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
        \request($name)->move($path, $imageName);

        return $orginalPath . $imageName;
    }

    public function SiteIcon(Request $request)
    {
        $request->validate([
            'SiteIcon' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);
        $orginalPath = '/assets/images/';
        $path = public_path($orginalPath);
        $imageName = 'favicon.ico';
        \request('SiteIcon')->move($path, $imageName);
        return $orginalPath . $imageName;
    }


    public function sendSMS($message, $recipients)
    {
        $account_sid = env("TWILIO_SID");
        $auth_token = env("TWILIO_AUTH_TOKEN");
        $twilio_number = env("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }

}
