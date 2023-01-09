@extends('back.layouts.master', ['web' => $web])

@section('title_menu')
    Paket Wedding
@endsection

@section('title')
    Data Paket Wedding
@endsection

@section('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<style>
.dz-image img {
    width: 130px !important;
    height: 130px !important;
    object-fit: cover !important;
}

.dropzone {
    border: 1px solid #e6e6e6 !important;
    border-radius: 4px;
    color: #c8c8c9 !important;
}

label.error {
    color: #F94687;
    font-size: 13px;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    margin-top: 5px;
    padding: 0;
}

input.error {
    color: #F94687;
    border: 1px solid #F94687;
}

textarea.error {
    color: #F94687;
    border: 1px solid #F94687;
}

select.error {
    color: #F94687;
    border: 1px solid #F94687;
}

</style>
@endsection

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="{{ url()->current() }}">Paket Wedding</a></li>
    </ol>
</div>
<!-- row -->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" data-toggle="modal" data-target="#addPaketWeddingModal"
                                class="btn btn-primary btn-sm" data-animation="slide" data-plugin="custommodal"
                                data-overlaySpeed="200" data-overlayColor="#36404a"><i
                                    class="fa fa-plus-circle mr-1"></i> Tambah</button>
            </div>
            <div class="card-body">
                <div class="button-list" style="margin-bottom: 28px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group search-area w-100">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="javascript:void(0)"><i
                                                class="flaticon-381-search-2"></i></a></span>
                                </div>
                                <input type="search" class="form-control" placeholder="Cari Nama Paket Wedding..."
                                    id="paketWeddingVerifiedSearch">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="loadingDivVerified" style="margin-top: 50px; display:none;">
                    <div class="sk-three-bounce">
                        <div class="sk-child sk-bounce1"></div>
                        <div class="sk-child sk-bounce2"></div>
                        <div class="sk-child sk-bounce3"></div>
                    </div>
                </div>
                <div class="row" id="searchResultVerified">
                </div>
                <div class="row" id="wrapVerified">
                    <?php foreach($paket_wedding as $data):  ?>
                    <div class="col-sm-6">
                        <div class="card" style="border: 1px solid #f0f1f5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        @foreach($data->get_first_foto as $foto)

                                        <?php if(!empty($foto->url)) : ?>
                                        <img src="{{ asset('paket_wedding/'. $foto->url)}}"
                                            style="height: 180px !important; width: 100%; object-fit: cover;"
                                            alt="">
                                        <?php else : ?>
                                        <img src="app-assets/images/no-image-icon.png"
                                            class="img-fluid" alt="">
                                        <?php endif; ?>

                                        @endforeach
                                    </div>
                                    <div class="col-6">
                                        <h6><?= $data->nama_paket ?></h6>
                                        <div class="button-list">
                                            <div class="buttons d-flex justify-content-between">
                                                <button type="button" data-toggle="modal" style="width: 100%;"
                                                    data-target="#editPaketWeddingModal"
                                                    onclick="editPaketWeddingFunction({{ $data }})"
                                                    class="btn btn-warning btn-xxs text-white mr-2"><i
                                                        class="fa fa-edit mr-1"></i>Edit
                                                </button>
                                                <button type="button" style="width: 100%;"
                                                    onclick="detailPaketWeddingFunction({{ $data }})"
                                                    data-toggle="modal" data-target="#detailPaketWeddingModal"
                                                    class="btn btn-xxs btn-info" id="detailButton"><i
                                                        class="fa fa-info-circle mr-1"></i> Detail
                                                </button>
                                            </div>
                                            <form action="{{ route('paket-wedding.destroy', $data->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" style="width: 100% !important;"
                                                    onclick="deletePaketWeddingFunction(this)"
                                                    class="btn btn-xxs btn-danger mt-2" id="deleteButton"><i
                                                        class="fa fa-trash mr-1"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    
                    <nav style="width:100% !important;">
                        {{ $paket_wedding->links('vendor.pagination.back') }}
                    </nav>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPaketWeddingModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Paket Wedding</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('paket-wedding.store') }}" method="post" id="addPaketWeddingForm" class="add-paket-wedding-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_paket">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_paket"
                            placeholder="Masukan Nama Paket">
                    </div>

                    <div class="form-group">
                        <label for="harga_paket">Harga Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="harga_paket" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                            placeholder="Masukan Harga Paket">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_paket">Deskripsi Paket <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" style="height: 20vh;"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="add_foto_paket">Foto Paket <span class="text-danger">*</span></label>
                        <div class="needsclick dropzone add-dropzone" id="document-dropzone">
                        </div>
                        <span class="errorAddImage" style="display: none;">Foto Paket harus di isi</span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-sm btn-primary" id="addPaketWeddingButton">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPaketWeddingModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Paket Wedding</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('paket-wedding.update', '') }}" method="post" id="editPaketWeddingForm" class="edit-paket-wedding-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="paket_id">
                    {{-- <input type="hidden" id="get_paket_wedding_id" class="get-paket-wedding-id" name="get_paket_wedding_id"> --}}

                    <div class="form-group">
                        <label for="edit_nama_paket">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="edit_nama_paket"
                            placeholder="Masukan Nama Paket">
                    </div>

                    <div class="form-group">
                        <label for="edit_harga_paket">Harga Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="edit_harga_paket"
                            placeholder="Masukan Harga Paket">
                    </div>

                    <div class="form-group">
                        <label for="edit_deskripsi_paket" class="label-description">Deskripsi Paket <span class="text-danger">*</span></label>
                        <textarea class="form-control edit-description" id="edit-description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="edit_foto_paket">Foto Paket <span class="text-danger">*</span></label>
                        <div class="needsclick dropzone edit-dropzone" id="edit-foto-paket-wedding">
                        </div>
                        <span class="errorEditImage" style="display: none;">Foto Paket harus di isi</span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-sm btn-primary edit-paket-wedding-button" id="editPaketWeddingButton">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detailPaketWeddingModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Paket Wedding</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body" style="border: 1px solid #f0f1f5;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h5>Nama Paket</h5>
                                    <p id="detail_nama_paket"></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h5>Harga Paket</h5>
                                    <p id="detail_harga_paket"></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h5>Deskripsi Paket</h5>
                                    <p id="detail_deskripsi_paket"></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h5>Foto Paket</h5>
                                <div class="row" id="galleryId">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('vendor/global/global.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/deznav-init.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
 <!-- CONVERT NUMBER TO RUPIAH CURRENCY -->
<script src="https://unpkg.com/@develoka/angka-terbilang-js/index.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
      CKEDITOR.replace('description');
</script>

<script>
    (function($) {
        $.fn.simpleMoneyFormat = function() {
            this.each(function(index, el) {
                var elType = null; // input or other
                var value = null;
                // get value
                if ($(el).is('input') || $(el).is('textarea')) {
                    value = $(el).val().replace(/\./g, '');
                    elType = 'input';
                } else {
                    value = $(el).text().replace(/\./g, '');
                    elType = 'other';
                }
                // if value changes
                $(el).on('paste keyup', function() {
                    value = $(el).val().replace(/\./g, '');
                    formatElement(el, elType, value); // format element
                });
                formatElement(el, elType, value); // format element
            });

            function formatElement(el, elType, value) {
                var result = '';
                var valueArray = value.split('');
                var resultArray = [];
                var counter = 0;
                var temp = '';
                for (var i = valueArray.length - 1; i >= 0; i--) {
                    temp += valueArray[i];
                    if (valueArray[i] != ',') {
                        counter++
                    } else if (counter == 1) {
                        counter = counter - 1;
                    } else if (counter == 2) {
                        counter = counter - 2;
                    } else if (counter == 3) {
                        counter = counter - 3;
                    }

                    if (counter == 3) {
                        resultArray.push(temp);
                        counter = 0;
                        temp = '';
                    }
                };
                if (counter > 0) {
                    resultArray.push(temp);
                }
                for (var i = resultArray.length - 1; i >= 0; i--) {
                    var resTemp = resultArray[i].split('');
                    for (var j = resTemp.length - 1; j >= 0; j--) {
                        result += resTemp[j];
                    };
                    if (i > 0) {
                        result += '.'
                    }
                };
                if (elType == 'input') {
                    $(el).val(result);
                } else {
                    $(el).empty().text(result);
                }
            }
        };
    }(jQuery));

    $('.money').simpleMoneyFormat();
</script>
<script>
$(document).ready(function() {
  $(document).on('click', '.page-link', function(event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      pagination(page);
  });

  function pagination(page)
  {
    var _token = $("input[name=_token]").val();
    $.ajax({
      url: "{{ route('paket-wedding.paginate') }}",
      method: "POST",
      data: {_token:"{{ csrf_token() }}", page:page},
      success: function(data) {
        $('#wrapVerified').html(data);
      }
    });
  }
})
$("#paketWeddingVerifiedSearch").keyup(function() {

    var search = $("#paketWeddingVerifiedSearch").val();

    $("#loadingDivVerified").show();
    $("#wrapVerified").css('display', 'none');
    $('#searchResultVerified').css('display', 'none');

    $.ajax({
        url: "{{ route('paket-wedding.search') }}",
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            search: search
        },
        success: function(data) {
            if (search == "") {
                $("#loadingDivVerified").hide();
                $('#searchResultVerified').html("");
                // $("#kegiatanVerifiedSearch").val("");
                $("#wrapVerified").css('display', 'flex');
            } else {
                $("#loadingDivVerified").hide();
                $('#searchResultVerified').html(data);
                // $("#kegiatanVerifiedSearch").val(data);
                $('#searchResultVerified').css('display', 'flex');
                $("#wrapVerified").css('display', 'none');
            }
        }
    });
});
</script>
<script>
     // Paket Wedding 
    const updatePaketWeddingLink = $('.edit-paket-wedding-form').attr('action');
    const idPaketWeddingForm = $('.edit-paket-wedding-form').attr('id');
    const idPaket = $('.get-paket-wedding-id').attr('id');
    const editPaketWeddingButton = $('.edit-paket-wedding-button').attr('id');

    // const editDescription = $('.edit-description').attr('id');

    // var editorInstance;

    CKEDITOR.replace('edit-description');
    function editPaketWeddingFunction(data) {

        // $(".label-description").remove();
        // $(".label-description").append('<textarea class="form-control edit-description" id="edit-description"></textarea>');

       
        CKEDITOR.instances['edit-description'].setData(data.deskripsi_paket);

    

        // $('.edit-paket-wedding-form').attr('id', 'editPaketWeddingForm');
        // $('#get_paket_wedding_id').attr('id', 'get_paket_wedding_id');
        // $('#editPaketWeddingButton').attr('id', 'editPaketWeddingButton');

        // make form id unique for jquery validaiton
        $('.edit-paket-wedding-form').attr('id', `${idPaketWeddingForm}${data.id}`);
        // $('#get_paket_wedding_id').attr('id', `${idPaket}${data.id}`);

        $('.edit-paket-wedding-button').attr('id', `${editPaketWeddingButton}${data.id}`);
        $('.edit-paket-wedding-form').attr('action', `${updatePaketWeddingLink}/${data.id}`);

        $('[name="paket_id"]').val(data.id);
        // $('[name="get_paket_wedding_id"]').val(data.id);
        $('[name="edit_nama_paket"]').val(data.nama_paket);
        $('[name="edit_harga_paket"]').val(data.harga_paket);
      
        $('[name="edit_foto_paket"]').val(data.foto_paket);
        + $('input[name="paket_id"]').val()
        validateEdit(data.id);
    }


    function detailPaketWeddingFunction(data) {
        $("#galleryId").html("");
        

        // $('[name="get_paket_wedding_id"]').val(dataId);
        $('#detail_nama_paket').html(data.nama_paket);
        $('#detail_harga_paket').html(data.harga_paket);
        $('#detail_deskripsi_paket').html(data.deskripsi_paket);

        $.ajax({
            url: "{{ route('paket-wedding.getFotoPaket') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                paket_wedding_id: data.id
            },
            success: function(result) {
                // fotoPaketWedding = $.parseJSON(result);
                for (const [key, value] of Object.entries(result)) {
                    $("#galleryId").append('<a class="col-sm-4" data-fancybox="gallery" href="' +
                        `{{ asset('paket_wedding') }}/` + value.url +
                        '"></div><img class="img-fluid rounded" style="height: 150px; object-fit: cover;" src="' +
                        `{{ asset('paket_wedding') }}/` + value.url + '"/></a>');

                    // <a data-fancybox="gallery" href="https://lipsum.app/id/60/1600x1200">
                    //                     <img class="rounded" src="https://lipsum.app/id/60/200x150" /></a>
                }
            }
        });
    }
