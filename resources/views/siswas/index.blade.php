<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa SMK 2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('siswas.create') }}" class="btn btn-md btn-primary mb-3 ">Tambah Siswa</a>
                        <a href="{{ route('welcome') }}" class="btn btn-md btn-warning mb-3 ">Kembali</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswas as $siswa)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/app/public/siswas/'.$siswa->image) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $siswa->nama_siswa }}</td>
                                    <td>{{$siswa->tanggal_lahir}}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin?')" action="{{ route('siswas.destroy', $siswa->id) }}" method="POST">
                                            <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-sm btn-success">Edit Siswa</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus Siswa</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Siswa Belum Tersedia
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <center>
                       {{ $siswas->links() }}
                       </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'BERHASIL DITAMBAHKAN!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL DITAMBAHKAN!');

        @endif
    </script>
</body>
</html>