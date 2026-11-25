@extends('masterlayout')

@section('title', 'UTS Pem Web')

@section('content')
    <div class="container">
        {{-- Alert --}}
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success', 'Biodata berhasil diperbarui.') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- 3-Column Card Grid --}}
        <div class="row row-cols-1 row-cols-md-3 g-3">
            {{-- Card Tambah (+) --}}
            <div class="col">
                <div class="card h-100 biodata-card">
                    <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 460px;">
                        <button type="button"
                            class="btn-add-circle d-inline-flex align-items-center justify-content-center border-0"
                            data-bs-toggle="modal" data-bs-target="#addBiodataModal" aria-label="Tambah Biodata">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none"
                                viewBox="0 0 24 24" stroke="#ffffff" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Cards Biodata --}}
            @foreach ($biodatas ?? collect() as $biodata)
                <div class="col">
                    <div class="card h-100 biodata-card">
                        <img src="{{ asset($biodata->foto ?: 'images/default-avatar.svg') }}"
                            class="card-img-top object-fit-cover" alt="{{ $biodata->nama }}"
                            style="height: 350px; object-position: center;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold mb-1" style="font-size: 1.08rem;">{{ $biodata->nama }}</h5>
                            <p class="card-text text-body-secondary mb-5" style="font-size: 0.85rem; line-height: 1.45;">
                                {{ $biodata->deskripsi }}
                            </p>
                            <div class="mt-auto pt-3 border-top d-flex gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm px-2" data-bs-toggle="modal"
                                    data-bs-target="#editBiodataModal" data-id="{{ $biodata->id }}"
                                    data-nama="{{ $biodata->nama }}" data-deskripsi="{{ $biodata->deskripsi }}">
                                    Edit
                                </button>
                                <form action="{{ route('biodata.destroy', $biodata) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus biodata ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm px-2">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Tambah Biodata --}}
    <div class="modal fade" id="addBiodataModal" tabindex="-1" aria-labelledby="addBiodataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBiodataModalLabel">Tambah Biodata</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="add-nama" name="nama" required
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="add-deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="add-deskripsi" name="deskripsi" rows="3" required
                                placeholder="Masukkan NIM dan tugas pada UTS"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="add-foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="add-foto" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Biodata --}}
    <div class="modal fade" id="editBiodataModal" tabindex="-1" aria-labelledby="editBiodataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editBiodataForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBiodataModalLabel">Edit Biodata</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="edit-deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit-foto" class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" class="form-control" id="edit-foto" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const editBiodataModal = document.getElementById('editBiodataModal');
        if (editBiodataModal) {
            editBiodataModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const nama = button.getAttribute('data-nama');
                const deskripsi = button.getAttribute('data-deskripsi');

                const form = document.getElementById('editBiodataForm');
                form.action = '/biodata/' + id;
                document.getElementById('edit-nama').value = nama;
                document.getElementById('edit-deskripsi').value = deskripsi;
            });
        }
    </script>
@endpush
