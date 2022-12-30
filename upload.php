<?php
if(isset($_POST['submit'])) {
  $file = $_FILES['file'];

  // File properties
  $file_name = $file['name'];
  $file_tmp = $file['tmp_name'];
  $file_size = $file['size'];
  $file_error = $file['error'];
  $file_ext = explode('.', $file_name);
  $file_ext = strtolower(end($file_ext));

  // Check for errors
  if($file_error === 0) {
    // Check file size
    if($file_size <= 100000000) {
      // Generate a new file name
      $file_name_new = uniqid('', true) . '.' . $file_ext;
      // Destination folder
      $file_destination = 'uploads/' . $file_name_new;

      // Move the file to the destination folder
      if(move_uploaded_file($file_tmp, $file_destination)) {
        echo "File uploaded successfully!";
      } else {
        echo "There was an error uploading the file.";
      }
    } else {
      echo "The file is too large.";
    }
  } else {
    echo "There was an error uploading the file.";
  }
}