<!DOCTYPE html>
<html lang="en">
<head>
    <title>Siswa</title>
    <link href="<?= base_url("assets/"); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">    
</head>
<body>
    <h1>Testing</h1>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

                <!-- Approach -->
                <div class="card shadow mb-4">
                <div class="card-header py-3">                  
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#modalSiswa"  id="btn-tambahModal"><i class="fas fa-fw fa-plus-circle"></i> Tambah Siswa</a>    
                </div>
                <div class="card-body overflow-scroll"> 
                                    
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap" id="dataTable">
                        <thead>
                            <tr class="text-center bg-info text-white">
                                <th style="width: 50px;">No</th>
                                <th>ID Siswa</th>                                                         
                                <th>Nama</th>                                                         
                                <th>Kelas</th>                                                         
                                <th>Alamat</th>      
                            </tr>
                        </thead>
                        <tbody id="konten-tabel">

                        </tbody>
                        </table>
                    </div>
                </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Modal -->
<div class="modal fade" id="modalSiswa" tabindex="-1" aria-labelledby="modalSiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSiswaLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onClick="simpan()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


    <!-- Modal -->
<div class="modal fade" id="modalLoading" tabindex="-1" aria-labelledby="modalLoadingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoadingLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <span id="status-progress"></span>
        <div class="progress">            
            <div id="my-progress" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url("assets/"); ?>bootstrap/js/jquery-3.6.1.min.js"></script>
<script src="<?= base_url("assets/"); ?>bootstrap/js/popper.min.js"></script>
<script src="<?= base_url("assets/"); ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url("assets/"); ?>sweetalert2/sweetalert2.all.js"></script>

<script>
    $(document).ready(function(){

        getData();
        
        
    });

    function getData(){
            $.ajax({
                url: 'siswa/getData',
                type: 'POST',
                dataType: 'JSON',
                success: function (responsdata) {
                    $('#konten-tabel').html(responsdata);
                }
            });
        }

    async function simpan(){
        $('#modalLoading').modal('show');
        $('#modalSiswa').modal('hide');
        
        let progress = null;
        for (let i=0; i < 100; i++) { 
            progress = Math.round(((i+1)/100) * 100);            
            await doAjax(progress);
        }
        
        getData();
        Swal.fire({
          icon: 'success',
          title: 'Berhasil',
          text: 'Anda berhasil menambahkan 100 data'
        });
        $('#modalLoading').modal('hide');
        

    }

    async function doAjax(progress) {
      let result;

      try {
          result = await $.ajax({                
                              type: 'POST',
                              url: 'siswa/simpanData',
                              contentType: false,
                              cache: false,
                              processData:false,
                              success: function(resp){
                                  $("#my-progress").css('width',progress+'%');                        
                                  $("#my-progress").attr('aria-valuenow',progress);                        
                                  $("#my-progress").html(progress+'%');                        
                                  
                              },
                              async:true
                          });

          return result;
      } catch (error) {
          console.error(error);
      }
  }

    
</script>
</body>
</html>