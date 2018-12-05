<?php

include 'route.php';


$route = new Route();
// ---------------------------------------
// API
// ---------------------------------------
$route->add('/api/dosen', function() {
	// blabla
});
$route->add('/api/dosen/.+', function($id) {
	// blabla/id
});


// ---------------------------------------
// VIEW
// ---------------------------------------
$route->add('/blank', function() {
	include 'views/@blank/index.php';
});
$route->add('/', function() {
	include 'views/dashboard/index.php';
});
$route->add('/homepage', function() {
	include 'views/homepage/index.php';
});
$route->add('/login', function() {
	include 'views/login/index.php';
});
$route->add('/admin', function() {
	include 'views/admin/index.php';
});
$route->add('/logout', function() {
	include 'views/logout/index.php';
});
$route->add('/register', function() {
	include 'views/register/index.php';
});

// ### DASHBOARD
$route->add('/dashboard', function() {
	include 'views/dashboard/index.php';
});
// ### PROFILE
$route->add('/profile', function() {
	include 'views/profile/index.php';
});
$route->add('/profile-edit', function() {
	include 'views/profile/edit.php';
});
$route->add('/profile-cpass', function() {
	include 'views/profile/cpass.php';
});
// ---------------------------------------
// ### DOSEN 
// ---------------------------------------
$route->add('/dosen', function() {
	include 'views/dosen/index.php';
});
$route->add('/dosen-view/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/dosen/view.php';
});
$route->add('/dosen-edit/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/dosen/edit.php';
});
$route->add('/dosen-delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/dosen/delete.php';
});
// ---------------------------------------
// ### MAHASISWA 
// ---------------------------------------
$route->add('/mahasiswa', function() {
	include 'views/mahasiswa/index.php';
});
$route->add('/mahasiswa-view/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/mahasiswa/view.php';
});

$route->add('/mahasiswa-edit/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/mahasiswa/edit.php';
});

$route->add('/mahasiswa-delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/mahasiswa/delete.php';
});
// ---------------------------------------
// ### KELAS 
// ---------------------------------------
$route->add('/kelas', function() {
	include 'views/kelas/index.php';
});
$route->add('/kelas-add', function() {
	include 'views/kelas/add.php';
});
$route->add('/kelas-view/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/kelas/view.php';
});
$route->add('/kelas-edit/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/kelas/edit.php';
});
$route->add('/kelas-delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/kelas/delete.php';
});
// ---------------------------------------
// ### TUGAS 
// ---------------------------------------
$route->add('/tugas', function() {
	include 'views/tugas/index.php';
});
$route->add('/tugas-view/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/tugas/view.php';
});

$route->add('/tugas-nilai/.+', function($lpTugasinfoid) {
	include 'views/nilai/index.php';
});

/*$route->add('/tugas-add/', function() { 
	include 'views/tugas/add.php';
});
*/

$route->add('/tugas-delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/tugas/delete.php';
});


// ---------------------------------------
// ### QUIZ - KETEGORI
// ---------------------------------------
$route->add('/quiz/kategori', function() {
	include 'views/quiz/kategori/index.php';
});
$route->add('/quiz/kategori-add', function() { 
	include 'views/quiz/kategori/add.php';
});
$route->add('/quiz/kategori-edit/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/kategori/edit.php';
});
$route->add('/quiz/kategori-delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/kategori/delete.php';
});

// ---------------------------------------
// ### QUIZ - PERTANYAAN
// ---------------------------------------
$route->add('/quiz/pertanyaan/.+', function($id) {
	$_SESSION['getId'] = $id;
	include 'views/quiz/pertanyaan/index.php';
});
$route->add('/quiz/pertanyaan-add', function() {
	include 'views/quiz/pertanyaan/add.php';
});
$route->add('/quiz/pertanyaan-edit/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/pertanyaan/edit.php';
});
$route->add('/quiz/pertanyaan-view/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/pertanyaan/view.php';
});

$route->add('/quiz/pertanyaan-delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/pertanyaan/delete.php';
});

// ---------------------------------------
// ### QUIZ
// ---------------------------------------
$route->add('/quiz', function() {
	include 'views/quiz/index.php';
});
$route->add('/quiz/add', function() { 
	include 'views/quiz/add.php';
});
$route->add('/quiz/add-pertanyaan/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/add-pertanyaan.php';
});
$route->add('/quiz/edit/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/edit.php';
});
$route->add('/quiz/delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/quiz/delete.php';
});

$route->add('/quiz/send/.+/.+', function($idQuiz, $idKelas) { 
	$_SESSION['getId'] = $idQuiz;
	$_SESSION['idKelas'] = $idKelas;
	
	include 'views/quiz/send.php';
});




// ---------------------------------------
// ### MAHASISWA - KELAS
// ---------------------------------------
$route->add('/mhs/kelas', function() {
	include 'views/@mhs/kelas/index.php';
});
$route->add('/mhs/kelas/join', function() {
	include 'views/@mhs/kelas/add.php';
});
$route->add('/mhs/kelas/delete/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/@mhs/kelas/delete.php';
});
$route->add('/mhs/kelas/view/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/@mhs/kelas/view.php';
});
$route->add('/mhs/kelas/join/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/@mhs/kelas/join.php';
});

// ---------------------------------------
// ### MAHASISWA - TUGAS
// ---------------------------------------
$route->add('/mhs/tugas', function() {
	include 'views/@mhs/tugas/index.php';
});

$route->add('/mhs/tugas/view/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/@mhs/tugas/view.php';
});
$route->add('/mhs/tugas/edit/.+', function($id) { 
	$_SESSION['getId'] = $id;
	include 'views/@mhs/tugas/edit.php';
});

// ---------------------------------------
// ### MAHASISWA - QUIZ
// ---------------------------------------

$route->add('/mhs/kelas/do-quiz/.+/.+', function($lpQuizId, $lpKelasId) { 
	$_SESSION['getId'] = $lpQuizId;
	include 'views/@mhs/quiz/index.php';
});


$route->add('/mhs/quiz/countdown', function() { 
	include 'views/@mhs/quiz/countdown.php';
});

$route->add('/mhs/quiz/result/.+', function($lpQuizId) { 
	$_SESSION['getId'] = $lpQuizId;
	include 'views/@mhs/quiz/result.php';
});


$route->add('/xxx', function() { 
	include 'views/tester.php';
});



$route->submit();