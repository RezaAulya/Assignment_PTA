
  SELECT dosen.nama_lengkap as dari, dosen.id as idDosen,
   dosen.username as potoDosen,
   notif_mhs.notif_msg, notif_mhs.notif_date,
    kelas.kelas_nama, notif_mhs.kelasid 
   FROM notif_mhs 
   JOIN dosen ON notif_mhs.userid_from = dosen.id 
   JOIN kelas ON notif_mhs.kelasid = kelas.kelasid 
   WHERE notif_mhs.userid_to = '4'
    ORDER BY notif_mhs.notif_date DESC;


SELECT tugasinfo.tugasinfoid, tugasinfo.nilai, tugas.nama_tugas,
 tugas.deskripsi, kelas.kelas_code 
 FROM tugasinfo 
 JOIN tugas ON tugasinfo.tugasid = tugas.tugasid
  JOIN kelas ON tugasinfo.kelasid = kelas.kelasid
   WHERE tugasinfo.userid = '4' AND tugas.pengajarid = '1'
    AND tugasinfo.nilai >= 0

SELECT tugas.tugasid, tugas.nama_tugas, tugas.deskripsi,
 tugas.file_name, IFNULL(tugasinfo.deadline, '-') AS deadline,
  IFNULL(kelas.kelas_nama, '-') AS kelas_nama 
  FROM tugas 
  LEFT JOIN tugasinfo ON tugas.tugasid = tugasinfo.tugasid 
  LEFT JOIN kelas ON tugasinfo.kelasid = kelas.kelasid 
  WHERE tugasinfo.kelasid = '$get_id' 
  GROUP BY tugas.tugasid;


(SELECT quiz.quiz_nama, quiz.pengajarid AS idDosen 
FROM quiz
LEFT JOIN quiz_nilai ON quiz.quizid = quiz_nilai.quizid)
(SELECT kelas.kelasid, kelas.dibuat_oleh 
FROM kelas
LEFT JOIN dosen ON kelas.dibuat_oleh = dosen.nama_lengkap)


SELECT mahasiswa.id, quiz.quiz_nama, mahasiswa.nama_lengkap 
FROM quiz 
  JOIN quizinfo ON quiz.quizid = quizinfo.quizid 
  JOIN quiz_temp ON quizinfo.infoid = quiz_temp.idsoal 
  JOIN mahasiswa ON quiz_temp.mahasiswaid = mahasiswa.id 
  JOIN quiz_start ON quiz.quizid = quiz_start.quizid 
WHERE quiz_start.kelasid = '1' 
  GROUP BY mahasiswa.nama_lengkap


  

  SELECT notif_dosen.notif_date, mahasiswa.nama_lengkap as dari, mahasiswa.id as idMhs, mahasiswa.username as potoMhs, notif_dosen.notif_msg FROM notif_dosen JOIN mahasiswa ON notif_dosen.userid_from = mahasiswa.id WHERE notif_dosen.kelasid = '1'  ORDER BY notif_dosen.notif_date DESC;


  SELECT notif_dosen.notif_date, mahasiswa.nama_lengkap as dari, notif_dosen.notif_msg 
  FROM notif_dosen 
  JOIN mahasiswa ON notif_dosen.userid_from = mahasiswa.id
  WHERE notif_dosen.kelasid = '2'
  ORDER BY notif_dosen.notif_date DESC;



  SELECT dosen.nama_lengkap as dari, dosen.id as idDosen, dosen.username as potoDosen, notif_mhs.notif_msg, notif_mhs.notif_date FROM notif_mhs JOIN dosen ON notif_mhs.userid_from = dosen.id JOIN kelas ON notif_mhs.kelasid = kelas.kelasid WHERE notif_mhs.kelasid = '1' ORDER BY notif_mhs.notif_date DESC LIMIT 10;



  SELECT * FROM tugasinfo JOIN tugas ON tugasinfo.tugasid = tugas.tugasid WHERE tugasinfo.path_jawaban IS NULL AND tugasinfo.deadline > NOW() AND tugasinfo.userid = '$userid' AND tugasinfo.kelasid = '1'

  SELECT COUNT(tugasinfo.kelasid) AS CEK FROM tugasinfo WHERE tugasinfo.kelasid =1 ;

  DELETE FROM kelasinfo WHERE kelasinfo.kelasid = '1';
  

  SELECT kelas.kelasid, kelas.kelas_nama FROM kelasinfo JOIN kelas ON kelasinfo.kelasid = kelas.kelasid WHERE kelasinfo.mahasiswaid ='4';


