<table id="laporan_pemesanan" class="table dt-responsive" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Pemesan</th>
            <th>Nama Paket</th>
            <th>Jumlah Paket</th>
            <th>Tempat Acara</th>
            <th>Tanggal Acara</th>
            <th>Total Harga</th>
            <th>Status Pembayaran</th>
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
            <td>
                @php
                    $pemesanan = \App\Models\Pemesanan::where('user_id', $data->user_id)->get();   
                    
                    foreach($pemesanan as $item) {
                        $data_paket = \App\Models\PaketWedding::where('id', $item->paket_wedding_id)->first();
                        $data_nama_paket[] = $data_paket->nama_paket;   
                    }

                    echo implode(",",$data_nama_paket);
                @endphp    
            </td>
            <td>
                @php

                    
                        $jumlah = \App\Models\Pemesanan::where('user_id', $data->user_id)->get();   
                                                    
                        foreach($jumlah as $item) {
                            $data_jumlah_paket[] = $item->jumlah_paket;   
                        }
            
                        echo implode(",",$data_jumlah_paket);
                  
                @endphp    
            </td>
            <td>{{ $data->tempat_acara }}</td>
            <td>{{ $data->tanggal_acara }}</td>
            <td>
                @php
                        $pemesanan = \App\Models\Pemesanan::where('user_id', $data->user_id)->get();   

                        $jumlah = 0;

                        foreach($pemesanan as $item) {
                            // $data_jumlah_paket[] = $item->jumlah_paket; 
                            $jumlah += $item->jumlah_paket * $item->paket_wedding->harga_paket;  
                        }

                        echo "Rp. " . $jumlah;
                @endphp
            </td>
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
        </tr>
        @endforeach
    </tbody>
</table>