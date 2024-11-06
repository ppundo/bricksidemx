<div class="col-md-12" style="margin-top: 15px;">
<h4 class="col-md-12 p-2 title_sec" > Actualizar foto de perfil</h4>
  
<input type="file" class="form-control no-show" name="file_to_upload" id="file_to_upload" accept=".jpg,.png,.jpeg">

  <div id="drop_zone">  <span class="text-muted"> ARRASTRA FOTO AQUÍ </span>  </div>


  <div class="col-md-12 border">
    <span class="col-md-12 text-muted" id="file_name"></span>
    <progress id="progress_bar" value="0" max="100" style="width:93%;"></progress>
    <span class="col-md-12 text-muted" id="progress_status"></span>
  </div>


  <input class="btn btn-inverse-primary" type="button" value="Subir" id="upload_file_button">
</div>

  <script>

    document.getElementById('file_to_upload').addEventListener('change', (event) => {
      window.selectedFile = event.target.files[0];

        /// Nombre personalizado
        const name = window.selectedFile.name;
        const info_file = name.split('.');
        const ext = info_file[1];
        const new_name = 'profile_'+document.getElementById('user_id').value+'.'+ext;
        ////

        //document.getElementById('file_name').innerHTML = window.selectedFile.name;
        document.getElementById('file_name').innerHTML = new_name;
    });

    document.getElementById('upload_file_button').addEventListener('click', () => {
      uploadFile(window.selectedFile);
    });

    // Getting our drop zone by ID
    const dropZone = document.getElementById('drop_zone');
    if (window.FileList && window.File) {
        dropZone.addEventListener('dragover', event => {
        event.stopPropagation();
        event.preventDefault();

        // Adding a visual hint that the file is being copied to the window
        event.dataTransfer.dropEffect = 'copy';
      });

      dropZone.addEventListener('drop', event => {
        event.stopPropagation();
        event.preventDefault();

        // Accessing the files that are being dropped to the window
        const files = event.dataTransfer.files;

        // Getting the file from uploaded files list (only one file in our case)
        window.selectedFile = files[0];

        /// Nombre personalizado
        const name = window.selectedFile.name;
        const info_file = name.split('.');
        const ext = info_file[1];
        const new_name = 'profile_'+document.getElementById('user_id').value+'.'+ext;
        ////

        // Assigning the name of file to our "file_name" element
       //document.getElementById('file_name').innerHTML = window.selectedFile.name;
       document.getElementById('file_name').innerHTML = new_name;
      });
    }

    function uploadFile(file) {

      /// Nombre personalizado
        const name = window.selectedFile.name;
        const info_file = name.split('.');
        const ext = info_file[1];
        const new_name = 'profile_'+document.getElementById('user_id').value+'.'+ext;
        const file_name_cust = 'profile_'+document.getElementById('user_id').value;
      ////

      const formData = new FormData();
      //formData.append('file_to_upload', file);
      formData.append('file_to_upload', file,new_name);

      const ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.open('POST', 'uploader_profile.php');
      ajax.send(formData);

      actualiza_user_foto(new_name);
    }

    function progressHandler(event) {
      const percent = (event.loaded / event.total) * 100;
      document.getElementById('progress_bar').value = Math.round(percent);
      document.getElementById('progress_status').innerHTML = Math.round(percent) + '% uploaded';
    }

    
  </script>