</script>

<script>
    $("#addPaketWeddingForm").validate({
        rules: {
            nama_paket: {
                required: true,
            },
            harga_paket: {
                required: true,
            }
        },
        messages: {
            nama_paket: {
                required: "Nama Paket harus di isi.",
            },
            harga_paket: {
                required: "Harga Paket harus di isi.",
            }
        },
        submitHandler: function(form) {
         
        }
    });

    function validateEdit(id) {
        $("#editPaketWeddingForm" + id).validate({
            rules: {
                edit_nama_paket: {
                    required: true,
                },
                edit_harga_paket: {
                    required: true,
                }
            },
            messages: {
                edit_nama_paket: {
                    required: "Nama Paket harus di isi.",
                },
                edit_harga_paket: {
                    required: "Harga Paket harus di isi.",
                }
            },
            submitHandler: function(form) {
            
            }
        });
    }
    
</script>

<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('paket-wedding.store') }}',
        maxFilesize: 20, // MB
        addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 10,
        autoDiscover : false,
        uploadMultiple: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        processData: false,
        contentType: false,
        dictDefaultMessage: "Upload Foto Paket Wedding",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            Swal.fire({
                title: 'Berhasil',
                text: "Data Paket Wedding telah berhasil ditambahkan!",
                icon: 'success',
                confirmButtonColor: '#7066e0',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                } else {
                    location.reload();
                }
            })
        },
        init: function() {
            var myDropzone = this;


            $("#addPaketWeddingButton").click(function() {
                if (myDropzone.getQueuedFiles().length > 0) {
                    $(".dropzone").css("cssText",
                        "border: 1px solid #e6e6e6 !important; color: #c8c8c9 !important;");
                    $(".errorAddImage").css("cssText", "display: none !important;");
                } else {
                    $(".dropzone").css("cssText",
                        "border: 1px solid #f1556c !important; color: #f1556c !important;");
                    $(".errorAddImage").css("cssText",
                        "display: block !important; color: #f1556c; font-size: .875rem; font-weight: 400; line-height: 1.5; margin-top: 5px; padding: 0;"
                    );
                }

                if (myDropzone.getQueuedFiles().length > 0 && $('#addPaketWeddingForm').valid()) {
                    $('#addPaketWeddingForm').prepend('<input type="hidden" name="deskripsi_paket" value="' + CKEDITOR.instances['description'].getData() + '">');
                    $('#addPaketWeddingForm').submit();
                    myDropzone.processQueue();
                    $("#addPaketWeddingButton").prop('disabled', true);
                } else {
                    $("#addPaketWeddingButton").prop('disabled', false);
                }
            });

            this.on("addedfiles", function(files) {
                $("#addPaketWeddingButton").click(function(e) {
                    if (!$('#addPaketWeddingForm').valid()) {
                        $("#addPaketWeddingButton").prop('disabled', false);
                    } else {
                        $("#addPaketWeddingButton").prop('disabled', true);

                        myDropzone.processQueue();
                    }
                });

                if (myDropzone.getQueuedFiles().length > 0) {
                    $(".dropzone").css("cssText",
                        "border: 1px solid #e6e6e6 !important; color: #c8c8c9 !important;");
                    $(".errorAddImage").css("cssText", "display: none !important;");
                } else {
                    $(".dropzone").css("cssText",
                        "border: 1px solid #f1556c !important; color: #f1556c !important;");
                    $(".errorAddImage").css("cssText",
                        "display: block !important; color: #f1556c; font-size: .875rem; font-weight: 400; line-height: 1.5; margin-top: 5px; padding: 0;"
                    );
                }

            });

            this.on('sendingmultiple', function(file, xhr, formData) {
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#addPaketWeddingForm').serializeArray();

                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });

            });
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
        }
    }
