<?php
require 'vendor/autoload.php'; // Ensure Composer's autoload is included

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Media\Video;

// Initialize FFMpeg
$ffmpeg = FFMpeg::create([
    'ffmpeg.binaries'  => 'C:\Users\USER\AppData\Local\Microsoft\WinGet\Packages\Gyan.FFmpeg.Essentials_Microsoft.Winget.Source_8wekyb3d8bbwe\ffmpeg-7.0.2-essentials_build\bin\ffmpeg.exe', // Path to ffmpeg executable
    'ffprobe.binaries' => 'C:\Users\USER\AppData\Local\Microsoft\WinGet\Packages\Gyan.FFmpeg.Essentials_Microsoft.Winget.Source_8wekyb3d8bbwe\ffmpeg-7.0.2-essentials_build\bin\ffprobe.exe', // Correct path to ffprobe executable
]);

$ffprobe = FFProbe::create([
    'ffprobe.binaries' => 'C:\Users\USER\AppData\Local\Microsoft\WinGet\Packages\Gyan.FFmpeg.Essentials_Microsoft.Winget.Source_8wekyb3d8bbwe\ffmpeg-7.0.2-essentials_build\bin\ffprobe.exe', // Path to ffprobe executable
]);

// Open a video file
$video = $ffmpeg->open('report-uploads/MBYI9054.MOV');

// Get video format



// Convert video


echo "Video conversion completed!";
?>
