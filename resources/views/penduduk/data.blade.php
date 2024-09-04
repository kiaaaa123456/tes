<table id="tbl-penduduk" class="table table-compact table stripped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Foto</th>
            <th>Tools</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tb_penduduk as $p)
            <tr>
                <td>{{ $i = !isset($i) ? ($i = 1) : ++$i }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->jns_kelamin }}</td>
                <td>{{ $p->tmp_lahir }}</td>
                <td>{{ $p->tgl_lahir }}</td>
                <td>{{ $p->alamat }}</td>
                <td>
                    @if ($p->foto)
                        <img src="{{ asset('storage/' . $p->foto) }}" alt="Foto" width="70">
                    @else
                        No Photo
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalFormPenduduk"
                        data-mode="edit" data-id="{{ $p->id }}" data-nama="{{ $p->nama }}"
                        data-jns_kelamin="{{ $p->jns_kelamin }}" data-tmp_lahir="{{ $p->tmp_lahir }}"
                        data-tgl_lahir="{{ $p->tgl_lahir}}" data-alamat="{{ $p->alamat }}"
                        data-foto="{{ $p->foto }}">
                        <i class="fas fa-edit text-success"></i>
                    </button>
                    <form method="post" action="{{ route('penduduk.destroy', $p->id) }}" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn delete-data" data-nama="{{ $p->nama }}">
                            <i class="fas fa-trash text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
