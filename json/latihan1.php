<?php
	
	// $mahasiswa = [
	// 	[
	// 		"nama"	=> "andri",
	// 		"npm"	=> "12345",
	// 		"email" => "yaya@ai.com"
	// 	],
	// 	[
	// 		"nama" 	=> "yan",
	// 		"npm" 	=> "0909090",
	// 		"email" =>	"saya@aku.com"
	// 	]
	// ];

	$conn = mysqli_connect('localhost','root','','portal_sso');
	if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
	}
	$query = mysqli_query($conn,'SELECT * FROM m_user LIMIT 5');
		while ($row = mysqli_fetch_assoc($query)) {
			$data[] = $row;
		}

	$json = json_encode($data);
	echo $json;



?>