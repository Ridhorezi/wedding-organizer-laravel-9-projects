<table id="data_pesanan_table" class="table dt-responsive" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Pemesan</th>
            <th>Nama Paket</th>
            <th>Jumlah Paket</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @php
        $increment = 1;
        @endphp

        @foreach($data_pesanan as $data)
        <tr>
            <td>{{ $increment++ }} </td>
            <td>{{ $data->users->nama }}</td>
            <td>{{ $data->paket_wedding->nama_paket }}</td>
            <td>{{ $data->jumlah_paket }}</td>
            <td>
                @php
                    $color = 'secondary';
                    if($data->status_pembayaran == 'belum'){
                        $color = 'warning';
                    }elseif ($data->status_pembayaran == 'sudah') {
                        $color = 'success';
                    }
                @endphp
                <span class="badge badge-{{$color}} font-15">{{ ucwords($data->status_pembayaran) }}</span>
            </td>
            <td>
                <div class="form-group">
                    <button type="button" data-toggle="modal" data-target="#detailModal"
                        data-ids="{{ $data->id }}" data-role="{{ $data->role }}"
                        onclick="detailData({{ $data }})"
                        class="btn btn-info btn-xs text-white"><i class="fa fa-info mr-1"></i> Detail</button>
                    <button type="button" data-toggle="modal" data-target="#editModal"
                        data-ids="{{ $data->id }}" data-role="{{ $data->role }}"
                        onclick="setEditData({{ $data }})"
                        class="btn btn-warning btn-xs text-white"><i class="fa fa-edit mr-1"></i> Edit</button>
                    <form style="display: inline" action="{{ route('manajemen-akun.destroy', $data) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button type="button"
                            class="btn btn-danger btn-xs rounded waves-light waves-effect"
                            onclick="deleteAlert(this)"><i class="fa fa-trash-o mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>