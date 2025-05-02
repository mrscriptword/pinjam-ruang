<div class="modal fade" id="addRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px; border: none;">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0;">
                <h5 class="modal-title" id="formModalLabel" style="font-size: 1.5rem; font-weight: bold; color: #333;">Form Tambah {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-top: 0;">
                <form action="/dashboard/rooms" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="room_id" id="room_id">
                    
                    <div class="mb-4">
                        <label for="code" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Kode Ruangan</label>
                        <input autocomplete="off" type="text"
                            class="form-control @error('code') is-invalid @enderror" 
                            id="code" name="code" required value="{{ old('code') }}"
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        @error('code')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Nama Ruangan</label>
                        <input autocomplete="off" type="text"
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" required value="{{ old('name') }}"
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        @error('name')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="img" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Foto Ruangan
                            <span style="color: #dc3545; font-style: italic; font-weight: lighter; font-size: 12px;"> *Max 2 Mb</span>
                        </label>
                        <input class="form-control @error('img') is-invalid @enderror" 
                            type="file" id="img" name="img"
                            style="padding: 8px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        @error('img')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="mb-4" style="display: flex; gap: 15px;">
                        <div style="flex: 1;">
                            <label for="floor" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Lantai</label>
                            <input type="number" 
                                class="form-control @error('floor') is-invalid @enderror"
                                id="floor" name="floor" required value="{{ old('floor') }}"
                                style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        </div>
                        <div style="flex: 1;">
                            <label for="capacity" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Kapasitas</label>
                            <input type="number" 
                                class="form-control @error('capacity') is-invalid @enderror"
                                id="capacity" name="capacity" required value="{{ old('capacity') }}"
                                style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="building_id" class="form-label d-block" style="font-weight: bold; color: #555; font-size: 14px;">Gedung</label>
                        <select class="form-select @error('building_id') is-invalid @enderror" 
                            name="building_id" id="building_id" required
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                            <option selected disabled>Pilih Gedung</option>
                            @foreach ($buildings as $building)
                                <option value="{{ $building->id }}">{{ $building->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="type" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Tipe Ruangan</label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                            name="type" id="type" required
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                            <option selected disabled>Pilih Tipe Ruangan</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Ruang Dosen">Ruang Dosen</option>
                            <option value="Ruang Umum">Ruang Umum</option>
                            <option value="Auditorium">Auditorium</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label" style="font-weight: bold; color: #555; font-size: 14px;">Deskripsi Ruangan</label>
                        <textarea name="description" id="description" cols="30" rows="5" 
                            class="form-control @error('description') is-invalid @enderror" required
                            style="padding: 12px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="modal-footer" style="border-top: none; padding-top: 0;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
                            style="padding: 10px 20px; border-radius: 5px; border: none; background-color: #6c757d; color: white;">Close</button>
                        <button type="submit" class="btn btn-primary" 
                            style="padding: 10px 20px; border-radius: 5px; border: none; background-color: #4CAF50; color: white; font-weight: bold;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>