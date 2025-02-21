<div class="table-container mt-4">
    <h4 class="label-section">Data Umum Vendor</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-profil">
            @php
                $profilVendor = [
                    'ID Vendor' => $user->vendor->id_vendor ?? '-',
                    'Pemilik' => $user->vendor->pemilik ?? '-',
                    'Alamat Vendor' => $user->vendor->alamat ?? '-',
                    'Nomor Telepon' => $user->vendor->telepon ?? '-',
                    'Nama PIC (Penanggung Jawab)' => $user->vendor->pic ?? '-',
                    'Nomor HP PIC' => $user->vendor->hp_pic ?? '-',
                    'Bidang Usaha' => $user->vendor->bidang ?? '-',
                    'Tahun Berdiri' => $user->vendor->berdiri ?? '-',
                    'Sertifikasi dan Legalitas' => $user->vendor->legalitas ?? '-',
                    'Jumlah Proyek Terselesaikan' => $user->vendor->total_proyek ?? '-',
                ];
            @endphp

            @foreach ($profilVendor as $label => $value)
                <tr>
                    <td>{{ $label }}</td>
                    <td class="separator">:</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach

            <!-- Tombol Edit Vendor -->
            <tr>
                <td></td>
                <td></td>
                <td>
                    <a href="{{ route('edit_vendor', ['id_vendor' => $user->vendor->id_vendor]) }}"
                        class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Vendor
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>
