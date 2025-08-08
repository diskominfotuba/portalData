@forelse ($table as $key => $tb)
    <div
        class="dataset-item shadow-sm mb-3 p-3 d-flex align-items-start rounded border bg-white flex-wrap flex-md-nowrap">

        {{-- Icon --}}
        <div class="me-3 p-3 bg-portal-primary rounded d-flex align-items-center justify-content-center">
            <img src="https://img.icons8.com/office/40/document--v1.png" alt="icon" width="48" />
        </div>

        {{-- Konten Dataset --}}
        <div class="dataset-content flex-grow-1">
            <h6 class="fw-semibold mb-1 text-dark">
                <a href="{{ route('dataset.show', $tb->slug) }}" class="text-decoration-none text-dark">
                    {{ $tb->nama_data }}
                </a>
            </h6>

            <div class="d-flex flex-wrap gap-3 align-items-center small text-muted">
                <div><i class="fas fa-map-marker-alt me-1"></i> Pemerintah Kab Tulang Bawang</div>
                <div><i class="fas fa-building me-1"></i> {{ $tb->nama_opd }}</div>
            </div>

            <div class="d-flex flex-wrap gap-3 align-items-center mt-2 small dataset-meta">
                <div class="badge bg-success-subtle text-success border border-success px-2 py-1">
                    <i class="fas fa-check-circle me-1"></i> Tetap
                </div>
                <div class="text-muted">
                    <i class="fas fa-clock me-1"></i> {{ $tb->latestVerifiedVersion->verified_at }}
                </div>
                <div class="text-muted">
                    <i class="fas fa-eye me-1"></i> 99
                </div>
            </div>

        </div>
    </div>
@empty
    <div class="text-center text-muted py-5">
        <i class="fas fa-exclamation-circle fa-2x mb-3"></i>
        <p class="mb-0">Tidak ada data yang ditemukan.</p>
    </div>
@endforelse
