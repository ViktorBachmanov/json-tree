<?php

namespace App\Util;

use Illuminate\Support\Facades\Storage;


class JsonTree {
  private object $sourceArray;
  private int $depth;

  public function __construct(string $depth) {
    if(strtoupper($depth) === 'MAX') {
      $this->depth = PHP_INT_MAX;
    } else {
      $this->depth = (int) $depth;
    }

    $this->sourceArray = json_decode(Storage::disk('local')->get('source.json'), false);
  }

  public function process() {
    echo "<ul id='json-list'>";

    foreach($this->sourceArray as $key => $value) {
      $this->processNode($key, $value, 0);
    }

    echo "</ul>";
  }

  private function processNode(string $name, $value, int $depth) {
    if(!is_object($value)) {
      $this->processLeaf($name, $value);
      return;
    }

    $depth++;

    $isOpen = $depth <= $this->depth ? true : false;
    $state = $isOpen ? '' : 'closed';
    $contentDisplay = $isOpen ? '' : 'hidden';
    echo "<li><span class='nodeLabel $state'><div class='marker'></div>$name (object)</span>";
    echo "<ul class='$contentDisplay'>";

    foreach($value as $key => $value) {
      $this->processNode($key, $value, $depth);
    }

    echo "</ul>";
    echo "</li>";

  }

  private function processLeaf(string $name, $value) {
    $type = gettype($value);
    
    if(is_array($value)) {
      $value = '[' . implode(', ', $value) . ']';
    }
    
    echo "<li><span class='leafLabel'><div class='marker'></div>$name ($type) value: $value</span></li>";
  }

}