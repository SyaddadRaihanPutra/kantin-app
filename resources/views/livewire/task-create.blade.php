<div>
    <div class="d-flex align-items-center justify-content-between mb-5">
        <h3 class="text-dark fw-bold mb-0">Tambah Task Baru</h3>
        <a wire:navigate href="{{ route('task') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card mb-2">
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form wire:submit="save">
                <div class="mb-3">
                    <label for="title" class="mb-1">Nama Task</label>
                    <input wire:model='title' type="text" id="title" class="form-control" placeholder="Tulis nama task">
                </div>
                <div class="mb-3">
                    <label for="priority" class="mb-1">Prioritas</label>
                    <select wire:model='priority' id="priority" class="form-select">
                        <option value="">Pilih prioritas</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Urgent">Urgent</option>
                    </select>
                </div>
                <button class="btn btn-primary w-100" type="submit">Buat</button>
            </form>
        </div>
    </div>

</div>
