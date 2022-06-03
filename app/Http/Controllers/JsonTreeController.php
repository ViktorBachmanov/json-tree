<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $depth = $request->depth;

        $bgType = $request->bgType;

        $background = $request[$bgType];

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
        

        $jsonTree = new JsonTree($depth);

        return view('list',
            ['tree' => $jsonTree,
            'background' => $background]);
    }
    
}
