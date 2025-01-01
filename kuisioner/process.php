<?php
include '../server/db.php';

session_start(); // Start the session to access session variables

if (!isset($_SESSION['id'])) {
    die("Error: Alumni ID is not set in the session.");
}

$alumni_id = $_SESSION['id']; // Get the alumni ID from the session

//ambil data
$alamat = $_POST['alamat'];
$provinsi = $_POST['provinsi'];
$kabupaten = $_POST['kabupaten'];
$kode_pos = $_POST['kode_pos'];
$nomor_hp = $_POST['nomor_hp'];
$email = $_POST['email'];
$jenis_kelamin = $_POST['jenis_kelamin'];
// Ambil data kuisioner dengan isset untuk memastikan nilai default jika tidak ada
$q13a = ($_POST['q13a']);
$q14 = isset($_POST['q14']) ? $_POST['q14'] : NULL;
$q14a = isset($_POST['q14a']) ? $_POST['q14a'] : NULL;
$q15a = isset($_POST['q15a']) ? $_POST['q15a'] : NULL;
$q15b = isset($_POST['q15b']) ? $_POST['q15b'] : NULL;
$q15c = isset($_POST['q15c']) ? $_POST['q15c'] : NULL;
$q16 = isset($_POST['q16']) ? $_POST['q16'] : NULL;
$q17 = isset($_POST['q17']) ? $_POST['q17'] : NULL;
$q18 = isset($_POST['q18']) ? $_POST['q18'] : NULL;
$q19 = isset($_POST['q19']) ? $_POST['q19'] : NULL;
$q20 = isset($_POST['q20']) ? $_POST['q20'] : NULL;
$q21 = isset($_POST['q21']) ? $_POST['q21'] : NULL;
$q22 = isset($_POST['q22']) ? $_POST['q22'] : NULL;
$q23 = isset($_POST['q23']) ? $_POST['q23'] : NULL;
$q24 = isset($_POST['q24']) ? $_POST['q24'] : NULL;
$q25 = isset($_POST['q25']) ? $_POST['q25'] : NULL;
$q26 = isset($_POST['q26']) ? $_POST['q26'] : NULL;
$q27 = isset($_POST['q27']) ? $_POST['q27'] : NULL;
$q28 = isset($_POST['q28']) ? $_POST['q28'] : NULL;
$q29 = isset($_POST['q29']) ? $_POST['q29'] : NULL;
$q30 = isset($_POST['q30']) ? $_POST['q30'] : NULL;
$q31 = isset($_POST['q31']) ? $_POST['q31'] : NULL;
$q32 = isset($_POST['q32']) ? $_POST['q32'] : NULL;
$q33 = isset($_POST['q33']) ? $_POST['q33'] : NULL;
$q34 = isset($_POST['q34']) ? $_POST['q34'] : NULL;
$q35 = ($_POST['q35']);
$q36 = ($_POST['q36']);
$q37 = ($_POST['q37']);
$q38 = isset($_POST['q38']) ? $_POST['q38'] : NULL;
$q39 = ($_POST['q39']);
$q39a = isset($_POST['q39a']) ? $_POST['q39a'] : NULL;
// Questionnaire 40
$q40a = ($_POST['q40a']);
$q40b = ($_POST['q40b']);
$q40c = ($_POST['q40c']);
$q40d = ($_POST['q40d']);
$q40e = ($_POST['q40e']);
$q40f = ($_POST['q40f']);
// Questionnaire 41
$q41a = $_POST['q41a'];
$q41b = $_POST['q41b'];
$q41c = $_POST['q41c'];
$q41d = $_POST['q41d'];
$q41e = $_POST['q41e'];
// Questionnaire 42
$q42a = $_POST['q42a'];
$q42b = $_POST['q42b'];
$q42c = $_POST['q42c'];
$q42d = $_POST['q42d'];
$q42e = $_POST['q42e'];
$q42f = $_POST['q42f'];
$q42g = $_POST['q42g'];
$q42h = $_POST['q42h'];
$q42i = $_POST['q42i'];
$q42j = $_POST['q42j'];
$q42k = $_POST['q42k'];
// Questionnaire 43
$q43a = $_POST['q43a'];
$q43b = $_POST['q43b'];
$q43c = $_POST['q43c'];
$q43d = $_POST['q43d'];
$q43e = $_POST['q43e'];
$q43f = $_POST['q43f'];
$q43g = $_POST['q43g'];
// Questionnaire 44
$q44a = $_POST['q44a'];
$q44b = $_POST['q44b'];
$q44c = $_POST['q44c'];
$q44d = $_POST['q44d'];
$q44e = $_POST['q44e'];
$q44f = $_POST['q44f'];
$q44g = $_POST['q44g'];
$q44h = $_POST['q44h'];
$q44i = $_POST['q44i'];
$q44j = $_POST['q44j'];
$q44k = $_POST['q44k'];
$q44l = $_POST['q44l'];
$q44m = $_POST['q44m'];
$q44n = $_POST['q44n'];
$q44o = $_POST['q44o'];
$q44p = $_POST['q44p'];
$q44q = $_POST['q44q'];
$q44r = $_POST['q44r'];
// Questionnaire 45
$q45a = $_POST['q45a'];
$q45b = $_POST['q45b'];
$q45c = $_POST['q45c'];
$q45d = $_POST['q45d'];
$q45e = $_POST['q45e'];
$q45f = $_POST['q45f'];
// Questionnaire 46
$q46a = $_POST['q46a'];
$q46b = $_POST['q46b'];
$q46c = $_POST['q46c'];
$q46d = $_POST['q46d'];
$q46e = $_POST['q46e'];
$q46f = $_POST['q46f'];
$q46g = $_POST['q46g'];
$q46h = $_POST['q46h'];
$q46i = $_POST['q46i'];
$q46j = $_POST['q46j'];
$q46k = $_POST['q46k'];
$q46l = $_POST['q46l'];
$q46m = $_POST['q46m'];
$q46n = $_POST['q46n'];
$q46o = $_POST['q46o'];
$q46p = $_POST['q46p'];
$q46q = $_POST['q46q'];
$q46r = $_POST['q46r'];
//tambahan kuisioner
$q47 = $_POST['q47'];
$q48 = $_POST['q48'];
$q49 = $_POST['q49'];
$q49a = isset($_POST['q49a']) ? $_POST['q49a'] : null;
$q50 = $_POST['q50'];
$q50a = isset($_POST['q50a']) ? $_POST['q50a'] : null;


