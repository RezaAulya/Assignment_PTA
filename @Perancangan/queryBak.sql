SELECT tugas.tugasid, tugas.nama_tugas, tugas.deskripsi, tugas.file_name, 
IFNULL(tugasinfo.deadline, '-') AS deadline, 
IFNULL(kelas.kelas_nama, '-') AS kelas_nama 
FROM tugas 
LEFT JOIN tugasinfo ON tugas.tugasid = tugasinfo.tugasid 
LEFT JOIN kelas ON tugasinfo.kelasid = kelas.kelasid 
WHERE 
tugasinfo.kelasid = '2' 
GROUP BY tugas.tugasid;




SELECT quiz.quizid, quiz.quiz_nama, quiz_kategori.nama_kategori, quiz.waktu, 
IFNULL(quiz_start.end_date, '-') AS end_date 
FROM quiz
JOIN quiz_kategori ON quiz.idkategori = quiz_kategori.id 
LEFT JOIN quiz_start ON quiz_start.quizid = quiz.quizid 
LEFT JOIN kelas ON quiz_start.kelasid = kelas.kelasid 
WHERE kelas.kelasid = '1';



SELECT COUNT(tugasinfo.path_jawaban) AS YangSudah, COUNT(tugasinfo.tugasid) AS totalMhs FROM tugasinfo WHERE tugasinfo.tugasid=1



SELECT ISNULL(NULLIF(tugasinfo.path_jawaban,'')) AS CEK1 
FROM tugasinfo

SELECT COUNT(tugasid) AS totalMhs ,
IFNULL(NULL, '-') AS YangSudah
FROM tugasinfo 
WHERE tugasinfo.tugasid = 1


SELECT IFNULL(tugasinfo.path_jawaban, '-') AS YangSudah, Count(*) as totalMhs 
FROM tugasinfo 
WHERE tugasinfo.tugasid=1


select count(*) AS total
from
(
  select count(tugasinfo.path_jawaban) tot  -- add alias
  from tugasinfo
  where tugasinfo.tugasid =1 
  group by tugasinfo.path_jawaban
) src;select count(*) AS total
from
(
  select count(tugasinfo.path_jawaban) tot  -- add alias
  from tugasinfo
  where tugasinfo.tugasid =1 
  group by tugasinfo.path_jawaban
) src;