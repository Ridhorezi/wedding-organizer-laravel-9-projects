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