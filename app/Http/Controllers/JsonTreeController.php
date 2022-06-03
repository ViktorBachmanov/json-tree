<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Util\JsonTree;

class JsonTreeController extends Controller
{
    /**
     * Create the expanded list from json-object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $method = $request->method();
 
        if ($request->isMethod('get')) {
            $fileContent = $request['json-file'];
        } else {
            $fileContent = $request->file('json-file')->get();
        }

        $sourceObject = json_decode($fileContent, false);

        $bgType = $request->bgType;

        $background = $request[$bgType];

        $depth = $request->depth;

        $jsonTree = new JsonTree($sourceObject, $depth);


        $IMG = config('constants.bgTypes.img');
        $RGB = config('constants.bgTypes.rgb');

        switch($bgType) {
            case $IMG:
                $urlScheme = parse_url($background, PHP_URL_SCHEME);
                if(!$urlScheme) {
                    $background = 'https://' . $background;
                }
                $background = "url($background)";
                break;
            case $RGB:
                $background = "rgb$background";
                break;
        }        
        

        return view('list',
            ['tree' => $jsonTree,
            'background' => $background]);
    }
    
}