// SQL untuk menyisipkan data
$sql = "INSERT INTO kuisioner (
    alumni_id, alamat, provinsi_id, kabupaten_id, kode_pos, nomor_hp, email, jenis_kelamin, 
    q13a, q14, q14a, q15a, q15b, q15c, q16, q17, q18, q19, q20, q21, q22, q23, q24, q25, q26, q27, q28, q29, q30, q31, q32, q33, q34, q35, q36, q37, q38, q39, q39a, q40a, q40b, q40c, q40d, q40e, q40f,
    q41a, q41b, q41c, q41d, q41e,
    q42a, q42b, q42c, q42d, q42e, q42f, q42g, q42h, q42i, q42j, q42k,
    q43a, q43b, q43c, q43d, q43e, q43f, q43g, 
    q44a, q44b, q44c, q44d, q44e, q44f, q44g, q44h, q44i, q44j, q44k, q44l, q44m, q44n, q44o, q44p, q44q, q44r,
    q45a, q45b, q45c, q45d, q45e, q45f,
    q46a, q46b, q46c, q46d, q46e, q46f, q46g, q46h, q46i, q46j, q46k, q46l, q46m, q46n, q46o, q46p, q46q, q46r,
    q47, q48, q49, q49a, q50, q50a
) VALUES (
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";

// Siapkan statement
$stmt = $conn->prepare($sql);

// Bind parameter (dengan tipe data yang sesuai)
$stmt->bind_param(
    "isiissssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss",
    $alumni_id,
    $alamat,
    $provinsi,
    $kabupaten,
    $kode_pos,
    $nomor_hp,
    $email,
    $jenis_kelamin,
    $q13a,
    $q14,
    $q14a,
    $q15a,
    $q15b,
    $q15c,
    $q16,
    $q17,
    $q18,
    $q19,
    $q20,
    $q21,
    $q22,
    $q23,
    $q24,
    $q25,
    $q26,
    $q27,
    $q28,
    $q29,
    $q30,
    $q31,
    $q32,
    $q33,
    $q34,
    $q35,
    $q36,
    $q37,
    $q38,
    $q39,
    $q39a,
    $q40a,
    $q40b,
    $q40c,
    $q40d,
    $q40e,
    $q40f,
    $q41a,
    $q41b,
    $q41c,
    $q41d,
    $q41e,
    $q42a,
    $q42b,
    $q42c,
    $q42d,
    $q42e,
    $q42f,
    $q42g,
    $q42h,
    $q42i,
    $q42j,
    $q42k,
    $q43a,
    $q43b,
    $q43c,
    $q43d,
    $q43e,
    $q43f,
    $q43g,
    $q44a,
    $q44b,
    $q44c,
    $q44d,
    $q44e,
    $q44f,
    $q44g,
    $q44h,
    $q44i,
    $q44j,
    $q44k,
    $q44l,
    $q44m,
    $q44n,
    $q44o,
    $q44p,
    $q44q,
    $q44r,
    $q45a,
    $q45b,
    $q45c,
    $q45d,
    $q45e,
    $q45f,
    $q46a,
    $q46b,
    $q46c,
    $q46d,
    $q46e,
    $q46f,
    $q46g,
    $q46h,
    $q46i,
    $q46j,
    $q46k,
    $q46l,
    $q46m,
    $q46n,
    $q46o,
    $q46p,
    $q46q,
    $q46r,
    $q47,
    $q48,
    $q49,
    $q49a,
    $q50,
    $q50a
);

// Eksekusi statement
if ($stmt->execute()) {
    $_SESSION['success_message'] = "Anda telah berhasil mengisi kuisioner. Terima kasih atas partisipasinya!";

    header("Location: ../homepage/homepage.php");
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
