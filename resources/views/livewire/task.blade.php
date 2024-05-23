<div>
    <div class="d-flex align-items-center justify-content-between mb-5">
        <h3 class="text-dark fw-bold mb-0">Task Kamu</h3>
        <a wire:navigate href="{{ route('task-create') }}" class="btn btn-primary">Tambah Task Baru</a>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if ($tasks->count() > 0)
        @foreach ($tasks as $item)
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="text-dark fw-semibold">{{ $item->title }}</h5>
                            <p class="text-secondary fs-7">Dibuat {{ $item->created_at->diffForHumans() }}</p>

                            <div class="d-flex align-items-center gap-3">
                                <p class="align-items-center gap-1 mb-0 fs-7 text-capitalize">
                                    <i class='bx bx-directions'></i> {{ $item->priority }}
                                </p>
                                <p class="align-items-center gap-1 mb-0 fs-7">
                                    @if($item->status == 'In Progress')
                                        <span class="text-warning fw-bold">{{ $item->status }}</span>
                                    @else
                                        <span class="text-success"><i class='bx bx-bookmark-alt'></i> {{ $item->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if ($item->status == 'In Progress')
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-sm btn-outline-danger" wire:click="delete({{ $item->id }})" wire:confirm="Apakah ingin menghapus item?">Hapus</button>
                                    <button class="btn btn-sm btn-primary"
                                        wire:click="completed({{ $item->id }})">Complete</button>
                                </div>
                            @else
                                <p class="text-success text-end mb-0 fw-bold">Task Selesai</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-secondary">Oops! Task masih belum ada</p>
    @endif
</div>
