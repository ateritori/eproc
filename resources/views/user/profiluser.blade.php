<div class="table-container mt-4">
    <h4 class="label-section">Data Akun Vendor</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-profil">
            @php
                $profilVendor = [
                    'ID User' => $user->vendor->id_user ?? '-',
                    'Nama' => $user->name ?? '-',
                    'Email' => $user->email ?? '-',
                ];
            @endphp

            @foreach ($profilVendor as $label => $value)
                <tr>
                    <td>{{ $label }}</td>
                    <td class="separator">:</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach

            <!-- Tombol Edit User di bawah row terakhir -->
            <tr>
                <td></td>
                <td></td>
                <td>
                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Akun
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>
