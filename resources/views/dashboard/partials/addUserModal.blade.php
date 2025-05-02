<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px; border: none;">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <h5 class="modal-title" id="formModalLabel" style="font-size: 1.5rem; font-weight: bold; color: #333;">Form Tambah {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-top: 0;">
                <form action="/dashboard/users" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    
                    <div class="mb-4">
                        <label for="name" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Nama Lengkap</label>
                        <input autocomplete="off" type="text"
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name') }}" required
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        @error('name')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="nomor_induk" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Nomor Induk
                            <span style="color: #dc3545; font-style: italic; font-weight: lighter; font-size: 12px;"> *Min 8 Angka</span>
                        </label>
                        <input autocomplete="off" type="number"
                            class="form-control @error('nomor_induk') is-invalid @enderror" 
                            id="nomor_induk" name="nomor_induk" value="{{ old('nomor_induk') }}" required
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        @error('nomor_induk')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Email</label>
                        <input autocomplete="off" type="email"
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" name="email" value="{{ old('email') }}" required
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        @error('email')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Password
                            <span style="color: #dc3545; font-style: italic; font-weight: lighter; font-size: 12px;"> *Min 4 Karakter</span>
                        </label>
                        <input autocomplete="off" type="password"
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" name="password" value="{{ old('password') }}" required
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        @error('password')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="role_id" class="form-label d-block" style="font-weight: bold; color: #555; font-size: 14px;">Role</label>
                        <div class="form-control" style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%; background-color: #f8f9fa;">Mahasiswa</div>
                        <input type="hidden" name="role_id" value="2">
                    </div>
                    
                    <div class="modal-footer" style="border-top: none; padding-top: 0;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
                            style="padding: 10px 20px; border-radius: 5px; border: none; background-color: #6c757d; color: white;">Close</button>
                        <button type="submit" class="btn btn-primary" 
                            style="padding: 10px 20px; border-radius: 5px; border: none; background-color: #4CAF50; color: white; font-weight: bold;">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>