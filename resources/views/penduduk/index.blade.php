@extends('templates/layout')

@push('style')
@endpush

@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Penduduk</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormPenduduk">
                    Tambah Penduduk
                </button>
                <div class="mt-3">
                    @include('penduduk.data')
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        @include('penduduk.form')
    </section>
@endsection

@push('scripts')
    <script>
        $('#tbl-penduduk').DataTable()
        $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-success').slideUp(500)
        })
        $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
            $('.alert-danger').slideUp(500)
        })
        console.log($('.delete-data'))
        $('.delete-data').on('click', function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
            Swal.fire({
                title: `Apakah data <span style="color:red">${data}</span> akan dihapus?`,
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus data ini!'
            }).then((result) => {
                if (result.isConfirmed)
                    $(e.target).closest('form').submit()
                else swal.close()
            })
        })
        $('#modalFormPenduduk').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const nama = btn.data('nama')
            const jns_kelamin = btn.data('jns_kelamin')
            const tmp_lahir = btn.data('tmp_lahir')
            const tgl_lahir = btn.data('tgl_lahir')
            const alamat = btn.data('alamat')
            const foto = btn.data('foto')
            const id = btn.data('id')
            const modal = $(this)
            // console.log($(this))
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data penduduk')
                modal.find('#nama').val(nama)
                modal.find('#jns_kelamin').val(jns_kelamin)
                modal.find('#tmp_lahir').val(tmp_lahir)
                modal.find('#tgl_lahir').val(tgl_lahir)
                modal.find('#alamat').val(alamat)
                modal.find('.modal-body form').attr('action', '{{ url('penduduk') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
                console.log(nama)
            } else {
                modal.find('.modal-title').text('Input Data penduduk')
                modal.find('#nama').val('')
                modal.find('#jns_kelamin').val('')
                modal.find('#tmp_lahir').val('')
                modal.find('#tgl_lahir').val('')
                modal.find('#alamat').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url('penduduk') }}')
            }
        })
    </script>
@endpush
