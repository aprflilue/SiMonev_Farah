<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Tambah {{ $title }}</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="/dashboard/users" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <small class="text-danger">*) Wajib Diisi</small>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap <small class="text-danger"> *</small></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<div class="small-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <small class="text-danger"> *</small></label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')<div class="small-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <small class="text-danger"> *</small></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')<div class="small-text">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <small class="text-danger"> *</small></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required>
                        @error('password')<div class="small-text">{{ $message }}</div>@enderror
                    </div>
                    <input type="hidden" name="role_id" id="role_id" value="{{ 1 }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>