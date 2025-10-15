<?php

namespace App\Http\Controllers;

use App\Models\Reporter;

class ReporterController {
public function index($type = null, $content = null) {
    if ($type == null) {
        return Reporter::all();
    }

    switch ($type) {
        case "id": 
            return Reporter::where('id', $content)->first();
        case 'name':
            return Reporter::where('name', $content)->first();
        case 'email':
            return Reporter::where('email', $content)->first();
    }
}

public function store($name, $email) {
     $reporter = new Reporter();
     $reporter->name = $name;
     $reporter->email = $email;
     $reporter->save();

     return $reporter->id;
}
}