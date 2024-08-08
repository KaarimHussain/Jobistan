<?php

// declare(strict_types=1);

// require_once 'vendor/autoload.php';

// use PhpOffice\PhpWord\Settings;
// use PhpOffice\PhpWord\PhpWord;
// use PhpOffice\PhpWord\IOFactory;

// $phpWord = new PhpWord();

// $section = $phpWord->addSection();

// $data = json_decode(file_get_contents("php://input"), true);

// $fullName = $data['full_name'];
// $email = $data['email'];
// $phone = $data['phone'];
// $education = $data['education'];
// $experience = $data['experience'];
// $skills = $data['skills'];

// $section->addText("Resume for $fullName", ['size' => 16, 'bold' => true]);
// $section->addText("Email: $email");
// $section->addText("Phone: $phone");
// $section->addText("Education:\n$education");
// $section->addText("Work Experience:\n$experience");
// $section->addText("Skills:\n$skills");

// $fileName = $fullName . '_resume.docx';
// $tempFile = tempnam(sys_get_temp_dir(), 'resume');
// $phpWord->save($tempFile);

// header("Content-Description: File Transfer");
// header("Content-Type: application/octet-stream");
// header("Content-Disposition: attachment; filename=\"$fileName\"");
// header("Content-Length: " . filesize($tempFile));
// readfile($tempFile);

// unlink($tempFile);

declare(strict_types=1);

require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Language;

$phpWord = new PhpWord();

$phpWord->setDefaultFontName('Calibri');
$phpWord->setDefaultFontSize(11);

$section = $phpWord->addSection();

$data = json_decode(file_get_contents("php://input"), true);

$fullName = $data['full_name'];
$email = $data['email'];
$phone = $data['phone'];
$education = $data['education'];
$experience = $data['experience'];
$skills = $data['skills'];

$titleFontStyle = array('size' => 18, 'bold' => true, 'color' => '#2e74b5');
$section->addText("$fullName", $titleFontStyle);
$section->addTextBreak(1);

$contactFontStyle = array('size' => 12);
$section->addText("Email: $email", $contactFontStyle);
$section->addText("Phone: $phone", $contactFontStyle);
$section->addTextBreak(1);

$section->addText("Education", array('size' => 14, 'bold' => true, 'color' => '#2e74b5'));
$section->addText("$education");
$section->addTextBreak(1);

$section->addText("Work Experience", array('size' => 14, 'bold' => true, 'color' => '#2e74b5'));
$section->addText("$experience");
$section->addTextBreak(1);

$section->addText("Skills", array('size' => 14, 'bold' => true, 'color' => '#2e74b5'));
$section->addText("$skills");
$section->addTextBreak(1);

$fileName = $fullName . '_resume.docx';
$tempFile = tempnam(sys_get_temp_dir(), 'resume');
$phpWord->save($tempFile);

header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Length: " . filesize($tempFile));
readfile($tempFile);

unlink($tempFile);


?>
