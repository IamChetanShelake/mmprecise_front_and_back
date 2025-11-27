<?php

use App\Models\Project;
use Illuminate\Support\Facades\File;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$project = Project::first();

if (!$project) {
    echo "No projects found.\n";
    exit;
}

echo "Project ID: " . $project->id . "\n";
echo "Stored Image Path: " . $project->main_image . "\n";

$fullPath = base_path($project->main_image);
echo "Resolved Full Path: " . $fullPath . "\n";

if (file_exists($fullPath)) {
    echo "✅ File EXISTS at this path.\n";
    echo "MIME Type: " . mime_content_type($fullPath) . "\n";
} else {
    echo "❌ File does NOT exist at this path.\n";
    
    // Debugging: List files in the directory
    $dir = dirname($fullPath);
    echo "Checking directory: $dir\n";
    if (is_dir($dir)) {
        echo "Directory exists. Files in directory:\n";
        $files = scandir($dir);
        foreach ($files as $file) {
            echo " - $file\n";
        }
    } else {
        echo "Directory does NOT exist.\n";
    }
}

// Test Route Logic
$path = $project->main_image;
$decodedPath = urldecode($path);
$allowedPrefixes = [
    'images/projects/',
    'documents/',
];

$allowed = false;
foreach ($allowedPrefixes as $prefix) {
    if (str_starts_with($decodedPath, $prefix)) {
        $allowed = true;
        break;
    }
}

echo "Route Whitelist Check: " . ($allowed ? "PASSED" : "FAILED") . "\n";
