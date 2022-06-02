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

        $background = $request->background;
        $urlScheme = parse_url($background, PHP_URL_SCHEME);
        if(!$urlScheme) {
            $background = 'https://' . $background;
        }

        $jsonTree = new JsonTree($depth);

        return view('list',
            ['tree' => $jsonTree,
            'background' => $background]);
    }
    
}
