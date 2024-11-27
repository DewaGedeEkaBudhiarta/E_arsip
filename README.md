# E_arsip
 e-arsip project for LLDIKTI VIII
# create a database named el-arsip
# create a table manually for files and file_user using sql
<!-- files table -->
CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_klasifikasi VARCHAR(255),
    no_berkas VARCHAR(255),
    file_name VARCHAR(255),
    kurun_waktu VARCHAR(255),
    indeks VARCHAR(255),
    keterangan TEXT,
    classification VARCHAR(255),
    kelas VARCHAR(255),
    file_path VARCHAR(255),
    user_id INT,
    status VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

<!-- file_user table -->
CREATE TABLE file_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_id INT,
    user_id INT,
    classification VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (file_id) REFERENCES files(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
# recomended uncoment section for this project in your php.ini 
1. type in your comand promt php --ini, then it will show the file right click the php.ini directory
2. uncoment the section of
<!--to make the export function work-->
extension_dir = "ext" 
<!-- Maximum allowed size for uploaded files. you can change it as you need-->
upload_max_filesize = 10M 
<!-- Maximum number of files that can be uploaded via a single request. you can change it as you need -->
max_file_uploads = 20 
<!-- the extention to use sql in the project -->
extension=curl
extension=fileinfo
extension=gd
extension=mbstring
extension=mysqli
extension=odbc
extension=openssl
extension=pdo_mysql
extension=zip


