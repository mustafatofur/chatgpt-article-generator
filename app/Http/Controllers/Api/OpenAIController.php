<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
class OpenAIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function process(Request $request)
    {
        if($request->tone == "Suitable for SEO")
        {
            $prompt = "Write a complete article on this topic:\n\n" . $request->topic . "\n\nUse following keywords in the article:\n" . $request->keywords . "\n\nArticle length should be ". $request->words. " words, Write SEO-friendly article using tags such as h1, h2, h3 tags and focusing on keywords. \n\nAnd write in this language:\n" . $request->language . "\n\n";
        } else {
            $prompt = "Write a complete article on this topic:\n\n" . $request->topic . "\n\nUse following keywords in the article:\n" . $request->keywords . "\n\nTone of voice of the article must be:\n" . $request->tone . "\n\nArticle length should be ". $request->words. " words, \n\nAnd write in this language:\n" . $request->language . "\n\n";
        }
        
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role'    => 'user',
                    'content' => $prompt
                ]
            ],
        ]);
        $messageResult = "";
        foreach ($response->choices as $result) {
           $messageResult = $result->message->content;
        }
        
     return [
        'success' => true,
        'message' => $messageResult,
     ];
        
    }

    public function downloadArticle(Request $request)
    {
        if($request->fileType && $request->fileType == 'txt')
        {
            // Create if directory doesn't exists
            if(!File::exists('downloads'))
            {
                File::makeDirectory('downloads', 0777, true, true);
            }
            // Delete if file exists
            if(File::exists("downloads/". $request->topic .".txt"))
            {
                File::delete("downloads/". $request->topic .".txt");
            }
            
            $myfile = fopen("downloads/". $request->topic .".txt", "a") or die("Unable to open file!");
            $txt = Str::replace("<br />", "\n" , $request->article);
            fwrite($myfile, $txt);
            
            $headers = [
                'Content-Type' => 'application/txt',
            ];
            return response()->download(public_path("downloads/". $request->topic .".txt"), $request->topic.".txt", $headers);
        }
        return false;
    }

}