</script>

<script>
    var uploadedEditDocumentMap = {}
    Dropzone.options.editFotoPaketWedding = {
        url: 'paket-wedding/update/',
        maxFilesize: 20, // MB
        addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 10,
        uploadMultiple: true,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        dictDefaultMessage: "Seret foto kesini untuk mengunggah",
        dictRemoveFile: "Hapus Foto",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
           
                Swal.fire({
                title: 'Berhasil',
                text: "Data Paket Wedding telah berhasil diubah!",
                icon: 'success',
                confirmButtonColor: '#7066e0',
                confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "{{ route('paket-wedding.index') }}";
                    } else {
                        window.location = "{{ route('paket-wedding.index') }}";
                    }
                })
           
        },
        init: function() {
            var myEditDropzone = this;

            $('#editPaketWeddingModal').on('shown.bs.modal', function(e) {
                $(".dz-preview").remove();

                var paket_wedding_id = $('input[name="paket_id"]').val();

                myEditDropzone.options.url = '{{ route('paket-wedding.update', '') }}' + "/" + paket_wedding_id;


                $.ajax({
                    url: '{{ route('paket-wedding.getFotoPaket') }}',
                    type: 'POST',
                    data: {
                        paket_wedding_id: paket_wedding_id
                    },
                    success: function(result) {

                        for (const [key, value] of Object.entries(result)) {

                            console.log(value.url);

                            var file = value;
                            myEditDropzone.emit("addedfile", file);
                            myEditDropzone.emit("thumbnail", file, "{{ asset('paket_wedding') }}/" + value.url);
                            myEditDropzone.emit("complete", file);

                        }
                    }
                });

            });

            $('#editPaketWeddingModal').on('hidden.bs.modal', function(e) {
                $(".set-photo").remove();
            });



            $("#editPaketWeddingButton" + $('input[name="paket_id"]').val()).click(function() {
                var paketId = $('input[name="paket_id"]').val();
                var checkImage = document.getElementsByClassName('dz-preview');

                if (checkImage.length > 0) {
                    $(".edit-dropzone").css("cssText",
                        "border: 1px solid #e6e6e6 !important; color: #c8c8c9 !important;");
                    $(".errorEditImage").css("cssText", "display: none !important;");
                } else {
                    $(".edit-dropzone").css("cssText",
                        "border: 1px solid #f1556c !important; color: #f1556c !important;");
                    $(".errorEditImage").css("cssText",
                        "display: block !important; color: #f1556c; font-size: .875rem; font-weight: 400; line-height: 1.5; margin-top: 5px; padding: 0;"
                    );
                }

                if (checkImage.length > 0 && $('#editPaketWeddingForm' + $('input[name="paket_id"]').val()).valid()) {
                    $('#editPaketWeddingForm' + $('input[name="paket_id"]').val()).prepend('<input type="hidden" name="edit_deskripsi_paket" value="' + CKEDITOR.instances['edit-description'].getData() + '">');

                    myEditDropzone.processQueue();

                    $('#editPaketWeddingForm' + $('input[name="paket_id"]').val())[0].submit();

                    $("#editPaketWeddingButton" + $('input[name="paket_id"]').val()).prop('disabled', true);
                } else {
                    $("#editPaketWeddingButton" + $('input[name="paket_id"]').val()).prop('disabled', false);
                }

            });

            this.on("addedfiles", function(files) {
                $("#editPaketWeddingButton" + $('input[name="paket_id"]').val()).click(function(e) {
                    var paketId = $('input[name="paket_id"]').val();

                    // var getPaketWeddingId = $('#get_paket_wedding_id' + paketId).val();
                    if (!$('#editPaketWeddingForm' + $('input[name="paket_id"]').val()).valid()) {
                        $("#editPaketWeddingButton" + $('input[name="paket_id"]').val()).prop('disabled', false);
                    } else {
                        // $("#editIndikatorKhususButton").prop('disabled', true);

                        myEditDropzone.processQueue();
                    }
                });

                var checkImage = document.getElementsByClassName('dz-preview');
                if (checkImage.length > 0) {
                    $(".edit-dropzone").css("cssText",
                        "border: 1px solid #e6e6e6 !important; color: #c8c8c9 !important;");
                    $(".errorEditImage").css("cssText", "display: none !important;");
                } else {
                    $(".edit-dropzone").css("cssText",
                        "border: 1px solid #f1556c !important; color: #f1556c !important;");
                    $(".errorEditImage").css("cssText",
                        "display: block !important; color: #f1556c; font-size: .875rem; font-weight: 400; line-height: 1.5; margin-top: 5px; padding: 0;"
                    );
                }
            });

            this.on('sendingmultiple', function(file, xhr, formData) {
                var paketId = $('input[name="paket_id"]').val();

                // var getPaketWeddingId = $('#get_paket_wedding_id' + paketId).val();
                // Append all form inputs to the formData Dropzone will POST
                var data = $('#editPaketWeddingForm' + $('input[name="paket_id"]').val()).serializeArray();

                $.each(data, function(key, el) {
                    formData.append(el.name, el.value);
                });
            });
     

        },
        removedfile: function(file) {
            Swal.fire({
                title: "Hapus Foto?",
                text: `Apakah anda yakin untuk menghapus foto ini?`,
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "rgb(11, 42, 151)",
                cancelButtonColor: "rgb(209, 207, 207)",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then(function(t) {
                if (t.value) {
                    var token = '{{ csrf_token() }}';

                    var paketId = $('input[name="paket_id"]').val();

                    $('#editPaketWeddingForm' + $('input[name="paket_id"]').val()).prepend(
                        '<input type="hidden" name="photo[]" value="' + file.id + '">'
                    )

                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedEditDocumentMap[file.name]
                    }

                    $('#editPaketWeddingForm' + $('input[name="paket_id"]').val()).find(
                        'input[name="photo[]"][value="' + name + '"]').remove()
                    $('#editPaketWeddingForm' + $('input[name="paket_id"]').val()).find(
                            'input[name="file"]')
                        .remove()
                }
            })
        }
    }
</script>

<script>
    function deletePaketWeddingFunction(e) {
        Swal.fire({
            title: "Hapus data paket wedding?",
            text: `Data paket wedding akan terhapus. Anda tidak akan dapat mengembalikan
                aksi ini!`,
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "rgb(11, 42, 151)",
            cancelButtonColor: "rgb(209, 207, 207)",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then(function(t) {
            if (t.value) {
                e.parentNode.submit()
            }
        })
    }
</script>
@endsection
